<?php

namespace App\Controller;
use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Event\Event;

use Cake\Validation\Validation;
//require_once(ROOT . DS  . 'vendor' . DS  . 'Excel' . DS . 'reader.php');
//use Spreadsheet_Excel_Reader;
/**
* Static content controller
*
* This controller will render views from Template/Pages/
*
* @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
*/
class CmspagesController extends AppController
{
    public $helpers = ['Form'];
   
    //Function for check admin session
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['termsAndConditions']);

       	$this->viewBuilder()->layout('admin_inner');
    }
    public function initialize()
    {
		parent::initialize();
        $this->loadComponent('Paginator');
	}
	
    /**
	* Function for email templates
	*/ 
	function emailTemplates()
    {
    	
		$this->viewBuilder()->layout("admin_dashboard");
		//echo "okokoooooooo";die;
		// load EmailTemplates Model
		$EmailTemplateModel = TableRegistry::get('EmailTemplates');
	
		//$EmailTemplateTable = $EmailTemplateModel->newEntity();
		$this->loadComponent('Paginator');
		$this->set('modelName','EmailTemplates');
		
		//CODE FOR MULTILIGUAL END
		 if(!empty($_GET['data']) && isset($_GET['data']))
		 {
			$data = $_GET['data'];
			$emailTemplates = $this->Paginator->paginate($EmailTemplateModel,[
			   'conditions' => [
					'EmailTemplates.title LIKE' => '%'.$data['EmailTemplates']['title'].'%',
			   ],
			   'order' => [
					'EmailTemplates.modified' => 'desc'
				]
			]);
		 }
		else
		{
			$emailTemplates = $this->Paginator->paginate($EmailTemplateModel,[ 'limit' => 200,
			   'order' => [
					'EmailTemplates.modified' => 'desc'
				]
			]);
		}
		$this->set('emailTemplates',$emailTemplates);
	}
    /**Function for email template edit
	*/
	function emailTemplateEdit($id = null)
	{
		
		$id=convert_uudecode(base64_decode($id));
		
		$this->viewBuilder()->layout("admin_dashboard");
		
		// Loading model
		$emailTemplateModel = TableRegistry::get('EmailTemplates');

		if (isset($this->request->data) && !empty($this->request->data)) 
		{
			$emailTemplateData = $emailTemplateModel->newEntity($this->request->data['EmailTemplates'],['validate' => true]);
			
				$emailTemp = (object)$this->request->data['EmailTemplates'];
				 
				 if (!$emailTemplateData->errors()){
					
					$emailTemplateData->modified = date('Y-m-d h:i:s');
					if ( $emailTemplateModel->save($emailTemplateData)) 
					{
						//$this->displaySuccessMessage('Template has been updated Successfully');
						$this->Flash->success(__('Record has been updated Successfully.'));
						return $this->redirect(['controller'=>'cmspages','action'=>'email_templates']);
					}
				 }else{
					 $this->set('emailTemp',$emailTemp);
						$this->set([
						'errors' => $emailTemplateData->errors(), 
						'_serialize' => ['errors']]);
						
						//$this->displayErrorMessage('All fields are required');
						$this->Flash->error(__('All fields are required.'));
						return $this->redirect($this->referer());
				  }
		}else{
			$emailTemp = $emailTemplateModel->get($id);
		    $this->set(compact('emailTemp'));
		}
	}
	
   
	function agentTermsConditions(){

		$this->viewBuilder()->layout('front');
		// load CMSPAGE Model
		$CmsPagesModel = TableRegistry::get('CmsPages');
	
		$CmsPageData = $CmsPagesModel->find("all",["conditions"=>['CmsPages.pageurl'=> 'terms']])->first();
				
		$this->pageTitle = $CmsPageData->meta_title;
		$this->pageKeyword = $CmsPageData->meta_keywords;
		$this->pageDescription = $CmsPageData->meta_description;
		$this->set(array('CmsPageData'), array($CmsPageData));
	}
	
	/**
	* Function for CMS pages
	*/ 
	function cmsPages()
    {
		$this->viewBuilder()->layout("admin_dashboard");
		// load CMSPAGE Model
		$CmsPagesModel = TableRegistry::get('CmsPages');

		$this->loadComponent('Paginator');
		$this->set('modelName','CmsPages');
		//for searching 
		 if(!empty($_GET['data']) && isset($_GET['data']))
		 {
			$data = $_GET['data'];
			$cmsPages = $this->Paginator->paginate($CmsPagesModel,[
			   'conditions' => [
					'CmsPages.pagename LIKE' => '%'.$data['CmsPage']['pagename'].'%',
			   ],
			   'limit' => 10,
			   'order' => [
					'CmsPages.modified' => 'desc'
				]
			]);
		 }
		else
		{
			$cmsPages = $this->Paginator->paginate($CmsPagesModel,[ 'limit' => 200,
			   'order' => [
					'CmsPages.modified' => 'desc'
				]
			]);
		}
		$this->set('cmsPages',$cmsPages);
	}
    /** 
	* Function to edit cms pages
	*/ 
	function cmsPagesEdit($id=null)
	{
		$this->viewBuilder()->layout("admin_dashboard");
		$id = convert_uudecode(base64_decode($id));
	
		// load CMSPAGE model
	    $CmsPagesModel = TableRegistry::get('CmsPages');


		if (isset($this->request->data) && !empty($this->request->data)) 
		{
		   $cmsPageData = $CmsPagesModel->newEntity($this->request->data['CmsPages'],['validate' => true]);
			
			$cmsPage = (object)$this->request->data['CmsPages'];
			$imagename = $this->request->data['CmsPages']['banner_image']['name'];
			if (!$cmsPageData->errors()){
				
				if($imagename!=''){
					$pageBannerImg = $this->upload_file('staticBannerImg',$this->request->data['CmsPages']['banner_image']);
					
					$pageBannerImg = explode(':',$pageBannerImg);
					if($pageBannerImg[0]=='error'){
					   $this->Flash->error(__($pageBannerImg[1]));
					   return $this->redirect($this->referer());
					}else{
						$cmsPageData->banner_image = $pageBannerImg[1];
					}				
				}else{
				   unset($cmsPageData->banner_image);
				}
				
				if ($CmsPagesModel->save($cmsPageData)) 
				{
					$this->Flash->success(__('CMS Page updated successfully'));
					return $this->redirect(['controller'=>'cmspages','action'=>'cms-pages']);
				}
			}else{
				$this->set('page',$cmsPage);
				$this->set([
				'errors' => $cmsPageData->errors(), 
				'_serialize' => ['errors']]);
				
				$this->Flash->error(__('All fields are required'));
				return $this->redirect($this->referer());
			}
        }else{
			$cmsPage = $CmsPagesModel->get($id);
			$this->set('page',$cmsPage);
		}
	}
    /**
	* Function for email templates
	*/ 
	
	function importdescartesOrder(){
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '64M');
		$this->loadComponent('CsvImporter');
	
	}
	
	function emptyTable() {
		$table = $this->tablePrefix.$this->table;
		return $this->query("TRUNCATE $table");
	}
	function termsAndConditions(){
		$this->viewBuilder()->layout("mobile_pages");
		
	    $cmsPagesModel = TableRegistry::get('CmsPages');
	    $termsdata = $cmsPagesModel->find('all')->where(["CmsPages.pageurl" => "terms"])->first();
	     
	    $this->set('termsData' , $termsdata->pagecontent);
	}
	public function addShippingCarrier()
    {   
    	$this->loadModel('ShippingCarriers');
        $carrierInfo = $this->ShippingCarriers->newEntity();
        if ($this->request->is('post')) {
            $carrierInfo = $this->ShippingCarriers->patchEntity($carrierInfo, $this->request->data);
           
            if ($this->ShippingCarriers->save($carrierInfo)) {
                
                $this->Flash->success(__('Record has been saved.'));
                return $this->redirect(['action' => 'shipping-carriers']);
            }
            $this->Flash->error(__('Unable to add shipping carrier.'));
        }
        $country_info = $this->countryCodes();
        //pr($country_info);die;
        $this->set('country_info', $country_info);

        $this->set('carrierInfo', $carrierInfo);
    }
    public function editShippingCarrier($id = null)
    {   
    	$this->loadModel('ShippingCarriers');
        $id = convert_uudecode(base64_decode($id));

        $carrierInfo = $this->ShippingCarriers->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $carrierInfo = $this->ShippingCarriers->patchEntity($carrierInfo, $this->request->data);
            $carrierInfo->role = AGENT_ROLE;

            if ($this->ShippingCarriers->save($carrierInfo)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'shipping-carriers']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                
            }
        }

        $carrierInfo->convertedId = base64_encode(convert_uuencode($carrierInfo->id));
        unset($carrierInfo->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set(compact('carrierInfo'));
    }
      public function shippingCarriers()
    {   
    	$this->loadModel('ShippingCarriers');
        $query = $this->ShippingCarriers->find('all')->toArray();
        
        $this->set('carries', $query);
    }
     /**
     * Enable/Disable Users
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeStatus($id = null, $status = 'off')
    {
        $this->loadModel('ShippingCarriers');
        $carrierInfo = $this->ShippingCarriers->get($id);
        $carrierInfo->status = ( $status === 'on' ) ? 1: 0;
        if ($this->ShippingCarriers->save($carrierInfo)) 
        {
            $this->Flash->success(__('The status has been changed.'));
        } 
        else 
        {
            $this->Flash->error(__('The status could not be changed. Please, try again.'));
        }   
        return $this->redirect(['controller' => 'cmspages' , 'action' => 'shipping-carriers']);
    }

}
