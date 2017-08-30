<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Core\Configure;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

use Cake\Validation\Validation;

require_once(ROOT . DS  . 'vendor' . DS  . 'firebase' . DS . 'Firebase.php');
use Firebase;

class ApiController extends AppController
{
                                                            
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
       
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
       
        $this->Auth->allow(['register' , 'login' , 'forgotPassword' , 'verifyForgotPassword' , 'resetPassword' , 'changePassword', 'getProfile', 'editProfile' ,'verifyOtp','acceptAgreement','ResultsList','termsAndConditions' , 'resultsListSam' , 'resultsListSuw','resendCodeForgotPassword' , 'getOrderDetail' , 'getProductDetail' , 'addChildSaw' , 'childList' , 'addChildSam' , 'anganwadisList' , 'assignProducts' , 'countryCodes' , 'addChild' , 'changeDriverStatus' , 'changeProductsStatus' , 'scannedOrderInfo' , 'userNotifications' , 'testFirebase' , 'documentApproveStatus', 'addEditCertificates', 'getCertificates', 'deleteCertificates','trackOrder','sendGoogleCloudMessage']);
       
        /**
        **************
        * Check authetication using auth key
        **************
        */
        $this->loadModel('AuthKeys');
        $AuthKeyData = $this->AuthKeys->find('all')->first();

        $kayVal = $this->request->header('key');
        if($kayVal != $AuthKeyData->key){
           
             $resultJ = json_encode(array( 'status' => 301, 'message' => "Invalid API Key" ));
             echo $resultJ;die;
        }
        
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

