<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Core\Configure;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

use Cake\Validation\Validation;

require_once(ROOT . DS  . 'vendor' . DS  . 'FedEx' . DS . 'TrackService'. DS . 'Track.php');
use Track;

require_once(ROOT . DS  . 'vendor' . DS  . 'firebase' . DS . 'Firebase.php');
use Firebase;

class ChildrenController extends AppController
{
 
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
      //  $this->Auth->allow(['generateQrCode','autoImportOrders']);
        $this->viewBuilder()->layout('admin_inner');
    }
    
    public function index(){   
       return $this->redirect(['action' => 'dashboard']);
    }

    public function listing()
    {   
     
        $roles = Configure::read('users.roles');
        $this->loadModel('DataChildren');
        $this->loadModel('SamChild');
        $this->loadModel('SawChild');
        $this->loadModel('RbskTeams');
        $this->set('roles', $roles);
        $query = $this->DataChildren->find('all')->contain(['SamChild'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select(['SamChild.sam_result_id','SamChild.id','SamChild.data_children_id'])->order(['SamChild.id'=>'DESC']);
                                                        },'SawChild'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select(['SawChild.saw_result_id','SawChild.id','SawChild.data_children_id'])->order(['SawChild.id'=>'DESC']);
                                                        },'Workers'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select(['Anganwadis.name', 'Workers.name'])->contain(['RbskTeams']);
                                                        }]])->order(['Anganwadis.name' => 'ASC'])->toArray();
       
        $subquery = $this->SamChild->find('all',array('fields' => array('id' => 'MAX(SamChild.id)')))->autoFields(false)->group('SamChild.data_children_id');
        
        $subquerySAW = $this->SawChild->find('all',array('fields' => array('id' => 'MAX(SawChild.id)')))->autoFields(false)->group('SawChild.data_children_id');
       
        $sam_chilldren = $this->SamChild->find('all')->where(['id IN'=> $subquery])->order(['SamChild.id' => 'DESC'])->toArray();
        $saw_chilldren = $this->SawChild->find('all')->where(['id IN'=> $subquerySAW])->order(['SawChild.id' => 'DESC'])->toArray();
        
    $this->set('aw_data', $query);
    $this->set('sam_chilldren', $sam_chilldren);
    $this->set('saw_chilldren', $saw_chilldren);
   
    }

    public function listingSam($id = null)
    {   
       
      $id = convert_uudecode(base64_decode($id));
    
      $roles = Configure::read('users.roles');
      $this->loadModel('SamChild');
      $this->set('roles', $roles);
      $query = $this->SamChild->find('all')->where(['data_children_id'=>$id])->contain(['DataChildren','Workers'])->order(['SamChild.created_at' => 'DESC']);
      
      $this->set('sam_data', $query);
    }

    public function listingSaw($id = null)
    {   
      $id = convert_uudecode(base64_decode($id));
     
      $roles = Configure::read('users.roles');
      $this->loadModel('SawChild');
      $this->set('roles', $roles);
      $query = $this->SawChild->find('all')->where(['data_children_id'=>$id])->contain(['DataChildren'])->order(['SawChild.created_at' => 'DESC']);
     
      $this->set('saw_data', $query);
    }
}

?>