        $this->loadModel('Workers');
        $this->loadModel('DataChildren');
        $this->loadModel('SawChild');
        $this->loadModel('SamChild');
        $this->loadModel('Anganwadis');
        $this->loadModel('SawResult');
        $this->loadModel('SamResult');
        $this->loadModel('BoysSawChart');
        $this->loadModel('GirlsSawChart');
        $this->loadModel('Notification');
        $this->loadModel('BoysSuwChart');
        $this->loadModel('GirlsSuwChart');
    }

    /**
   *********************************************************************
   *  Function Name : check_empty() .
   *  Functionality : check data validation
   *********************************************************************
   **/
   private function check_empty( $data, $message = '', $numeric = false )
   {
        $message = ( !empty( $message ) ) ? $message : 'Invalid data';
        if( empty( $data ) )
          {

            $resultJ = json_encode(array( 'status' => 301, 'message' => $message ));
            $this->json_response($resultJ);
             
          }
          if( $numeric )
          {
            if( !numeric( $data ) )
            {
              $resultJ = json_encode(array( 'status' => 301, 'message' => $message ));
              $this->json_response($resultJ);

            }
          }
    } 
    function hasherGenerater($value = null){
             $hasher = new DefaultPasswordHasher();
             $value = $hasher->hash($value);
            return $value;
    }
  
    /**
    *********************************************************************
    *  Function Name : json_response() .
    *  Functionality : return json response
    *********************************************************************
    **/
    public function json_response($resultJ = null){
            
            $this->response->type('json');
            $this->response->body($resultJ);
            echo  $this->response;die;
           // return $this->response;
    }

    public function index()
    {
       $recipes = $this->Users->find('all')->toArray();
        return $this->set([
            'recipes' => $recipes,
            '_serialize' => ['recipes']
        ]);
    }

    public function view($id)
    {
        $recipe = $this->Recipes->get($id);
        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
    }
    
    function checkMessage(){

       //Start Send message on mobile
		$to_mobile_number = "9888069373";//$userInfo->phone;
		$message_body = "Your OTP 123456 for login verification on sky2c";
		$country_code = "91";//$userInfo->country_code;
		$this->sendMessages($to_mobile_number , $message_body , $country_code);
		//End send message 
    }
    
  /**
   *********************************************************************
   *  Function Name : login() .
   *  Functionality : login for agent and driver with email or login with phone for driver
   *********************************************************************
  **/
    public function login(){
		
        $this->autoRender = false; //avoid to render view

		if ($this->request->is('post')) {
			
			$userId = isset($this->request->data['email']) ? $this->request->data['email'] : "";
			$password = isset($this->request->data['password']) ? $this->request->data['password'] : "";
			$this->check_empty($password, 'Please add password');
			$this->check_empty($userId, 'Please add email');
			
			$userInfo = $this->Workers->find('all')->where( ['Workers.email' => $userId ]) ->orWhere(['Workers.username' => $userId])->first();
			if($userInfo){
			if ((new DefaultPasswordHasher)->check($password, $userInfo->password)) {
						}else{		
							$resultJ = json_encode(array('status' => '301' , 'message' => 'Please enter valid credential.'));
							$this->json_response($resultJ);
						}
			}
				if(count($userInfo)>0){
					unset($userInfo->password);
					unset($userInfo->created);
					    $resultJ = json_encode(array('status' => '200' , 'message' => 'Login successfully', 'data' => $userInfo));
					}else{
						$resultJ = json_encode(array('status' => '301' , 'message' => 'invalid details.'));
					}
				$this->json_response($resultJ);
        }
    }
	 /**
       *********************************************************************
       *  Function Name : addChild() .
       *  Functionality : Add Child
       *********************************************************************
    **/
 public function addChild(){   
      if ($this->request->is('post')) {
        $user = $this->DataChildren->newEntity();
		
            $name = isset($this->request->data['name']) ? $this->request->data['name'] : "";
            $age = isset($this->request->data['age']) ? $this->request->data['age'] : "";
            $dob = isset($this->request->data['dob']) ? $this->request->data['dob'] : "";
            $mother_name = isset($this->request->data['mother_name']) ? $this->request->data['mother_name'] : "";
            $father_name = isset($this->request->data['father_name']) ? $this->request->data['father_name'] : "";
            $anganwadi_id = isset($this->request->data['anganwadi_id']) ? $this->request->data['anganwadi_id'] : "";
            $worker_id = isset($this->request->data['worker_id']) ? $this->request->data['worker_id'] : "";
            $gender = isset($this->request->data['gender']) ? $this->request->data['gender'] : "";
            $address = isset($this->request->data['address']) ? $this->request->data['address'] : "";
			
         
     		$this->check_empty($name, 'Please add name');
            $this->check_empty($age, 'Please add age');
           // $this->check_empty($dob, 'Please add dob');
            $this->check_empty($mother_name, 'Please add mother_name');
            $this->check_empty($father_name, 'Please add father_name');
            $this->check_empty($anganwadi_id, 'Please add anganwadi_id');
            $this->check_empty($worker_id, 'Please add worker_id');
            $this->check_empty($gender, 'Please add gender');
            $this->check_empty($address, 'Please add address');
			
			
            $user = $this->DataChildren->patchEntity($user, $this->request->data);
           
			$UserDataid = $this->DataChildren->save($user);
			
            if ($UserDataid) {
                $resultJ = json_encode(array('status' => '200' ,'children_id'=>$UserDataid['id'], 'message' => 'The child has been added successfully.'));
            }else{
               if(!empty($user->errors())){
                  $errorMsgShow = "";
                  foreach($user->errors() as $error){
                       foreach($error as $errorMsg){
                          $errorMsgShow = $errorMsg;
                          break;
                       }
                       if($errorMsgShow != ""){
                            break;
                       }
                  }
                  $message = $errorMsgShow;
                }else{
                  $message = "Unable to add the child.";
                }
              $resultJ = json_encode(array('status' => '301' , 'message' => $message));
            }
          $this->json_response($resultJ);
        }
    }
		 /**
       *********************************************************************
       *  Function Name : addChildSam() .
       *  Functionality : Add Sam Child
       *********************************************************************
    **/
public function addChildSam(){   
      if ($this->request->is('post')) {
            $user = $this->SamChild->newEntity();
		
            $data_children_id = isset($this->request->data['data_children_id']) ? $this->request->data['data_children_id'] : "";
            $height = isset($this->request->data['height']) ? $this->request->data['height'] : "";
            $upper_arm = isset($this->request->data['upper_arm']) ? $this->request->data['upper_arm'] : "";
            $weight = isset($this->request->data['weight']) ? $this->request->data['weight'] : "";
            $worker_id = isset($this->request->data['worker_id']) ? $this->request->data['worker_id'] : "";
            $sam_result_id = isset($this->request->data['sam_result_id']) ? $this->request->data['sam_result_id'] : "";
            $pedal_edema = isset($this->request->data['pedal_edema']) ? $this->request->data['pedal_edema'] : "";
           
         
     		$this->check_empty($data_children_id, 'Please add children');
            $this->check_empty($height, 'Please add height');
            $this->check_empty($upper_arm, 'Please add upper_arm');
            $this->check_empty($weight, 'Please add head weight');
            $this->check_empty($worker_id, 'Please add worker id');
            $this->check_empty($sam_result_id, 'Please add result id');
            $this->check_empty($pedal_edema, 'Please add pedal edema');
        
			 $user = $this->SamChild->patchEntity($user, $this->request->data);
           if ($this->SamChild->save($user)) {
                $resultJ = json_encode(array('status' => '200' , 'message' => 'Sam results has been saved.'));
            }else{
               if(!empty($user->errors())){
                  $errorMsgShow = "";
                  foreach($user->errors() as $error){
                       foreach($error as $errorMsg){
                          $errorMsgShow = $errorMsg;
                          break;
                       }
                       if($errorMsgShow != ""){
                            break;
                       }
                  }
                  $message = $errorMsgShow;
                }else{
                  $message = "Unable to add the Sam child.";
                }
              $resultJ = json_encode(array('status' => '301' , 'message' => $message));
            }
          $this->json_response($resultJ);
        }
    }
			 /**
       *********************************************************************
       *  Function Name : addChildSaw() .
       *  Functionality : Add Saw Child
       *********************************************************************
    **/
public function addChildSaw(){
	
      if ($this->request->is('post')) {
            $user = $this->SawChild->newEntity();
		
            $data_children_id = isset($this->request->data['data_children_id']) ? $this->request->data['data_children_id'] : "";
            $age = isset($this->request->data['age']) ? $this->request->data['age'] : "";
            $weight = isset($this->request->data['weight']) ? $this->request->data['weight'] : "";
            $saw_result_id = isset($this->request->data['saw_result_id']) ? $this->request->data['saw_result_id'] : "";
            $worker_id = isset($this->request->data['worker_id']) ? $this->request->data['worker_id'] : "";
            
     		$this->check_empty($data_children_id, 'Please add children');
            $this->check_empty($age, 'Please add age');
            $this->check_empty($weight, 'Please add weight');
            $this->check_empty($saw_result_id, 'Please add result id');
            $this->check_empty($worker_id, 'Please add worker id');
			$user = $this->SawChild->patchEntity($user, $this->request->data);
           
     
            if ($this->SawChild->save($user)) {
                $resultJ = json_encode(array('status' => '200' , 'message' => 'Saw results has been saved.'));
            }else{
               if(!empty($user->errors())){
                  $errorMsgShow = "";
                  foreach($user->errors() as $error){
                       foreach($error as $errorMsg){
                          $errorMsgShow = $errorMsg;
                          break;
                       }
                       if($errorMsgShow != ""){
                            break;
                       }
                  }
                  $message = $errorMsgShow;
                }else{
                  $message = "Unable to add the saw child.";
                }
              $resultJ = json_encode(array('status' => '301' , 'message' => $message));
            }
          $this->json_response($resultJ);
        }
    }
	  /**
       *********************************************************************
       *  Function Name : childList()
       *  Functionality : child List
       *********************************************************************
    **/
    public function childList()
    {  
			if ($this->request->is('post')) {
				$anganwadi_id = isset($this->request->data['anganwadi_id']) ? $this->request->data['anganwadi_id'] : ""; 
        $rbsk_team_id = isset($this->request->data['rbsk_team_id']) ? $this->request->data['rbsk_team_id'] : "";             

        if( !empty($anganwadi_id) ){
            
            $this->check_empty($anganwadi_id, 'Please add anganwadi id');
            $childData = $this->DataChildren->find('all')->where( ['DataChildren.anganwadi_id' => $anganwadi_id])->toarray();
        
        }else if( !empty($rbsk_team_id) ){
            //Get children whose registeration completed with in a day
            //date_default_timezone_set("UTC");
            $created_at =  date( 'Y-m-d H:i:s', strtotime(' -1 day') );
            
            $childData = $this->DataChildren->find('all')->contain([
                                                        'Anganwadis'
                                                        ])->where(['DataChildren.created_at >'=> $created_at ])
                                                          ->andWhere(['Anganwadis.rbsk_team_id' => $rbsk_team_id])
                                                         
                                                          ->toArray();

        
        }

       // print_r($childData); die('--');

      
        
        if(!empty($childData)){
        

					foreach ($childData as $value) {
						$children_id = $value['id'];
						$worker_id = $value['worker_id'];
          //  echo $children_id.'--'.$worker_id; die('-');

					  $saw_name = $this->Workers->find('all')->where( ['Workers.id' => $worker_id])->first();
						$value['worker_name']=	$saw_name['name']; 

						$childHistorySaw = $this->SawChild->find('all',array('order'=>array('SawChild.id'=>'desc')))->where( ['SawChild.data_children_id' => $children_id])->contain([
                            'Workers' => function ($q) {
                                return $q->autoFields(false)
                                    ->select(['name']);
                            }
                        ])->toarray();
				        
				        $value['childHistorySaw']=	isset($childHistorySaw) ? $childHistorySaw : array(); 

						    $childHistorySam = $this->SamChild->find('all',array('order'=>array('SamChild.id'=>'desc')))->where( ['SamChild.data_children_id' => $children_id])->contain([
                            'Workers' => function ($q) {
                                return $q->autoFields(false)
                                    ->select(['name']);
                            }
                        ])->toarray();
					
				        $value['childHistorySam'] =	isset($childHistorySam) ? $childHistorySam : array(); 
				}
				
            $resultJ = json_encode(array('status' => '200' , 'message' => 'Child list' , 'data' => $childData));
			  }else{
				    $resultJ = json_encode(array('status' => '200' , 'message' => 'Record not found', 'data' => array() ));
			  }
        
			  $this->json_response($resultJ);
		  }
	  }
	  /**
       *********************************************************************
       *  Function Name : ResultsList() .
       *  Functionality : Results List
       *********************************************************************
    **/
    public function ResultsList()
    {  
			
			if ($this->request->is('post')) {
				
				    $sawresults = $this->SawResult->find('all')->toarray();
					$samresults = $this->SamResult->find('all')->toarray();
				if(!empty($sawresults)){
					$data = array();
					$data['samresults'] = isset($samresults) ? $samresults : array();
					$data['sawresults'] = isset($sawresults) ? $sawresults : array();
                    $resultJ = json_encode(array('status' => '200' , 'message' => 'Result list' , 'data' => $data));
			  }else{
				  $resultJ = json_encode(array('status' => '200' , 'message' => 'Record not found', 'data' => array() ));
			  }
			  $this->json_response($resultJ);
		  }
	  }
	   /**
       *********************************************************************
       *  Function Name : ResultsList_saw() .
       *  Functionality : Results List saw
       *********************************************************************
    **/
    public function resultsListSam()
    {  
			
			if ($this->request->is('post')) {
				$height = isset($this->request->data['height']) ? $this->request->data['height'] : ""; 
				$this->check_empty($height, 'Please add height');
				$weight = isset($this->request->data['weight']) ? $this->request->data['weight'] : ""; 
				$this->check_empty($weight, 'Please add weight');
				$gender = isset($this->request->data['gender']) ? $this->request->data['gender'] : ""; 
				$this->check_empty($gender, 'Please add gender');
				if($gender == 'Boy'){
                    $childInfo = $this->BoysSawChart->find('all',array('fields'=>array('1sd','2sd','3sd','4sd')))->where( ['BoysSawChart.height' => $height])->toArray();
				}else{
					 $childInfo = $this->GirlsSawChart->find('all',array('fields'=>array('1sd','2sd','3sd','4sd')))->where( ['GirlsSawChart.height' => $height])->toArray();
				}
				
                if(!empty($childInfo)){
					$childInfo_array = array('1sd'=>$childInfo[0]['1sd'],'2sd'=>$childInfo[0]['2sd'],'3sd'=>$childInfo[0]['3sd'],'4sd'=>$childInfo[0]['4sd']);
				
				$lessthan_value = array();
					 foreach ($childInfo_array as $key => $item) {
						if($weight >= $item){
							$lessthan_value[$key] = $item;
							break;
						}
				}
                $greatthan_value = array();
				   foreach ($childInfo_array as $key => $item) {
						if($weight <= $item){
							$greatthan_value[$key] = $item;
						}
					}
                   $greatthan_value = array_slice($greatthan_value, -1, 1, true);

					if(empty($greatthan_value)){
						$result = '1SD';
					}else{
						$result = key($greatthan_value);
					}
					
                    $resultJ = json_encode(array('status' => '200' , 'message' => 'Result list' , 'result' => strtoupper($result)));
			  }else{
				  $resultJ = json_encode(array('status' => '200' , 'message' => 'Record not found', 'result' => null));
			  }
			  $this->json_response($resultJ);
		  }
	  }

     /**
       *********************************************************************
       *  Function Name : ResultsList_saw() .
       *  Functionality : Results List saw
       *********************************************************************
    **/
    public function resultsListSuw()
    {  
      
      if ($this->request->is('post')) {
        $age = isset($this->request->data['age']) ? $this->request->data['age'] : ""; 
        $this->check_empty($age, 'Please add age');
        $weight = isset($this->request->data['weight']) ? $this->request->data['weight'] : ""; 
        $this->check_empty($weight, 'Please add weight');
        $gender = isset($this->request->data['gender']) ? $this->request->data['gender'] : ""; 
        $this->check_empty($gender, 'Please add gender');
        if($gender == 'Boy'){
                    $childInfo = $this->BoysSuwChart->find('all',array('fields'=>array('3sd','2sd','1sd','median','1sd_minus','2sd_minus','3sd_minus')))->where( ['BoysSuwChart.age' => $age])->toArray();
        }else{
           $childInfo = $this->GirlsSuwChart->find('all',array('fields'=>array('1sd','2sd','3sd','median','1sd_minus','2sd_minus','3sd_minus')))->where( ['GirlsSuwChart.age' => $age])->toArray();
        }
                if(!empty($childInfo)){
          $childInfo_array = array('3sd'=>$childInfo[0]['3sd'],'2sd'=>$childInfo[0]['2sd'],'1sd'=>$childInfo[0]['1sd'], 'median'=>$childInfo[0]['median'],'1sd_minus'=>$childInfo[0]['1sd_minus'],'2sd_minus'=>$childInfo[0]['2sd_minus'],'3sd_minus'=>$childInfo[0]['3sd_minus'],);
        
        // print_r($childInfo_array); 
        $lessthan_value = array();
           foreach ($childInfo_array as $key => $item) {
            if($weight >= $item){
              $lessthan_value[$key] = $item;
              break;
            }
        }
                $greatthan_value = array();
           foreach ($childInfo_array as $key => $item) {
            if($weight <= $item){
              $greatthan_value[$key] = $item;
            }
          }
                   $greatthan_value = array_slice($greatthan_value, -1, 1, true);

          if(empty($greatthan_value)){
            $result = '3sd';
          }else{
            $result = key($greatthan_value);
          }
          // echo '-'.$result.'-';
          if($result == '3sd_minus' || $result == '2sd_minus'){
            $result = 'SUW';
          }
          elseif($result == '1sd_minus' || $result == 'median'){
            $result = 'MUW';
          }
          elseif($result == '1sd' || $result == '2sd' || $result == '3sd'){
            $result = 'Normal';
          }
          else{
            $result = "No Result";
          }
         

          
                    $resultJ = json_encode(array('status' => '200' , 'message' => 'Result list' , 'result' => strtoupper($result)));
        }else{
          $resultJ = json_encode(array('status' => '200' , 'message' => 'Record not found', 'result' => null));
        }
        $this->json_response($resultJ);
      }
    }

	  /**
       *********************************************************************
       *  Function Name : childList().
       *  Functionality : child List
       *********************************************************************
    **/
    public function anganwadisList()
    {  
			$rbsk_team_id = isset($this->request->data['rbsk_team_id']) ? $this->request->data['rbsk_team_id'] : ""; 
				$this->check_empty($rbsk_team_id, 'Please add Team id');
			if ($this->request->is('post')) {
			    $AnganwadisData = 	$this->Anganwadis->find('all')->where( ['Anganwadis.rbsk_team_id' => $rbsk_team_id])->toarray();									
			if(!empty($AnganwadisData)){
					
                    $resultJ = json_encode(array('status' => '200' , 'message' => 'Anganwadis list' , 'data' => $AnganwadisData));
			  }else{
				  $resultJ = json_encode(array('status' => '200' , 'message' => 'Record not found', 'data' => array() ));
			  }
			  $this->json_response($resultJ);
		  }
	  }
/**
       *********************************************************************
       *  Function Name : forgotPassword() .
       *  Functionality : forgotPassword verification code send on email
       *********************************************************************
    **/
    function forgotPassword(){
       // $this->autoRender = false; 
        
      if($this->request->is('post')==1){
        $email = isset($this->request->data['email']) ? $this->request->data['email'] : "";
        $this->check_empty($email, 'Please add email');

        $userData = $this->Workers->newEntity();
        
            if(isset($this->request->data['email']) && $this->request->data['email']!=''){
                
                $user = $this->Workers->find('all',['conditions' => ['Workers.email' => $this->request->data['email']]]);
                $getUserData =  $user->first();
                
                if(empty($getUserData)){
                   $resultJ = json_encode(array('status' => '301' , 'message' => 'Email id not register with us, try again'));
                }else{
                    
                   
                    $password  = mt_rand(100000, 999999);
					$password_hashed = $this->hasherGenerater($password);
					
                    $data_arr = new \stdClass(); 
					$data_arr->password = $password;
					$data_arr->email =$getUserData->email;
					$data_arr->name = $getUserData->name;
					$data_arr->username = $getUserData->username;
                   
                    //Send email function
                    $this->sendmail($data_arr);
					$conditions = array('email'=>$email);
                    $fields = array('password' => $password_hashed);
                    $this->Workers->updateAll($fields, $conditions);
                    $resultJ = json_encode(array('status' => '200' , 'message' => 'Your Username and new Password has been sent to your email.','data' => $data));
                }
            }else{
                $resultJ = json_encode(array('status' => '200' , 'message' => 'Something went wrong'));
            }
            $this->json_response($resultJ);
        }
    }
    /**
       *********************************************************************
       *  Function Name : checkUserSuspend() .
       *  Functionality : Check user suspended or not
       *********************************************************************
    **/
    
		private function checkUserSuspend($userId = null){
				$this->checkUserId($userId);
				$user = $this->Users->find('all',['conditions' => ['Users.id' => $userId]]);
				$userData = $user->first();
				if($userData->status == 0){
					 $resultJ = json_encode(array('status' => '303' , 'message' => "Your account has been de-activated by admin/agent."));
					 $this->json_response($resultJ);  
				}
		}
		
		/**
		   *********************************************************************
		   *  Function Name : checkUserId() .
		   *  Functionality : Check user existence
		   *********************************************************************
		**/
    private function checkUserId($userId = null){   
				$user = $this->Users->find('all',['conditions' => ['Users.id' => $userId]]);
				$userData = $user->first();
				if(empty($userData)){
					 $resultJ = json_encode(array('status' => '302' , 'message' => "User id not exists."));
					 $this->json_response($resultJ);  
				}
		}
 function sendmail($data_arr =array()){
     
  	
		$email_to = $data_arr->email;
		$name = ucfirst($data_arr->name);
		$username = $data_arr->username;
		$password = $data_arr->password;

   	$template_info = "Hi $name,</br></br>

  	<div>Your password for Swaasth Maap is</div><br/>
  	<table>
	
	 <tr>
  	<td>Username : </td>
  	<td>$username</td>
  	</tr>
    <tr>
  	<td>Password : </td>
  	<td>$password</td>
  	</tr>
  	</table>
	</br>
  	<div>Regards,<br/>Swaasth Maap Team</div>
  	";

  	$this->Email = new Email();
    $this->Email->transport('gmail'); 
    $customSubject = "Swaasth Maap Forgot Password.";
    try { 
            $res = $this->Email->from(['vishal.kumar@mobilyte.com' => "Swaasth Maap Forgot Password"])
          ->emailFormat('both') 
                  ->to($email_to)
                  ->subject('Forgot Password')                   
                  ->send($template_info);
      } 
    catch (Exception $e) 
    {
      echo 'Exception : ',  $e->getMessage(), "\n";
    }

  }
  public function sendGoogleCloudMessage_old()
    {
		$title ='test'; 
		$to = 10;
        $apiKey = 'AIzaSyAWArvb_NV3DZf_TkSn_uN3vouuHpWrwa8';   //// firebase server key
        $url = 'https://fcm.googleapis.com/fcm/send';
        $badge = 0;
        $sound = 'default';
        $date_time = date('Y-m-d H:i:s', time());
        $time_zone = date_default_timezone_get();
        $topic =  "/topics/sam10";

      
       $headers = array(
            'Authorization:key=' . 'AIzaSyAWArvb_NV3DZf_TkSn_uN3vouuHpWrwa8',
            'Content-Type:application/json'
        );


        $notification_data = array(    //// when application open then post field 'data' parameter work so 'message' and 'body' key should have same text or value
           
            'badge' => $badge,
            'receiver_id' => $to,
            'date_time' => $date_time,
            'time_zone' => $time_zone
        );
        $post = array(
            'to'         => $topic,
            'notification' => array('title' => 'Working Good', 'body' => 'That is all we want'),
			"content_available" => true,
            'data' => array('message' => 'dd')
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        $result = curl_exec($ch);
        var_dump($result);die;
        curl_close($ch);

        return $result;
		  die;
		
       /* if ($result->message_id) {
            //insert notification in db
           /* $insert_data = [
                'sender_id' => $from,
                'receiver_id' => $to,
                'notification_type' => $type,
                'alert' => $title,
            ];
            $this->db->insert('ws_notifications', $insert_data);
            return 1;
        } else {
            return 0;
        }*/
       // curl_close($ch);
		//die;
    }
    function sendGoogleCloudMessage($to=16,$body=''){
		
	    $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
		$topic =  "/topics/sam".$to;
		$fields = array(
            'to'         => $topic,
            'notification' => array('title' => 'Swaasth Maap', 'body' => 'That is all we want'),
			"content_available" => true,
            'data' => array('message' => 'dd')
        );
		 $headers = array(
            'Authorization:key=' . 'AIzaSyAWArvb_NV3DZf_TkSn_uN3vouuHpWrwa8',
            'Content-Type:application/json'
        );		
		$ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
        $result = curl_exec($ch);
        $result= json_decode($result);
        if ($result->message_id) {
            //insert notification in db
           /* $insert_data = [
                'sender_id' => $from,
                'receiver_id' => $to,
                'notification_type' => $type,
                'alert' => $title,
            ];
            $this->db->insert('ws_notifications', $insert_data);*/
			$insert_data = [
                'recevier_id' => $to,
                'Body' => $body,
                'chilldren_count' => 2,
                'rbsk_team_id' => 2
            ];
			$notification = $this->Notification->newEntity();
			$notification = $this->Notification->patchEntity($notification, $insert_data);
            $this->Notification->save($notification);
            return 1;
        } else {
            return 0;
        }
        curl_close($ch);
     }

}
?>
