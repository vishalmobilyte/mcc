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

class OrdersController extends AppController
{
 
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['generateQrCode','autoImportOrders']);
        $this->viewBuilder()->layout('admin_inner');
    }
    
    public function index(){   
       return $this->redirect(['action' => 'dashboard']);
    }
    
    public function openOrders(){   

        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');

        $user_id = $this->Auth->user('id');
        $role = $this->Auth->user('role');
        
        if($role=='1' ||  $role=='2'){  
            $orders = $this->Orders->find('all')    
                                   ->where(['Orders.status' => 1]);
            $this->set(compact('orders'));
            $this->render('open_orders_admin'); 
            
        }else if($role=='3'){
            $open_orders = $this->OrderAssignments->find('all')
                    ->where(['OrderAssignments.assign_to' => $user_id,'OrderAssignments.status_to' => 1])
                    ->contain(['Orders','OrderPackages'])
                    ->group('OrderAssignments.order_id')
                    ->hydrate(false)
                    ->toArray();
           //pr($open_orders); die;
            $this->set(compact('open_orders'));    
            $this->render('open_orders_agent');     
        }else{
            $open_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status IN' => [1,2]])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->group('OrderAssignmentLogs.order_id')        
                ->toArray();        
          //pr($open_orders);die;
            $this->set(compact('open_orders'));
            $this->render('open_orders_driver'); 
        }
    }
   
	public function newOrders(){   

		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderAssignmentLogs');

		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		
		if($role=='4'){
			$open_orders = $this->OrderAssignmentLogs->find('all')
				->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status' => 1])
				->contain(['OrderAssignments'=>['Orders','OrderPackages']])
				->group('OrderAssignmentLogs.order_id')
				->toArray();        
			//pr($open_orders); die;
			$this->set(compact('open_orders'));
			$this->render('open_orders_driver'); 
		}else{
			
			 $this->Flash->error(__('You are not authorize for this page.'));
             return $this->redirect(['controler' => 'users','action' => 'dashboard']);
		}
	}
	
	public function rejectedOrders(){   

		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderAssignmentLogs');

		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		
		if($role=='4'){
			$open_orders = $this->OrderAssignmentLogs->find('all')
				->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status' => 4])
				->contain(['OrderAssignments'=>['Orders','OrderPackages']])
				->group('OrderAssignments.order_id')
				->toArray();        
		
			$this->set(compact('open_orders'));
			$this->render('open_orders_driver'); 
		}else{
			
			 $this->Flash->error(__('You are not authorize for this page.'));
             return $this->redirect(['controler' => 'users','action' => 'dashboard']);
		}
	}
	
	public function orderAction($orderID,$action){   
	
		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		if($role != 4){
			
			$this->Flash->error(__('You are not authorize for this page.'));
            return $this->redirect(['controler' => 'users','action' => 'dashboard']);
		
		}else{
		
			$order_assignment_log_id = convert_uudecode(base64_decode($orderID));
			$this->loadModel('OrderAssignments');
			$this->loadModel('OrderAssignmentLogs');
			$this->loadModel('UserLogs');
			
			//Update the status into order assignment log table
			$OrderAssignmentLogsData = $this->OrderAssignmentLogs->newEntity();
			$OrderAssignmentLogsData->status = $action;
			$OrderAssignmentLogsData->id = $order_assignment_log_id;
			//pr($OrderAssignmentLogsData);die;
			if($this->OrderAssignmentLogs->save($OrderAssignmentLogsData)){
				
				//Update status on order assignement table if driver reject the order
				$orderAssignResults= $this->OrderAssignmentLogs->get($order_assignment_log_id,['contain'=>['driver_detail','agent_detail','OrderAssignments'=>['Orders','OrderPackages']]]);
				$agent_email = $orderAssignResults['agent_detail']['email'];
				$agent_name = $orderAssignResults['agent_detail']['name'];
				$driver_email = $orderAssignResults['driver_detail']['email'];
				$driver_name = $orderAssignResults['driver_detail']['name'];
				
				$order_id = $orderAssignResults['order_id'];
				$pkg_no = $orderAssignResults['order_assignment']['order_package']['package_number'];
				$pkg_id = $orderAssignResults['order_assignment']['order_package']['id'];
				$order_number = $orderAssignResults['order_assignment']['order']['descrates_app_id'];
				$pkg_title = $orderAssignResults['order_assignment']['order_package']['package_title'];
				$action_for_email='Accepted';
				
				if($action==4){
				
					$OrderAssignmentsData = $this->OrderAssignments->newEntity();
					$OrderAssignmentsData->status_to = 1;
					$OrderAssignmentsData->id = $orderAssignResults['order_assignment_id'];
					
					$this->OrderAssignments->save($OrderAssignmentsData);
					$action_for_email='Rejected';	
				}
				
				/*Update Data into log table Start*/
				$UserLogs = $this->UserLogs->newEntity();
				$UserLogs->notification_from = $this->Auth->user('id');
				$UserLogs->notification_to =$orderAssignResults['agent_detail']['id'];
				$UserLogs->order_id = $order_id;
				$UserLogs->package_id = $pkg_id;
				$UserLogs->notification_type = 'order';
				$UserLogs->description = "Order has been $action_for_email by ".ucwords($this->Auth->user('name'));
				$this->UserLogs->save($UserLogs);
				/*Update Data into log table End*/
				
				$replace = array('{agent_name}','{driver_name}','{action}','{order_id}','{pkg_number}','{pkg_title}');
				$with = array($agent_name, $driver_name, $action_for_email, $order_id, $pkg_no, $pkg_title);
				
				//Send email function
				$this->send_email('',$replace,$with,'order_response_to_agent',$agent_email);
				$this->send_email('',$replace,$with,'order_response_to_driver',$driver_email);
				//SET Email Content Of Pkg
			
			}
			
			//Start send notification 
				$badgeCount = $this->getNotificationBadgesCount($orderAssignResults['agent_detail']['id']);
				$params = [
					'type' => 'assinOrder', 
					'badgeCount' => $badgeCount, 
					'package_id' =>$pkg_id,
					'order_id' => $order_id,
					'order_number' => $order_number,
					'notification_type' => 'order',
					'topic' => 'sky2c'.$orderAssignResults['agent_detail']['id'],
					'notifyId' => $orderAssignResults['agent_detail']['id']
				];
				$message =  "Order has been $action_for_email by ".ucwords($this->Auth->user('name'));

				$firebase = new Firebase();
				$firebase->firebaseCloudMessage($params,$message); 
			//End notification
			
			
			$this->Flash->success(__('Response has been sent to agent.'));
            return $this->redirect(['controller' => 'users','action' => 'dashboard']);
		
		}
		
	}
	
	public function bulkOrderAction($orderID,$action){   

		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		
		if($role != 4){
			
			$this->Flash->error(__('You are not authorize for this page.'));
            return $this->redirect(['controler' => 'users','action' => 'dashboard']);
		
		}else{
		
			$order_assignment_log_id = convert_uudecode(base64_decode($orderID));
			$this->loadModel('OrderAssignments');
			$this->loadModel('OrderAssignmentLogs');
			$this->loadModel('UserLogs');
			
			
			$orderAssignResults= $this->OrderAssignmentLogs->find('all')->where(['order_id' => $order_assignment_log_id,'assign_to' => $user_id,'status' => 1])->hydrate(false)->toArray();
		
			if(!empty($orderAssignResults)){
				foreach($orderAssignResults as $orderAssignLogVal){
					
					//Update the status into order assignment log table
					$OrderAssignmentLogsData = $this->OrderAssignmentLogs->newEntity();
					$OrderAssignmentLogsData->status = $action;
					$OrderAssignmentLogsData->id = $orderAssignLogVal['id'];
					
					if($this->OrderAssignmentLogs->save($OrderAssignmentLogsData)){
						
						//Update status on order assignement table if driver reject the order
						$orderAssignResults= $this->OrderAssignmentLogs->get($orderAssignLogVal['id'],['contain'=>['driver_detail','agent_detail','OrderAssignments'=>['Orders','OrderPackages']]]);
						$agent_email = $orderAssignResults['agent_detail']['email'];
						$agent_id = $orderAssignResults['agent_detail']['id'];
						$agent_name = $orderAssignResults['agent_detail']['name'];
						$driver_id = $orderAssignResults['driver_detail']['id'];
						$driver_email = $orderAssignResults['driver_detail']['email'];
						$driver_name = $orderAssignResults['driver_detail']['name'];
						
						$order_id = $orderAssignResults['order_id'];
						$pkg_no = $orderAssignResults['order_assignment']['order_package']['package_number'];
						$pkg_id = $orderAssignResults['order_assignment']['order_package']['id'];
						$pkg_title = $orderAssignResults['order_assignment']['order_package']['package_title'];
						$order_number = $orderAssignResults['order_assignment']['order']['descrates_app_id'];
						$action_for_email='Accepted';
						
						if($action==4){
						
							$OrderAssignmentsData = $this->OrderAssignments->newEntity();
							$OrderAssignmentsData->status_to = 1;
							$OrderAssignmentsData->id = $orderAssignResults['order_assignment_id'];
							
							$this->OrderAssignments->save($OrderAssignmentsData);
							$action_for_email='Rejected';	
						}
						
						
					}
					/*Update Data into log table Start*/
					$UserLogs = $this->UserLogs->newEntity();
					$UserLogs->notification_from = $driver_id;
					$UserLogs->notification_to =$agent_id;
					$UserLogs->order_id = $order_id;
					$UserLogs->package_id = $pkg_id;
					$UserLogs->notification_type = 'order';
					$UserLogs->description = "Order has been $action_for_email by ".ucwords($this->Auth->user('name'));
					$this->UserLogs->save($UserLogs);
					/*Update Data into log table End*/
				}
				
			
				
				$replace = array('{agent_name}','{driver_name}','{action}','{order_id}','{pkg_number}','{pkg_title}');
				$with = array($agent_name, $driver_name, $action_for_email, $order_id, $pkg_no, $pkg_title);
				
				//Send email function
				$this->send_email('',$replace,$with,'order_response_to_agent',$agent_email);
				$this->send_email('',$replace,$with,'order_response_to_driver',$driver_email);
				//SET Email Content Of Pkg
				$this->Flash->success(__('Response has been sent to agent.'));
				return $this->redirect(['controller' => 'users','action' => 'dashboard']);

			}
			//Start send notification 
				$badgeCount = $this->getNotificationBadgesCount($agent_id);
				$params = [
					'type' => 'assinOrder', 
					'badgeCount' => $badgeCount, 
					'topic' => 'sky2c'.$agent_id,
					'package_id' =>$pkg_id,
					'order_id' => $order_id,
					'order_number' => $order_number,
					'notification_type' => 'order',
					'notifyId' => $agent_id
				];
				$message =  "Order has been $action_for_email by ".ucwords($this->Auth->user('name'));

				$firebase = new Firebase();
				$firebase->firebaseCloudMessage($params,$message); 
			//End notification
			
		}
		
	}
	
    public function AssignedOrders($filter=null){   

        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');

        $conditions =array();
        $user_id = $this->Auth->user('id');
        $role = $this->Auth->user('role');
        
        if($role=='1' ||  $role=='2'){  
        
            
            $orders = $this->Orders->find('all')
                                   ->where(['Orders.status' => 2]);
        
            $this->set(compact('orders'));
            $this->render('open_orders_admin'); 
            
        }else if($role=='3'){
        
           $assigned_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_by' => $user_id,'OrderAssignmentLogs.status IN' => [1,2]])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->group(['OrderAssignmentLogs.order_id'])
               
                ->toArray();
          //  pr($assigned_orders) ; die;
            $this->set(compact('assigned_orders'));     
            $this->render('assign_orders_agent'); 
        
        }else{
            $completed_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status' => 3])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->toArray();        
      
            $this->set(compact('completed_orders'));
            $this->render('assign_orders_driver');
        }
    }
    
    public function completedOrders(){   
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');

        $user_id = $this->Auth->user('id');
        $role = $this->Auth->user('role');
       
        if($role=='1' ||  $role=='2'){  
        
            $orders = $this->Orders->find('all')
                                   ->where(['Orders.status' => 3])
                                   ->group('Orders.id');
            $this->set(compact('orders'));
            $this->render('open_orders_admin'); 
        }else if($role=='3'){
            $completed_orders = $this->OrderAssignments->find('all')
                ->where(['OrderAssignments.assign_to' => $user_id,'OrderAssignments.status_to' => 3])
                ->contain(['Orders','OrderPackages'])
                ->group('OrderAssignments.order_id')
                ->toArray();
            //    pr($completed_orders); die;
            $this->set(compact('completed_orders'));
            $this->render('completed_orders_agent'); 
        
        }else{
            $completed_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status' => 3])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->group('OrderAssignmentLogs.order_id')
               
                ->toArray();   
               
			
            $this->set(compact('completed_orders'));
            $this->render('completed_orders_driver'); 
        }
    }
    
	public function openOrderDetail($id=null,$user_role=null,$req_user_id=null){
       
        
        $this->loadModel('ShippingCarriers');
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        $this->loadModel('OrderPackages');
        $this->loadModel('Users');

        $conditions=array();

        $id = convert_uudecode(base64_decode($id));
		$this->readNotification($id);
        $role = ($user_role !='')?$user_role:$this->Auth->user('role');
        $userID = ($req_user_id !='')?$req_user_id:$this->Auth->user('id');
        
        if($role=='1' ||  $role=='2'){ 
		   		   
           $order = $this->Orders->get( $id, ['contain' => ['OrderAssignmentLogs','OrderDetails','OrderLocations','OrderPackages' => ['OrderAssignments'],'customer_detail']]);
		   
		   //Get All packages which is not assigned yet	
		   $orderPackages = $this->OrderPackages->find('list',[
					'keyField' => 'id',
					'valueField' => 'package_title'
				])	
				->select('OrderPackages.id,OrderPackages.package_title')
				->where(['OrderPackages.status' => 1 , 'OrderPackages.order_id' => $id])
				->toArray();   
			//Get All Agent List which is under admin or staff 		
			$agentsLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])	
				->select('Users.id,Users.name')
				->where(['Users.role' =>3,'Users.status' =>1])
				->order(['Users.name' =>'ASC'])
				->toArray();   	
			
			$driversLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])	
				->select('Users.id,Users.name')
				->where(['Users.role' =>4,'Users.is_approved' =>1,'Users.status' =>1,'Users.parent_id' =>1])
				->order(['Users.name' =>'ASC'])
				->toArray();   		
			$providers = $this->ShippingCarriers->find('list',[
					'keyField' => 'id',
					'valueField' => 'carrier_name'
				])	
				->select('ShippingCarriers.id,ShippingCarriers.carrier_name')
				->where(['ShippingCarriers.status' =>1])
				->toArray();	
            $this->set(compact('order','orderPackages','agentsLists','providers','driversLists'));
            $this->render('open_order_detail_admin');
        }else if($role=='3'){
            $order = $this->OrderAssignments->find('all')->contain(['OrderPackages','Orders'=>['OrderDetails','OrderLocations','OrderPackages']])->where(['OrderAssignments.assign_to' => $userID, 'OrderAssignments.order_id' => $id, 'OrderAssignments.status_to' => 1])->toArray();
		
            //Get All Agent List which is under admin or staff 		
			$driversLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])	
				->select('Users.id,Users.name')
				->where(['Users.role' =>4,'Users.is_approved' =>1,'Users.status' =>1,'Users.parent_id' =>$this->Auth->user('id')])
				->order(['Users.name' =>'ASC'])
				->toArray();   	
			
			$providers = $this->ShippingCarriers->find('list',[
					'keyField' => 'id',
					'valueField' => 'carrier_name'
				])	
				->select('ShippingCarriers.id,ShippingCarriers.carrier_name')
				->where(['ShippingCarriers.status' =>1])
				->toArray();
            
            $this->set(compact('order','orderPackages','driversLists','providers'));
            $this->render('open_order_detail_agent');
        }else{
            $order = $this->OrderAssignmentLogs->find('all')
                  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID, 'OrderAssignmentLogs.status' => 2])
                  ->contain(['OrderAssignments' =>['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'] , 'OrderPackages']])->toArray();
           
            $this->set(compact('order'));
            $this->render('open_order_detail_driver');
        
        }
        // pr($order);die;
    }
        
    public function newOrderDetailDriver($id=null,$user_role=null,$req_user_id=null){
       
        $role = ($user_role!=null)?$user_role:$this->Auth->user('role'); 
        $userID = ($req_user_id!=null)?$req_user_id:$this->Auth->user('id'); 
        
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        $this->loadModel('OrderPackages');
        $this->loadModel('Users');

        $conditions=array();

       $id = convert_uudecode(base64_decode($id));
	   $this->readNotification($id);	
       $order = $this->OrderAssignmentLogs->find('all')
			  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID, 'OrderAssignmentLogs.status' => 1])
			  ->contain(['OrderAssignments' =>['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'] , 'OrderPackages']])->toArray();
		//pr($order);die;
		$this->set(compact('order'));
	    
    }
    
    public function rejectedOrderDetailDriver($id=null){
       
        $role = $this->Auth->user('role'); 
        $userID = $this->Auth->user('id');
        
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        $this->loadModel('OrderPackages');
        $this->loadModel('Users');

        $conditions=array();

		$id = convert_uudecode(base64_decode($id));
		$this->readNotification($id);
        $role = $this->Auth->user('role');
       
		$order = $this->OrderAssignmentLogs->find('all')
			  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID, 'OrderAssignmentLogs.status' => 4])
			  ->contain(['OrderAssignments' =>['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'] , 'OrderPackages']])->toArray();
		//pr($order);die;
		$this->set(compact('order'));
	    
    }
    
    public function completedOrderDetailDriver($id=null){
       
        $role = $this->Auth->user('role'); 
        $userID = $this->Auth->user('id');
        
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        $this->loadModel('OrderPackages');
        $this->loadModel('Users');

        $conditions=array();

		$id = convert_uudecode(base64_decode($id));
		$this->readNotification($id);
        $role = $this->Auth->user('role');
       
		$order = $this->OrderAssignmentLogs->find('all')
			  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID, 'OrderAssignmentLogs.status' => 3])
			  ->contain(['OrderAssignments' =>['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'], 'OrderPackages']])->toArray();
		
		$this->set(compact('order'));
	    
    }
    
    public function assignedOrderDetail($id,$user_role=null,$req_user_id=null){
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        $id = convert_uudecode(base64_decode($id));
        $this->readNotification($id);
        $role = ($user_role !='')?$user_role:$this->Auth->user('role');
        
        $userID = ($req_user_id !='')?$req_user_id:$this->Auth->user('id');
        
        if($role=='1' ||  $role=='2'){  
           
            $order = $this->Orders->get( $id, ['contain' => ['OrderPackages' => ['OrderAssignments']  , 'customer_detail']]);
        
        }else if($role=='3'){
       
            $order = $this->OrderAssignments->find('all')->contain(['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'] , 'OrderPackages'])->where(['OrderAssignments.assign_to' => $userID, 'OrderAssignments.order_id' => $id, 'OrderAssignments.status_to' => 2])->toArray();
            //pr($order[0]->order->descrates_app_id); die;
            $this->set(compact('order'));
            $this->render('open_order_detail_agent');
        }else{
            $order = $this->OrderAssignmentLogs->find('all')
                  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID , 'OrderAssignmentLogs.status' => 2])
                  ->contain(['OrderAssignments' =>['Orders'=>['customer_detail'] , 'OrderPackages']])->toArray();
            $this->set(compact('order'));
            $this->render('open_order_detail_driver');
        }
    }
    
    public function completedOrderDetail($id,$user_role=null,$req_user_id=null){
        
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
        
        $id = convert_uudecode(base64_decode($id));
		$this->readNotification($id);
        $role = ($user_role!='')?$user_role:$this->Auth->user('role');
        $userID = ($req_user_id!='')?$req_user_id:$this->Auth->user('id');
         

        if($role=='1' ||  $role=='2'){  
            
            $order = $this->Orders->get( $id, ['contain' => ['OrderPackages' => ['OrderAssignments'] , 'customer_detail']]);
			 $this->render('completed_order_detail_admin');
			 
         }else if($role=='3'){
            $order = $this->OrderAssignments->find('all')->contain(['OrderPackages','Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail']])->where(['OrderAssignments.assign_to' => $userID, 'OrderAssignments.order_id' => $id, 'OrderAssignments.status_to' => 3])->toArray();
         //pr($order);die;
            $this->set(compact('order'));
            $this->render('completed_order_detail_agent');
        }else{
                  
             $order = $this->OrderAssignmentLogs->find('all')
			  ->where(['OrderAssignmentLogs.order_id' => $id , 'OrderAssignmentLogs.assign_to' => $userID, 'OrderAssignmentLogs.status' => 3])
			  ->contain(['OrderAssignments' =>['Orders'=>['OrderDetails','OrderLocations','OrderPackages','customer_detail'] , 'OrderPackages']])->toArray();
			       
                 // pr($order[0]['order_id']);die;
            $this->set(compact('order'));
            $this->render('completed_order_detail_driver');
        
        }
    }
    
    public function packageDetail($id=null){

        $id = convert_uudecode(base64_decode($id));

        $role = $this->Auth->user('role');
        $userID = $this->Auth->user('id');
         $status = '';     
         
        $this->loadModel('OrderPackages'); 
        $package = $this->OrderPackages->get($id, ['contain' =>['OrderAssignments'=>['assign_agent_detail'],'OrderAssignmentLogs'=>['agent_detail','driver_detail','ShippingCarriers']]]);
	
		if($role==4){
			 $this->loadModel('OrderAssignmentLogs'); 
			 $packageData = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.package_id' => $id,'OrderAssignmentLogs.status' => 4,'OrderAssignmentLogs.assign_to' => $userID])
                ->first();
           if(!empty($packageData)){
				$status = ($packageData->status==4)?"Rejected":"";     
		   }
			  
		}
       //pr($package) ; die; 
                                                            
        $this->set(compact('package','status'));
    }
    
    public function assignOrder($id){
        $id = convert_uudecode(base64_decode($id));
        $order = $this->Orders->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            

            if ($this->Orders->save($order)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'orders-listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $order->convertedId = base64_encode(convert_uuencode($order->id));
        unset($order->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set(compact('order'));
    }
    
	public function editOrder($id = null){   
        $id = convert_uudecode(base64_decode($id));

        $order = $this->Orders->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            

            if ($this->Orders->save($user)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'orders-listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $order->convertedId = base64_encode(convert_uuencode($order->id));
        unset($order->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set(compact('order'));
    }
    
    public function add(){   
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->status = 1;
            $user->parent_id = $this->Auth->user('id');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $roles = Configure::read('users.roles');
        
        $userRole = $this->Auth->user('role');

        switch ( $userRole ) {
            case '1':
                unset($roles['1']);
                break;
            case '2':
                unset($roles['1']);
                unset($roles['2']);
                break;
            case '3':
                unset($roles['1']);
                unset($roles['2']);
                unset($roles['3']);
                break;
            default:
                break;
        }       
        $this->set('roles', $roles);
        //pr($user->errors());die;
        $this->set('user', $user);
    }
    
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) 
        {
            $this->Flash->success(__('The User has been deleted.'));
        } 
        else 
        {
            $this->Flash->error(__('The User could not be deleted. Please, try again.'));
        }        
        return $this->redirect(['action' => 'index']);
    }
	
	function viewAll($action){
		$userRole = $this->Auth->user('role');
		$loggedInUserId = $this->Auth->user('id');
		$userLogs = TableRegistry::get('userLogs');
		$action = convert_uudecode(base64_decode($action));
		
		/*Update Data into log table Start*/
		$query = $userLogs->query();
		$query->update()
			->set(['read_status' => 1])
			->where(['notification_to' => $loggedInUserId])
			->execute();
		return $this->redirect(['action' => 'orders','action' => $action]);	
		/*Update Data into log table End*/
	}
	
	function generateQrCode($productid){
		if($productid==''){
			$image =  "Please provide order id and product id for continue";
		}else{
			
			$QR_Code="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=".$productid; 
			$destination = realpath('../webroot/img/QR').'/'.'qr_'.$productid.'.jpg'; 
			$this->grab_image($QR_Code,$destination);
			$finalPath = HTTP_ROOT.'img/QR/'.'qr_'.$productid.'.jpg';
			$image1 = '<img src="'.$finalPath.'">';
			
					
			
			// For demonstration purposes, get pararameters that are passed in through $_GET or set to the default value
			//$filepath = (isset($_GET["filepath"])?$_GET["filepath"]:"");
			$text = (isset($productid)?$productid:"");
			$size = (isset($_GET["size"])?$_GET["size"]:"50");
			$orientation = (isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
			$code_type = (isset($_GET["codetype"])?$_GET["codetype"]:"code128b");
			$print = (isset($_GET["print"])&&$_GET["print"]=='true'?true:true);
			$sizefactor = (isset($_GET["sizefactor"])?$_GET["sizefactor"]:"1");

			// This function call can be copied into your project and can be made from anywhere in your code
			$destination1 = realpath('../webroot/img/QR').'/'.'bar_'.$productid.'.jpg'; 
			$image = $this->barcode($destination1, $text, $size, $orientation, $code_type, $print, $sizefactor );
			$finalPath = HTTP_ROOT.'img/QR/'.'bar_'.$productid.'.jpg';
			
			$image = '<img src="'.$finalPath.'">';
		}
		
		
		$this->set('code',$image);
		$this->set('code1',$image1);
	}
	
	function grab_image($url,$saveto){
		$ch = curl_init ($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$raw=curl_exec($ch);
		curl_close ($ch);
		if(file_exists($saveto)){
			unlink($saveto);
		}
		$fp = fopen($saveto,'x');
		fwrite($fp, $raw);
		fclose($fp);
	}
	
	function barcode( $filepath="", $text="0", $size="20", $orientation="horizontal", $code_type="code128", $print=false, $SizeFactor=1 ){
		$code_string = "";
		// Translate the $text into barcode the correct $code_type
		if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
			$chksum = 104;
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($text); $X++ ) {
				$activeKey = substr( $text, ($X-1), 1);
				$code_string .= $code_array[$activeKey];
				$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

			$code_string = "211214" . $code_string . "2331112";
		} elseif ( strtolower($code_type) == "code128a" ) {
			$chksum = 103;
			$text = strtoupper($text); // Code 128A doesn't support lower case
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($text); $X++ ) {
				$activeKey = substr( $text, ($X-1), 1);
				$code_string .= $code_array[$activeKey];
				$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

			$code_string = "211412" . $code_string . "2331112";
		} elseif ( strtolower($code_type) == "code39" ) {
			$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

			// Convert to uppercase
			$upper_text = strtoupper($text);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
			}

			$code_string = "1211212111" . $code_string . "121121211";
		} elseif ( strtolower($code_type) == "code25" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
			$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

			for ( $X = 1; $X <= strlen($text); $X++ ) {
				for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
					if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
						$temp[$X] = $code_array2[$Y];
				}
			}

			for ( $X=1; $X<=strlen($text); $X+=2 ) {
				if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
					$temp1 = explode( "-", $temp[$X] );
					$temp2 = explode( "-", $temp[($X + 1)] );
					for ( $Y = 0; $Y < count($temp1); $Y++ )
						$code_string .= $temp1[$Y] . $temp2[$Y];
				}
			}

			$code_string = "1111" . $code_string . "311";
		} elseif ( strtolower($code_type) == "codabar" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
			$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

			// Convert to uppercase
			$upper_text = strtoupper($text);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
					if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
						$code_string .= $code_array2[$Y] . "1";
				}
			}
			$code_string = "11221211" . $code_string . "1122121";
		}

		// Pad the edges of the barcode
		$code_length = 20;
		if ($print) {
			$text_height = 30;
		} else {
			$text_height = 0;
		}
		
		for ( $i=1; $i <= strlen($code_string); $i++ ){
			$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
			}

		if ( strtolower($orientation) == "horizontal" ) {
			$img_width = $code_length*$SizeFactor;
			$img_height = $size;
		} else {
			$img_width = $size;
			$img_height = $code_length*$SizeFactor;
		}

		$image = imagecreate($img_width, $img_height + $text_height);
		$black = imagecolorallocate ($image, 0, 0, 0);
		$white = imagecolorallocate ($image, 255, 255, 255);

		imagefill( $image, 0, 0, $white );
		if ( $print ) {
			imagestring($image, 5, 31, $img_height, $text, $black );
		}

		$location = 10;
		for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
			$cur_size = $location + ( substr($code_string, ($position-1), 1) );
			if ( strtolower($orientation) == "horizontal" )
				imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
			else
				imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
			$location = $cur_size;
		}
		
		// Draw barcode to the screen or save in a file
		if ( $filepath=="" ) {
			header ('Content-type: image/png');
			imagepng($image);
			imagedestroy($image);
		} else {
			imagepng($image,$filepath);
			imagedestroy($image);		
		}
	}
	
	public function checkOrderPackageStatusByAdmin($orderID=null){   
		$this->viewBuilder()->layout('');
		$this->request->data = @$_REQUEST;
		$this->loadModel('OrderPackages');
		$this->loadModel('ShippingCarriers');
		$this->loadModel('Users');
		$orderId = $this->request->data['orderid'];
        $OrderPackagesData = $this->OrderPackages->find('all')->where(['OrderPackages.order_id' => $orderId,'OrderPackages.status' => 1]);
     
        if($OrderPackagesData->count() <= 0){
			$msg = 'orderassignedalready';
		}else{
			$msg = 'orderassignementpending';
			$remainingPackages = $OrderPackagesData->contain(['Orders'])->hydrate(false)->toArray();
			//pr($remainingPackages); die;
			//Get All Agent List which is under admin or staff 		
			$driversLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])->select('Users.id,Users.name')
				->where(['Users.role' =>4,'Users.is_approved' =>1,'Users.status' =>1,'Users.parent_id' =>1])
				->order(['Users.name' =>'ASC'])
				->toArray(); 
				
			$agentLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])->select('Users.id,Users.name')
				->where(['Users.role' =>3,'Users.status' =>1])
				->order(['Users.name' =>'ASC'])
				->toArray(); 	
			$providers = $this->ShippingCarriers->find('list',[
					'keyField' => 'id',
					'valueField' => 'carrier_name'
				])	
				->select('ShippingCarriers.id,ShippingCarriers.carrier_name')
				->where(['ShippingCarriers.status' =>1])
				->toArray();		
			
			$this->set(compact('remainingPackages','agentLists','providers','driversLists','orderId','msg'));
		}
	}	
	
	public function assignedMainOrdersByAdmin($filter=null){   

        $this->request->data = @$_REQUEST;
		$order_info='';
		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderPackages');
		$this->loadModel('Orders');
		$this->loadModel('Users');
		$this->loadModel('UserLogs');
		$orderID = $this->request->data['order_id'];
		
		if(!empty($this->request->data)){
			if($this->request->data['optionsRadios']=='agent'){
				
				$notificationto = $this->request->data['agent']; //Using this id for user log table
				
				foreach($this->request->data['packages'] as $product_id){
					$pkgData='';				
					$assignData = $this->OrderAssignments->find('all')->where(['OrderAssignments.package_id' => $product_id])->count();
					if($assignData <= 0){
						$OrderAssignments = $this->OrderAssignments->newEntity();
						
						$OrderAssignments->assign_by = $this->Auth->user('id');
						$OrderAssignments->assign_to = $this->request->data['agent'];					
						$OrderAssignments->order_id = $orderID;
						$OrderAssignments->package_id = $product_id;
						$OrderAssignments->source = $this->request->data['source'];
						$OrderAssignments->destination = $this->request->data['destination'];
						$OrderAssignments->status_by = 2;
						$OrderAssignments->status_to = 1;
						if($this->OrderAssignments->save($OrderAssignments)){
														
							//Update the status into order pakage table as well
							$OrderPackagesData = $this->OrderPackages->newEntity();
							$OrderPackagesData->status = 2;
							$OrderPackagesData->id = $product_id;
							$this->OrderPackages->save($OrderPackagesData);
							//SET Email Content Of Pkg
							$pkgData = $this->OrderPackages->get($product_id);
							$order_info .= "<p>Package Number: ".$pkgData->package_number."</p>"; //Set email content;
							$order_info .= "<p>Package Title: ".$pkgData->package_title."</p>"; //Set email content;
						}
						
						/*Update Data into log table Start*/
						$UserLogs = $this->UserLogs->newEntity();
						$UserLogs->notification_from = $this->Auth->user('id');
						$UserLogs->notification_to = $notificationto;
						$UserLogs->order_id = $orderID;
						$UserLogs->package_id = $product_id;
						$UserLogs->notification_type = 'order';
						$UserLogs->description = "New order has been asigned by ".ucwords($this->Auth->user('name'));
						$this->UserLogs->save($UserLogs);
						/*Update Data into log table End*/	
											
					}
					
				}
								
			}else if($this->request->data['optionsRadios']=='thirdparty'){
				
				$notificationto = $this->Auth->user('id'); //Using this id for user log table
				
				foreach($this->request->data['packages'] as $product_id){
					$pkgData='';				
					$assignData = $this->OrderAssignments->find('all')->where(['OrderAssignments.package_id' => $product_id])->count();
					if($assignData <= 0){
						$OrderAssignments = $this->OrderAssignments->newEntity();
						
						$OrderAssignments->assign_by = $this->Auth->user('id');
						$OrderAssignments->assign_to = $this->Auth->user('id');					
						$OrderAssignments->order_id = $orderID;
						$OrderAssignments->package_id = $product_id;
						$OrderAssignments->source = $this->request->data['source'];
						$OrderAssignments->destination = $this->request->data['destination'];
						$OrderAssignments->status_by = 2;
						$OrderAssignments->status_to = 2;
						if($this->OrderAssignments->save($OrderAssignments)){
							
							$current_id = $OrderAssignments->id;
							
							$assignLogData = $this->OrderAssignmentLogs->find('all')->where(['OrderAssignmentLogs.order_assignment_id' => $current_id])->count();
							if($assignLogData <=0){
								$OrderAssignmentLogs = $this->OrderAssignmentLogs->newEntity();
						
								$OrderAssignmentLogs->order_assignment_id = $current_id;
								$OrderAssignmentLogs->assign_by = $this->Auth->user('id');
								$OrderAssignmentLogs->assign_to = $this->Auth->user('id');					
								$OrderAssignmentLogs->order_id = $orderID;
								$OrderAssignmentLogs->package_id = $product_id;
								$OrderAssignmentLogs->shipment_type = '3rdparty';
								$OrderAssignmentLogs->shipping_carrier_id =  $this->request->data['thirdparty_providers'];
								$OrderAssignmentLogs->tracking_number =  $this->request->data['tacking_id'];
								$OrderAssignmentLogs->source = $this->request->data['source'];
								$OrderAssignmentLogs->destination = $this->request->data['destination'];
								$OrderAssignmentLogs->status = 2;
								$this->OrderAssignmentLogs->save($OrderAssignmentLogs);
							}							
							//Update the status into order pakage table as well
							$OrderPackagesData = $this->OrderPackages->newEntity();
							$OrderPackagesData->status = 2;
							$OrderPackagesData->id = $product_id;
							$this->OrderPackages->save($OrderPackagesData);
							//SET Email Content Of Pkg
							$pkgData = $this->OrderPackages->get($product_id);
							$order_info .= "<p>Package Number: ".$pkgData->package_number."</p>"; //Set email content;
							$order_info .= "<p>Package Title: ".$pkgData->package_title."</p>"; //Set email content;
						}
											
					}
					
				}
								
			}else{
				
				$notificationto = $this->request->data['driver']; //Using this id for user log table
				
				foreach($this->request->data['packages'] as $product_id){
					$pkgData='';				
					$assignData = $this->OrderAssignments->find('all')->where(['OrderAssignments.order_id' => $orderID,'OrderAssignments.package_id' => $product_id])->count();
					if($assignData <= 0){
						$OrderAssignments = $this->OrderAssignments->newEntity();
						
						$OrderAssignments->assign_by = $this->Auth->user('id');
						$OrderAssignments->assign_to = $this->Auth->user('id');					
						$OrderAssignments->order_id  = $orderID;
						$OrderAssignments->package_id = $product_id;
						$OrderAssignments->source = $this->request->data['source'];
						$OrderAssignments->destination = $this->request->data['destination'];
						$OrderAssignments->status_by = 2;
						$OrderAssignments->status_to = 2;
						if($this->OrderAssignments->save($OrderAssignments)){
														
							//Update the status into order pakage table as well
							$OrderPackagesData = $this->OrderPackages->newEntity();
							$OrderPackagesData->status = 2;
							$OrderPackagesData->id = $product_id;
							$this->OrderPackages->save($OrderPackagesData);
							//SET Email Content Of Pkg
							
							$orderAssignResults= $this->OrderAssignments->find('all')->where(['OrderAssignments.package_id' => $product_id,'OrderAssignments.order_id' => $orderID])->first();
							
							$assignData = $this->OrderAssignmentLogs->find('all')->where(['OrderAssignmentLogs.order_assignment_id' => $orderAssignResults->id,'OrderAssignmentLogs.order_id' => $orderID,'OrderAssignmentLogs.status IN' => [1,2,3]])->count();
				
							if($assignData <= 0){
								
								$OrderAssignmentLogs = $this->OrderAssignmentLogs->newEntity();
								
								$OrderAssignmentLogs->assign_by = $this->Auth->user('id');
								$OrderAssignmentLogs->assign_to = $this->request->data['driver'];
								$OrderAssignmentLogs->status = 1;
																
								$OrderAssignmentLogs->order_id = $orderID;
								$OrderAssignmentLogs->package_id = $product_id;
								$OrderAssignmentLogs->order_assignment_id = $orderAssignResults->id;
								
								$OrderAssignmentLogs->source = $this->request->data['source'];
								$OrderAssignmentLogs->destination = $this->request->data['destination'];
								$OrderAssignmentLogs->shipping_carrier_id = isset($this->request->data['thirdparty_providers'])?$this->request->data['thirdparty_providers']:0;
								$OrderAssignmentLogs->shipment_type = $this->request->data['optionsRadios'];
								
								if($this->OrderAssignmentLogs->save($OrderAssignmentLogs)){
								
									//SET Email Content Of Pkg
									$pkgData = $this->OrderPackages->get($product_id);
									$order_info .= "<p>Package Number: ".$pkgData->package_number."</p>"; //Set email content;
									$order_info .= "<p>Package Title: ".$pkgData->package_title."</p>"; //Set email content;
								}
													
							}
						}
							/*Update Data into log table Start*/
							$UserLogs = $this->UserLogs->newEntity();
							$UserLogs->notification_from = $this->Auth->user('id');
							$UserLogs->notification_to = $notificationto;
							$UserLogs->order_id = $orderID;
							$UserLogs->package_id = $product_id;
							$UserLogs->notification_type = 'order';
							$UserLogs->description = "New order has been asigned by ".ucwords($this->Auth->user('name'));
							$this->UserLogs->save($UserLogs);
							/*Update Data into log table End*/					
					}
				}
				
			}	
			
			
		
			
			//Update the status into order table when all packages are assigned
			$allOrderPkgStatus = $this->OrderPackages->find('all')->where(['OrderPackages.status'=>1,'OrderPackages.order_id'=>$orderID])->count();
			if($allOrderPkgStatus <= 0){
				$OrdersData = $this->Orders->newEntity();
				$OrdersData->status = 2;
				$OrdersData->id = $orderID;
				$this->Orders->save($OrdersData);
			}
			
			$notificationUserDetail = $this->Users->get( $notificationto, ['contain' => [] ] );
							
			$order_info .= "<p>Order Id : $orderID</p>"; //Set email content;
			$order_info .= "<p>Source : ".$this->request->data['source']."</p>"; //Set email content;
			$order_info .= "<p>Destination : ".$this->request->data['destination']."</p>"; //Set email content;
			
			$replace = array('{agent_name}','{assign_by_email}','{assigned_by_name}','{order_info}');
			$with = array($notificationUserDetail->name, $this->Auth->user('email'), $this->Auth->user('name'), $order_info);
			
			//Send email function
			$this->send_email('',$replace,$with,'order_assign_to_agent',$notificationUserDetail->email);
			//End send email
			
			//Start send notification 
				$badgeCount = $this->getNotificationBadgesCount($notificationUserDetail->id);
				$orderDet = $this->Orders->get($orderID);
				$params = [
					'type' => 'assinOrder', 
					'badgeCount' => $badgeCount, 
					'package_id' =>$product_id,
					'order_id' => $orderID,
					'order_number' => $orderDet->descrates_app_id,
					'notification_type' => 'order',
					'topic' => 'sky2c'.$notificationUserDetail->id,
					'notifyId' => $notificationUserDetail->id
				];
				$message =  "Order has been assigned by ".ucwords($this->Auth->user('name'));

				$firebase = new Firebase();
				$firebase->firebaseCloudMessage($params,$message); 
			//End notification
			
			$this->Flash->success(__('Order assigned successfully.'));	
			$msg="Success:Order assigned successfully";
			
		}else{
			$msg="Error:Please slected all require fields";
		}
		echo $msg; die;
    }

	public function checkOrderPackageStatusByAgent(){   
		$this->viewBuilder()->layout('');
		$this->request->data = @$_REQUEST;
		
		$this->loadModel('ShippingCarriers');
		$this->loadModel('OrderAssignments');
		$this->loadModel('Users');
		
		$loggedInUserId = $this->Auth->user('id');
		$orderId = $this->request->data['orderid'];
		
        $OrderAssignments = $this->OrderAssignments->find('all')->contain(['OrderPackages','Orders'])->where(['OrderAssignments.order_id' => $orderId,'OrderAssignments.assign_to' => $loggedInUserId, 'OrderAssignments.status_to' => 1])->hydrate(false)->toArray();
       //pr($OrderAssignments)	; die;
        $remainingPackages=array();
        if(!empty($OrderAssignments)){
		
			foreach($OrderAssignments as $OrderAssignmentsVal){
				$remainingPackages[$OrderAssignmentsVal['order_package']['id']] = $OrderAssignmentsVal['order_package']['package_title'];
			}
		}
		
		if(count($remainingPackages) <= 0){
			$msg = 'orderassignedalready';
		}else{
			$msg = 'orderassignementpending';
			
			
			//Get All Agent List which is under admin or staff 		
			$driversLists = $this->Users->find('list',[
					'keyField' => 'id',
					'valueField' => 'name'
				])->select('Users.id,Users.name')
				->where(['Users.role' =>4,'Users.is_approved' =>1,'Users.status' =>1,'Users.parent_id' =>$loggedInUserId])
				->order(['Users.name' =>'ASC'])
				->toArray(); 
			$providers = $this->ShippingCarriers->find('list',[
					'keyField' => 'id',
					'valueField' => 'carrier_name'
				])	
				->select('ShippingCarriers.id,ShippingCarriers.carrier_name')
				->where(['ShippingCarriers.status' =>1])
				->toArray();	
		}
		$this->set(compact('remainingPackages','driversLists','providers','orderId','msg','OrderAssignments'));
	}	
		
	function assignOrderPackagesByAgent(){
		
		$this->request->data = @$_REQUEST;
		
		$order_info='';
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderPackages');
		$this->loadModel('Orders');
		$this->loadModel('Users');
		$this->loadModel('UserLogs');
		$orderID = $this->request->data['order_id'];
		
		if(!empty($this->request->data)){
				
			foreach($this->request->data['packages'] as $product_id){
				$pkgData='';				
				
				$orderAssignResults= $this->OrderAssignments->find('all')->where(['OrderAssignments.package_id' => $product_id,'OrderAssignments.order_id' => $orderID])->first();
				
				$assignData = $this->OrderAssignmentLogs->find('all')->where(['OrderAssignmentLogs.order_assignment_id' => $orderAssignResults->id,'OrderAssignmentLogs.order_id' => $orderID,'OrderAssignmentLogs.status IN' => [1,2,3]])->count();
				
				if($assignData <= 0){
					
					$OrderAssignmentLogs = $this->OrderAssignmentLogs->newEntity();
					
					$OrderAssignmentLogs->assign_by = $this->Auth->user('id');
					
					if(trim($this->request->data['optionsRadios'])=='self' || trim($this->request->data['optionsRadios'])=='thirdparty'){
					
						$OrderAssignmentLogs->assign_to = $this->Auth->user('id');
						$OrderAssignmentLogs->status = 2;
					
					}else if(trim($this->request->data['optionsRadios'])=='driver'){
					
						$OrderAssignmentLogs->assign_to = $this->request->data['driver'];
						$OrderAssignmentLogs->status = 1;
					
					}
					if(trim($this->request->data['optionsRadios'])=='thirdparty'){
						$OrderAssignmentLogs->tracking_number = $this->request->data['tacking_id'];
					}
					$OrderAssignmentLogs->order_id = $orderID;
					$OrderAssignmentLogs->package_id = $product_id;
					$OrderAssignmentLogs->order_assignment_id = $orderAssignResults->id;
					
					$OrderAssignmentLogs->source = $this->request->data['source'];
					$OrderAssignmentLogs->destination = $this->request->data['destination'];
					$OrderAssignmentLogs->shipping_carrier_id = isset($this->request->data['thirdparty_providers'])?$this->request->data['thirdparty_providers']:0;
					$OrderAssignmentLogs->shipment_type = $this->request->data['optionsRadios'];
					
					if($this->OrderAssignmentLogs->save($OrderAssignmentLogs)){
						
						//Update the status into order pakage table as well
						$OrderAssignmentsData = $this->OrderAssignments->newEntity();
						$OrderAssignmentsData->status_to = 2;
						$OrderAssignmentsData->id = $orderAssignResults->id;
            			$this->OrderAssignments->save($OrderAssignmentsData);
            			//SET Email Content Of Pkg
            			$pkgData = $this->OrderPackages->get($product_id);
            			$order_info .= "<p>Package Number: ".$pkgData->package_number."</p>"; //Set email content;
            			$order_info .= "<p>Package Title: ".$pkgData->package_title."</p>"; //Set email content;
					}
					
					/*Update Data into log table Start*/
					$UserLogs = $this->UserLogs->newEntity();
					$UserLogs->notification_from = $this->Auth->user('id');
					$UserLogs->notification_to = $OrderAssignmentLogs->assign_to;
					$UserLogs->order_id = $orderID;
					$UserLogs->package_id = $product_id;
					$UserLogs->notification_type = 'order';
					$UserLogs->description = "New order has been asigned by ".ucwords($this->Auth->user('name'));
					$this->UserLogs->save($UserLogs);
					/*Update Data into log table End*/		
										
				}
				
			}
			
			if(!empty($this->request->data['driver'])){
				$assignTo = $this->request->data['driver'];
			}else{
				$assignTo = $this->Auth->user('id');
			}	
			$driverDetail = $this->Users->get($assignTo, ['contain' => [] ] );
			//Start send notification 
				$badgeCount = $this->getNotificationBadgesCount($assignTo);
				$orderDet = $this->Orders->get($orderID);
				$params = [
					'type' => 'assinOrder', 
					'badgeCount' => $badgeCount, 
					'package_id' =>$product_id,
					'order_id' => $orderID,
					'order_number' => $orderDet->descrates_app_id,
					'notification_type' => 'order',
					'topic' => 'sky2c'.$assignTo,
					'notifyId' => $assignTo
				];
				$message =  "Order has been asigned by ".ucwords($this->Auth->user('name'));

				$firebase = new Firebase();
				$firebase->firebaseCloudMessage($params,$message); 
			//End notification			
			$order_info .= "<p>Order Id : $orderID</p>"; //Set email content;
			$order_info .= "<p>Source : ".$this->request->data['source']."</p>"; //Set email content;
			$order_info .= "<p>Destination : ".$this->request->data['destination']."</p>"; //Set email content;
			
			$replace = array('{agent_name}','{assign_by_email}','{assigned_by_name}','{order_info}');
			$with = array($driverDetail->name, $this->Auth->user('email'), $this->Auth->user('name'), $order_info);
			
			//Send email function
			$this->send_email('',$replace,$with,'order_assign_to_agent',$driverDetail->email);
			
			//End send email
			$this->Flash->success(__('Order assigned successfully.'));	
			
			
            $msg="Success:Order assigned successfully";
			
		}else{
			$msg="Error:Please slected all require fields";
		}
		echo $msg; die;
	}
	
	function trackOrder($descrates_app_id=null){
		
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderTracking');
		$this->loadModel('Orders');
		
		//Descartes ID
		$descrates_app_id = isset($this->request->data['order_id'])?$this->request->data['order_id']:$descrates_app_id; 		
		$trackingRecords=array();
		if(!empty($descrates_app_id)){
			
			//GET THE DATA FROM ORDER TABLE USING DESCARTES APP ID
			$orderData = $this->Orders->find('all')
							  ->where(['Orders.descrates_app_id' => $descrates_app_id,'Orders.status IN' => [2,3]])
							  ->contain(['OrderPackages'])
							  ->hydrate(false);
			
			//CHECK DATA IS AVAILABLE OR NOT
			if($orderData->count() > 0){
				$trackingRecords = $orderData->toArray();
				
				$this->readNotification($trackingRecords[0]['id']);
			}else{
				$msg = 'Order not found.';
			}
			
		}else{
			$msg = 'Please provide order id.';
		}
		
		$this->set(compact('trackingRecords','descrates_app_id','msg'));

	}
	
	function trackPackage($orderID=null,$pkg_id=null){
		
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('OrderTracking');
		$this->loadModel('Orders');
		
		if(!empty($orderID) || !empty($pkg_id)){
			$orderData = $this->Orders->get($orderID); 		
			//CHECK ORDER IS ASSIGNED OR NOT
			$assignData = $this->OrderAssignmentLogs->find('all')
							   ->where(['OrderAssignmentLogs.order_id' => $orderID,'OrderAssignmentLogs.package_id' => $pkg_id,'OrderAssignmentLogs.status IN' => [2,3]])
							    ->contain(['ShippingCarriers']);
			
			if($assignData->count() <=0){
				
				$msg = 'Order not assigned yet. you can view the tacking once order get assigned to agent/driver';
			
			}else{
				
				$orderAssignmentData = $assignData->first();
				$trackingBy = $orderAssignmentData->shipment_type;
				
				if(strtolower($orderAssignmentData->shipment_type)=='driver'){
					
					//GET DIRECT TRACKING WHICH IS DONE BY SCANNING THE LABELS
					$trackingRecords = $this->Orders->find('all')
									   ->where(['Orders.id' => $orderID,'Orders.status IN' => [2,3]])
									   ->contain(['OrderTracking'=> function($q) use($pkg_id) {
																return $q->where(['package_id'=>$pkg_id])
																->contain(['Users'=> function($q) {
																					return $q->select(['name','phone']);
																			}
																 ])			   
																->order(['OrderTracking.id' =>'DESC']);
															},'OrderPackages'=> function($q) use($pkg_id) {
																return $q->where(['id'=>$pkg_id]);
															}])
									   ->hydrate(false)
									   ->toArray();
				}else{
					$trackingRecords = $this->Orders->find('all')
									   ->where(['Orders.id' => $orderID,'Orders.status IN' => [2,3]])
									    ->contain(['OrderTracking'=> function($q) use($pkg_id) {
																return $q->where(['package_id'=>$pkg_id])
																->contain(['Users'=> function($q) {
																					return $q->select(['name','phone']);
																			}
																 ])			   
																->order(['OrderTracking.id' =>'DESC']);
															},
															'OrderPackages'=> function($q) use($pkg_id) {
																return $q->where(['id'=>$pkg_id]);
															}])
									   ->hydrate(false)
									   ->toArray();
					
					$third_party_data = $orderAssignmentData->shipping_carrier;
					$yrcDetails = array('order_id'=>$orderID,
										'pkg_id'=>$pkg_id,
										'user_id'=>$orderAssignmentData->assign_to,
										'tracking_number'=>$orderAssignmentData->tracking_number
								  );
								  
					switch ($orderAssignmentData->shipping_carrier->carrier_name) {
							case 'fedex':
								
								$this->fedexTracking($yrcDetails);
								break;
								
							case 'yrc':
								
								$this->yrcTracking($yrcDetails);
								break;		
					
							case 'estes':
								$this->estesTracking($yrcDetails);
								break;
								
							case 'ups':
								$this->upsTracking();
								$trackingBy='ups';
								break;
								
							case 'dhl':
								$this->dhlTracking();
								$trackingBy='dhl';
								break;
					}
				}
				
			}
			
		}else{
			
			$msg = 'Please provide order id and package id.';
		}
		
		$trackingRecords = $this->Orders->find('all')
									   ->where(['Orders.id' => $orderID,'Orders.status IN' => [2,3]])
									    ->contain(['OrderTracking'=> function($q) use($pkg_id) {
																return $q->where(['package_id'=>$pkg_id])
																->contain(['Users'=> function($q) {
																					return $q->select(['name','phone']);
																			}
																 ])			   
																->order(['OrderTracking.id' =>'DESC']);
															},
															'OrderPackages'=> function($q) use($pkg_id) {
																return $q->where(['id'=>$pkg_id]);
															}])
									   ->hydrate(false)
									   ->toArray();
		$this->set('trackingBy', @$trackingBy);
		$this->set('descrates_app_id', @$orderData->descrates_app_id);
		$this->set('trackingRecords', @$trackingRecords);
	}
	
	function fedexTracking($fedExDetails=array()){
		
		$tracking = new Track(FEDEX_ACCESS_KEY, FEDEX_PASSWORD, FEDEX_ACCOUNT_NUMBER, FEDEX_METER_NUMBER);
		
		try{
			$shipment = $tracking->getByTrackingId($fedExDetails['tracking_number']);
				
			
		}catch (Exception $e){
			$shipment=array();
		}
		
		//echo "<pre>"; print_r($shipment->CompletedTrackDetails->TrackDetails->Events); die;
		//return $shipment;
		if(!empty($shipment->CompletedTrackDetails->TrackDetails->Events)){
			
			foreach($shipment->CompletedTrackDetails->TrackDetails->Events as $eventData){
				$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$fedExDetails['pkg_id'],
															   'OrderTracking.user_id'=>$fedExDetails['user_id'],
															   'OrderTracking.order_id'=>$fedExDetails['order_id'],'OrderTracking.third_party_status'=>$eventData->EventType])
													  ->count();
					if($order_tracking_rec <=0){
							$orderScannedData = $this->OrderTracking->newEntity();
							$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
							
							$orderScannedData->order_id = $fedExDetails['order_id'];
							$orderScannedData->user_id = $fedExDetails['user_id'];
							$orderScannedData->package_id = $fedExDetails['pkg_id'];
							
							$orderScannedData->location = $eventData->Address->City." ".@$eventData->Address->StateOrProvinceCode." ".$eventData->Address->CountryName;
							
							$orderScannedData->third_party_status = $eventData->EventType;
							$orderScannedData->third_party_status_date = ($eventData->Timestamp !='')?date("Y-m-d", strtotime($eventData->Timestamp)):'';
							$orderScannedData->tracking_description = $eventData->EventDescription;
							$this->OrderTracking->save($orderScannedData);
							
							if($eventData->EventType=='DL'){
								$this->completedOrderStatus($fedExDetails['order_id'],$fedExDetails['pkg_id'],$fedExDetails['user_id']);
							}
					}	
			
			
			}
		}
		
	}
	
	function yrcTracking($yrcDetails=array()){
		
		$ch = curl_init();
		$url = 'http://my.yrc.com/myyrc-api/national/servlet?CONTROLLER=com.rdwy.ec.rextracking.http.controller.PublicTrailerHistoryAPIController&xml=Y&PRONumber='.$yrcDetails['tracking_number'];
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result_xml = curl_exec($ch);
		$result_xml = str_replace(array(':','-'), '', $result_xml);
		$result = @simplexml_load_string($result_xml);
		
	
		//CHECK SUCCESS RESPONSE
		if($result->SHIPMENT->returnMessage=='SUCCESS'){
			
			$yrc_status_array = array(
				'Delivered'=>'Delivered',
				'SPOT'=>'Spotted at Consignee',
				'OFD'=>'Out for Delivery',
				'LDD'=>'Loaded for Delivery',
				'ENR'=>'Shipment enroute to next destination',
				'LDG'=>'Shipment is loading at this terminal',
				'CLS'=>'Shipment’s trailer was closed at this terminal and is ready to move to next point',
				'ONH'=>'Shipment is on-hand at this  terminal',
				'OHD'=>'Shipment is on-hand at the destination terminal',
				'UNL'=>'Shipment is un-loaded and on hand at this terminal location ',
				'OFL'=>'Trailer or Container to carrier at city, state',
				'Tendered ICMX'=>'Internal code marking Shipment is destined to Mexico',
				'FBO'=>'Shipment is picked up and at this terminal',
				'Unloaded'=>'The shipment has been unloaded at the given location',
				'Loaded'=>'This shipment has been loaded onto a trailer'
				
			);
			
			$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$yrcDetails['pkg_id'],
															   'OrderTracking.user_id'=>$yrcDetails['user_id'],
															   'OrderTracking.order_id'=>$yrcDetails['order_id'],'OrderTracking.third_party_status'=>$result->SHIPMENT->currentStatusCode])
													  ->count();
			if($order_tracking_rec <=0){
				
				$orderScannedData = $this->OrderTracking->newEntity();
				$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
				
				$orderScannedData->order_id = $yrcDetails['order_id'];
				$orderScannedData->user_id = $yrcDetails['user_id'];
				$orderScannedData->package_id = $yrcDetails['pkg_id'];
				$orderScannedData->third_party_status = $result->SHIPMENT->currentStatusCode;
				$orderScannedData->location = $result->SHIPMENT->currentStatusMessage;
				$orderScannedData->third_party_status_date = ($result->SHIPMENT->currentStatusDate !='')?date("Y-m-d", strtotime($result->SHIPMENT->currentStatusDate)):'';
				$orderScannedData->tracking_description = $yrc_status_array[$result->SHIPMENT->currentStatusCode]." ".$result->SHIPMENT->currentStatusMessage;
				$this->OrderTracking->save($orderScannedData);
				if($result->SHIPMENT->currentStatusCode=='Delivered'){
					$this->completedOrderStatus($yrcDetails['order_id'],$yrcDetails['pkg_id'],$yrcDetails['user_id']);
				}
			}
			
		}
	}	
		
	function estesTracking($estesDetails=array()){
				
        $soapUrl = "http://www.estes-express.com/shipmenttracking/services/ShipmentTrackingService?wsdl"; // asmx URL of WSDL

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://ws.estesexpress.com/shipmenttracking" xmlns:ship1="http://ws.estesexpress.com/schema/2012/12/shipmenttracking">
                                <soapenv:Header>
                                <ship:auth>
                                <ship:user>Sky2c1</ship:user>
                                <ship:password>sky2c1</ship:password>
                                </ship:auth>
                                </soapenv:Header>
                                <soapenv:Body>
                                <ship1:search>
                                <ship1:requestID>2013-01-21.1643</ship1:requestID>
                                <ship1:pro>'.$estesDetails['tracking_number'].'</ship1:pro>
                                </ship1:search>
                                </soapenv:Body>
                                </soapenv:Envelope>';   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: http://tracmedia.org/InTheLife", 
                        "Content-length: ".strlen($xml_post_string),
                    ); //SOAPAction: your op URL
                    
	    // PHP cURL  for https connection with auth
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $soapUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		// converting
		$response = curl_exec($ch); 
		curl_close($ch);

		$soap_response = $response;

		$plainXML = $this->parse_xml_into_array($soap_response);
		$estesresponse = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		
		// FUNCTION TO MUNG THE XML SO WE DO NOT HAVE TO DEAL WITH NAMESPACE
		if(!empty($estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment'])){
			
		
			$org_status = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_status'];
			$ship_status_1 = str_replace(",","",$org_status);
			$ship_status = str_replace(" ","_ ",$ship_status_1);
			
			if(trim($org_status)=='Delivered'){
				$delivery_date = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_deliveryDate'];
				$message = "Order ".$ship_status_1;
			}else{
				$delivery_date = $estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_estimatedDeliveryDate'];
				$message = "Order reached at ".$ship_status_1;
			}
			 
			$location = @$estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_destinationTerminal']['ship_address']['ship_line1']." ".@$estesresponse['soapenv_Body']['ship_trackingInfo']['ship_shipments']['ship_shipment']['ship_destinationTerminal']['ship_name'];
			
			$this->loadModel('OrderTracking');
			$order_tracking_rec = $this->OrderTracking->find('all')
													  ->where(['OrderTracking.package_id'=>$estesDetails['pkg_id'],
															   'OrderTracking.user_id'=>$estesDetails['user_id'],
															   'OrderTracking.order_id'=>$estesDetails['order_id'],'OrderTracking.third_party_status'=>$ship_status])
													  ->count();
			if($order_tracking_rec <=0){
				
				$orderScannedData = $this->OrderTracking->newEntity();
				$orderScannedData = $this->OrderTracking->patchEntity($orderScannedData, $this->request->data);
				
				$orderScannedData->order_id = $estesDetails['order_id'];
				$orderScannedData->user_id = $estesDetails['user_id'];
				$orderScannedData->package_id = $estesDetails['pkg_id'];
				$orderScannedData->location = $location;
				$orderScannedData->third_party_status = $ship_status;
				$orderScannedData->third_party_status_date = ($delivery_date !='')?date("Y-m-d", strtotime($delivery_date)):'';
				$orderScannedData->tracking_description = $message;
				$this->OrderTracking->save($orderScannedData);
				if($ship_status=='Delivered'){
					$this->completedOrderStatus($estesDetails['order_id'],$estesDetails['pkg_id'],$estesDetails['user_id']);
				}
			}
		}
		
	  
	}
		
	/*function for use dhl tracking info from dhl API*/
	function upsTracking($upsDetails=array()){
		
		$data ="<?xml version=\"1.0\"?>
			<AccessRequest xml:lang='en-US'>
				<AccessLicenseNumber>".UPS_ACCESS_CODE."</AccessLicenseNumber>
				<UserId>".UPS_USER_ID."</UserId>
				<Password>".UPS_PWD."</Password>
			</AccessRequest>
			<?xml version=\"1.0\"?>
				<TrackRequest>
					<Request>
						<TransactionReference>
							<CustomerContext>
								<InternalKey>".$upsDetails['tracking_number']."</InternalKey>
							</CustomerContext>
							<XpciVersion>1.0</XpciVersion>
						</TransactionReference>
						<RequestAction>Track</RequestAction>
					</Request>
					<TrackingNumber>".$upsDetails['tracking_number']."</TrackingNumber>
				</TrackRequest>";
					
		$ch = curl_init("https://www.ups.com/ups.app/xml/Track");
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_TIMEOUT, 60);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$result=curl_exec ($ch);

		$data = strstr($result, '<?');
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $data, $vals, $index);
		xml_parser_free($xml_parser);
		$params = array();
		$level = array();
		
		foreach ($vals as $xml_elem) {
			
			if ($xml_elem['type'] == 'open') {
				
				if (array_key_exists('attributes',$xml_elem)) {
					
					list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
				
				}else{
					
					$level[$xml_elem['level']] = $xml_elem['tag'];
				}
			
			}
			
			if ($xml_elem['type'] == 'complete') {
			
				$start_level = 1;
				$php_stmt = '$params';
				while($start_level < $xml_elem['level']) {
					
					$php_stmt .= '[$level['.$start_level.']]';
					$start_level++;
				}
				
				$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
				eval($php_stmt);
			}
		}
		
		curl_close($ch);
		return $params;		
	
	}
	
	function dhlTracking($trackingNumber='7070000000'){
		
		$data  = '<?xml version="1.0" encoding="ISO-8859-1" ?>';
		$data .= '<data appname="nol-public" password="anfang" request="get-status-for-public-user" language-code="de">';
		$data .= '  <data piece-code="'.$trackingnumber.'"></data>';
		$data .= '</data>';
	 
		// URL bauen und File hohlen
		$xml = simplexml_load_file(sprintf(
			'http://nolp.dhl.de/nextt-online-public/direct/nexttjlibpublicservlet?xml=%s', $data
		));
	 
		// FALSE, wenn Syntax oder HTTP Error
		if ($xml === false) return false;
	 
		// Wandelt das SimpleXML Objekt in ein Array um
		foreach ($xml->data->data->attributes() as $key => $value) {
			$return[$key] = (string) $value;
		}
		
		
	}
	
	function completedOrderStatus($order_id,$package_id,$user_id){
		
		$this->loadModel('Orders');
		$this->loadModel('OrderPackages');
		$this->loadModel('OrderTracking');
		$this->loadModel('OrderAssignments');
		$this->loadModel('OrderAssignmentLogs');
		$this->loadModel('UserLogs');
		$OrderAssignmentLogsQuery =  $this->OrderAssignmentLogs->query();
									
		//UPDATE ORDER ASSIGNMENT LOG TABLE STATUS
		if($OrderAssignmentLogsQuery->update()
						->set(['status'=>3])
						->where(['order_id' => $order_id,'package_id' => $package_id,'assign_to' => $user_id])->execute()){
							
			//GET ORDER ASSIGNMENT ID			
			$OrderAssignmentLogsData = $this->OrderAssignmentLogs->find('all')->where(['OrderAssignmentLogs.order_id' => $order_id,'OrderAssignmentLogs.package_id' =>  $package_id,'OrderAssignmentLogs.assign_to' => $user_id])->hydrate(false)->first();	
			
			$order_assignment_id = $OrderAssignmentLogsData['order_assignment_id'];
			
			//UPDATE ORDER ASSIGNMENT TABLE 
			$OrderAssignmentsQuery =  $this->OrderAssignments->query();
			if($OrderAssignmentsQuery->update()
						->set(['status_to'=>3,'status_by'=>3])
						->where(['id' => $order_assignment_id])
						->execute()){
				
				$OrderPackagesQuery =  $this->OrderPackages->query();
				if($OrderPackagesQuery->update()
						->set(['status'=>3])
						->where(['id' =>  $package_id])
						->execute()){
							
					//GET All Packages Status of orders		
					$OrderPackagesCount = $this->OrderPackages->find('all')->where(['OrderPackages.order_id' => $order_id,'OrderPackages.status IN' => ['1','2']])->count();	
					if($OrderPackagesCount<=0){
						$OrdersQuery =  $this->Orders->query();
						$OrdersQuery->update()
											->set(['status'=>3])
											->where(['id' =>  $order_id])
											->execute();
					}
				}//End Update  package status
			
			}//End Update Order assignment status
							
		}//End Update Order assignment log status
	}
	
	function importOrders(){
		
		set_time_limit(240);    //4minutes
		ini_set('memory_limit', '64M');
		
		$this->loadModel('Users');
		$this->loadModel('Orders');
		$this->loadModel('OrderDetails');
		$this->loadModel('OrderPackages');
		$this->loadModel('OrderLocations');
		
		$order_file='';
		if(!empty($this->request->data['order_file'])){
			//Upload profile image
			$orderFile = $this->request->data['order_file'];
			
			if($orderFile['name'] != ''){
				$orderData = $this->upload_file('orderFile',$orderFile);
				$orderData = explode(':',$orderData);

				if($orderData[0]=='error'){
					$this->Flash->error(__($orderData[1]));
					return $this->redirect(['action' => 'import-orders']);
				}else{
					$order_file =  $orderData[1];
				}               
			}
			
			unset($this->request->data['order_file']);
			//End image upload
		}
		
		if(!empty($order_file)){
			
			//Get xml file data
			$xml = simplexml_load_file(HTTP_ROOT."upload_xml_order_files/".$order_file);
			$xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
			
			$file_number = isset($xml_array['FileNumber'])?$xml_array['FileNumber']:'';
			
			//CHECK THAT FILE IS VALID OR NOT
			if(empty($file_number)){
				
				$file_destination = realpath('../webroot/upload_xml_order_files').'/'.$order_file;
				unlink($file_destination);
				
				$this->Flash->error('Seems you have upload invalid file, Please upload descartes xml file');
				return $this->redirect(['action' => 'import-orders']);
			
			}else{
				
				//Check xml file data
				if(!empty($xml_array)){
					
					//ACCESS PRTIES ARRAY
					if(!empty($xml_array['Parties']['Party'])){
						
						foreach($xml_array['Parties']['Party'] as $partyKey=>$partyVal){
						
							//Check Customer Array AND CREATE NEW CUSTOMER
							if(strtolower($partyVal['PartyType'])=='account'){
								
								$descartes_customer_id = $partyVal['PartyCode'];
								$userCount = $this->Users->find('all')->where(['Users.descartes_customer_id' => $descartes_customer_id])->count();
								
								//CHECK THAT CUSTOMER IS ALREADY CREATED OR NOT
								if($userCount <= 0){
									$user = $this->Users->newEntity();
									$userdata['password'] = $this->RandomStringGenerator();
									$userdata['descartes_customer_id'] = $descartes_customer_id;
									$userdata['username'] = $descartes_customer_id;
									$userdata['role'] = 5;
									$userdata['status'] = 1;
									
									$user = $this->Users->patchEntity($user, $userdata);
																		
									$this->Users->validator()->remove('name');
									$this->Users->validator()->remove('email');
									$this->Users->validator()->remove('phone');
								
									
									if ($this->Users->save($user)) {
											
											//Send registeration email to sky2c pre-defined email id
											$replace = array('{full_name}','{username}','{password}','{link}');
											$with = array('Sky2C',$descartes_customer_id , $userdata['password'], HTTP_ROOT);
											
											//Send email function
											$this->send_email('',$replace,$with,'registration_invitation',NEW_USER_SKY2C);
									}else{
										pr($user->errors()); die;
									}
								}//END BRACES OF CHECK THAT CUSTOMER IS ALREADY CREATED OR NOT
								$customerData = $this->Users->find('all')->where(['Users.descartes_customer_id' => $descartes_customer_id])->first();
								$customer_id = $customerData->id;
							}
						}
						
					}
					
					//IMPORT ORDER INTO DATABASE TABLE
					if(!empty($xml_array)){
						
						$exploded_file_number = explode("-",$file_number);
						$descartes_order_id = $exploded_file_number[0];
						$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
							
						//CHECK THAT ORDER IS EXISTS OR NOT WITH PROVIDED FILE NUMBER
						if($orderQuery->count() <= 0){
							
							$orders = $this->Orders->newEntity();
							
							$orderTableData['status'] = 1;
							$orderTableData['descrates_app_id'] = $descartes_order_id;
							$orderTableData['customer_id'] = $customer_id;
							
							$orderTableData['transaction_id'] =        isset($xml_array['TransactionId'])?$xml_array['TransactionId']:'';
							
							$TransactionDateTime = isset($xml_array['TransactionDateTime'])?$xml_array['TransactionDateTime']:'';
							$transaction_date_time = explode("T",$TransactionDateTime);
							
							$orderTableData['transaction_date_time'] =$transaction_date_time[0].' '.$transaction_date_time[1];
							$orderTableData['shipment_type'] =         isset($xml_array['ShipmentType'])?$xml_array['ShipmentType']:'';
							$orderTableData['house_bill_number'] =     isset($xml_array['HouseBillNumber'])?$xml_array['HouseBillNumber']:'';
							$orderTableData['booking_number'] =        isset($xml_array['BookingNumber'])?$xml_array['BookingNumber']:'';
							$orderTableData['customer_reference'] =   isset($xml_array['CustomerReference'])?$xml_array['CustomerReference']:'';
							$orderTableData['payment_method'] =        isset($xml_array['PaymentMethod'])?$xml_array['PaymentMethod']:'';
							$orderTableData['transportation_method'] = isset($xml_array['TransportationMethod'])?$xml_array['TransportationMethod']:'';
							$orderTableData['type_of_move'] =          isset($xml_array['TypeOfMove'])?$xml_array['TypeOfMove']:'';
							$orderTableData['type_of_service'] =       isset($xml_array['TypeOfService'])?$xml_array['TypeOfService']:'';
							$orderTableData['vessel_name'] =           isset($xml_array['VesselName'])?$xml_array['VesselName']:'';
							$orderTableData['voyage_flight_number'] =  isset($xml_array['VoyageFlightNumber'])?$xml_array['VoyageFlightNumber']:'';
							$departureDate =  isset($xml_array['DepartureDateTime'])?$xml_array['DepartureDateTime']:'';
							$arrivalDate =    isset($xml_array['ArrivalDateTime'])?$xml_array['ArrivalDateTime']:'';
							
							$pickup_date =   explode("T",$departureDate);
							$drop_off_date = explode("T",$arrivalDate);
							
							$orderTableData['pickup_date'] = $pickup_date[0].' '.$pickup_date[1];
							$orderTableData['drop_off_date'] = $drop_off_date[0].' '.$drop_off_date[1];
							$orders = $this->Orders->patchEntity($orders, $orderTableData, ['validate' => false]);
							$this->Orders->save($orders);
							
							$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
							$orderRecords = $orderQuery->first();
							$new_order_id = $orderRecords->id;
							
						}else{
							$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
							$orderRecords = $orderQuery->first();
							$new_order_id = $orderRecords->id;
						}
						
						foreach($xml_array['Parties']['Party'] as $partyKey=>$partyVal){
							
							$OrderDetailsCount = $this->OrderDetails->find('all')->where(['OrderDetails.order_id' => $new_order_id, 'OrderDetails.party_type' => $partyVal['PartyType']])->count();
							
							//CHECK THAT ORDER DETAILS WITH ORDER ID AND PARTY TYPE EXISTS OR NOT
							if($OrderDetailsCount <= 0){

								//ADD DATA INTO ORDER DETAILS TABLE
								$OrderDetails = $this->OrderDetails->newEntity();
								$orderDetailsData['order_id'] =   $new_order_id;
								$orderDetailsData['party_type'] = isset($partyVal['PartyType'])?$partyVal['PartyType']:'';
								$orderDetailsData['party_code'] = isset($partyVal['PartyCode'])?$partyVal['PartyCode']:'';
								$orderDetailsData['party_name'] = isset($partyVal['Name'])?$partyVal['Name']:'';
								$orderDetailsData['address_1'] =  isset($partyVal['Address1'])?$partyVal['Address1']:'';
								$orderDetailsData['city_name'] =  isset($partyVal['CityName'])?$partyVal['CityName']:'';
								$orderDetailsData['state_or_province_code'] = isset($partyVal['StateOrProvinceCode'])?$partyVal['StateOrProvinceCode']:'';
								$orderDetailsData['postal_code'] =            isset($partyVal['PostalCode'])?$partyVal['PostalCode']:'';
								$orderDetailsData['country_code'] =           isset($partyVal['CountryCode'])?$partyVal['CountryCode']:'';
								
								$OrderDetails = $this->OrderDetails->patchEntity($OrderDetails, $orderDetailsData, ['validate' => false]);
								
								$this->OrderDetails->save($OrderDetails);
								
								
								if(strtolower($orderDetailsData['party_type'])=='shipper'){
									$source = $orderDetailsData['party_name'].', '.$orderDetailsData['address_1'].', '.$orderDetailsData['city_name'].', '.$orderDetailsData['postal_code'].', '.$orderDetailsData['country_code'];
									
									$this->Orders->updateAll(['source' => $source], ['id' => $new_order_id]);
								}
								if(strtolower($orderDetailsData['party_type'])=='consignee'){
									$destination = $orderDetailsData['party_name'].', '.$orderDetailsData['address_1'].', '.$orderDetailsData['city_name'].', '.$orderDetailsData['postal_code'].', '.$orderDetailsData['country_code'];
									$this->Orders->updateAll(['destination' => $destination], ['id' => $new_order_id]);
								}
							}
							
						}	
					}
					
					//ACCESS LOCATION ARRAY
					if(!empty($xml_array['Locations']['Location'])){
						
						foreach($xml_array['Locations']['Location'] as $locationKey=>$locationVal){
							
							$OrderLocationsCount = $this->OrderLocations->find('all')->where(['OrderLocations.order_id' => $new_order_id, 'OrderLocations.location_type' => $locationVal['LocationType']])->count();
							
							//CHECK THAT ORDER DETAILS WITH ORDER ID AND PARTY TYPE EXISTS OR NOT
							if($OrderLocationsCount <= 0){
								
								//ADD DATA INTO ORDER LOCATION TABLE
								$OrderLocations = $this->OrderLocations->newEntity();
								
								$orderLocationData['order_id'] =               $new_order_id;
								$orderLocationData['location_type'] =          isset($locationVal['LocationType'])?$locationVal['LocationType']:'';
								$orderLocationData['location_id_qualifier'] =  isset($locationVal['LocationIdQualifier'])?$locationVal['LocationIdQualifier']:'';
								$orderLocationData['location_id'] =            isset($locationVal['LocationId'])?$locationVal['LocationId']:'';
								$orderLocationData['location_name'] =          isset($locationVal['LocationName'])?$locationVal['LocationName']:'';
								$orderLocationData['state_or_province_code'] = isset($locationVal['StateOrProvinceCode'])?$locationVal['StateOrProvinceCode']:'';
								$orderLocationData['country_code'] = isset($locationVal['CountryCode'])?$locationVal['CountryCode']:'';
											
								$OrderLocations = $this->OrderLocations->patchEntity($OrderLocations, $orderLocationData, ['validate' => false]);
								
								$this->OrderLocations->save($OrderLocations);
							}
									
						}
					}
					
					//ACCESS PACKAGE ARRAY
					if(!empty($xml_array['Containers']['Container'])){
							
						$pkgCount = $this->OrderPackages->find('all')->where(['OrderPackages.package_number' => $file_number,'OrderPackages.order_id' => $new_order_id])->count();
						
						if($pkgCount<=0){
							
							$packageVal = $xml_array['Containers']['Container'];
								
							//ADD DATA INTO ORDER LOCATION TABLE
							$OrderPackages = $this->OrderPackages->newEntity();
							
							$OrderPackagesData['order_id'] = $new_order_id;
							
							$OrderPackagesData['equipment_initial'] =  isset($packageVal['EquipmentInitial'])?$packageVal['EquipmentInitial']:'';
							$OrderPackagesData['equipment_number'] =   isset($packageVal['EquipmentNumber'])?$packageVal['EquipmentNumber']:'';
							//$OrderPackagesData['package_number'] =     isset($packageVal['SealNumber1'])?$packageVal['SealNumber1']:'';
							$OrderPackagesData['package_number'] =     isset($file_number)?$file_number:'';
							$OrderPackagesData['package_title'] =      isset($packageVal['EquipmentTypeCode'])?$packageVal['EquipmentTypeCode']:'';
							
							$containerVal = $packageVal['Contents']['Content'];
							
							$OrderPackagesData['quantity_shipped'] =   isset($containerVal['QuantityShipped'])?$containerVal['QuantityShipped']:'';
							$OrderPackagesData['unit_of_measure'] =    isset($containerVal['UnitOfMeasure'])?$containerVal['UnitOfMeasure']:'';
							$OrderPackagesData['description'] =        isset($containerVal['Description'])?$containerVal['Description']:'';
							$OrderPackagesData['gross_weight'] =       isset($containerVal['GrossWeight'])?$containerVal['GrossWeight']:'';
							$OrderPackagesData['weight_unit'] =        isset($containerVal['WeightUnit'])?$containerVal['WeightUnit']:'';
							$OrderPackagesData['quantity_packaging_units'] = isset($containerVal['QuantityPackagingUnits'])?$containerVal['QuantityPackagingUnits']:'';
							
							$OrderPackages = $this->OrderPackages->patchEntity($OrderPackages, $OrderPackagesData, ['validate' => false]);
						
							$this->OrderPackages->save($OrderPackages);
						}
							
					}
					
					$this->Flash->success('Success ! Xml file imported into database.');
					return $this->redirect(['action' => 'import-orders']);
					
				}else{
					$this->Flash->error('Xml file failed to import into databse, Please try later.');
					return $this->redirect(['action' => 'import-orders']);
				}
		
			}
			
		}
		
		$this->set('orders', '');
	}
	
	function autoImportOrders($index=0){
	//phpinfo(); die;
		$path = realpath('../webroot/upload_xml_order_files');
		$order_files = scandir($path);
		$totalFile = count($order_files);
		
		$newPercentage = 1;
		
		if($index !=0){
			$newPercentage = ($index / $totalFile) * 100;
		}
		
		$percentage = round($newPercentage, 2);
		$response = '<!DOCTYPE html><html lang="en"><head><title>Auto Import Order</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="'.HTTP_ROOT.'assets/global/plugins/bootstrap/css/bootstrap.min.css"><script src="'.HTTP_ROOT.'assets/global/plugins/jquery.min.js"></script><script src="'.HTTP_ROOT.'assets/global/plugins/bootstrap/js/bootstrap.min.js"></script></head><body><div class="container"><h2>Order import process ('.$percentage.'%)</h2><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage.'%">'.$percentage.'% Completed..</div></div></div></body></html>';
				
		if($index > $totalFile){
			$response = '<!DOCTYPE html><html lang="en"><head> <title>Auto Import Order</title> <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet" href="'.HTTP_ROOT.'assets/global/plugins/bootstrap/css/bootstrap.min.css"> <script src="'.HTTP_ROOT.'assets/global/plugins/jquery.min.js"></script> <script src="'.HTTP_ROOT.'assets/global/plugins/bootstrap/js/bootstrap.min.js"></script></head><body> <div class="container"><div class="row text-center"> <div class="col-sm-6 col-sm-offset-3"> <br><br><h2 style="color:#0fad00">Success</h2> <img src="'.HTTP_ROOT.'img/check-true.jpg"> <h3>Sky2c Order Import</h3> <p style="font-size:20px;color:#5C5C5C;">Thank you for import data from descartes file, Orders has been updated as per descartes inputes.</p></div></div></div></body></html>';
			
			echo $response;die;
		}else{
			if($index != 0){
				$index = $index-1;
			}
			
			$order_file = $order_files[$index];
			
			if ($order_file === '.' or $order_file === '..') {
				
				$index++;				
				$this->redirect(['action' => 'auto-import-orders',$index]);	
				
			}else{
				
				$file_destination = realpath('../webroot/upload_xml_order_files').'/'.$order_file;
			
				if(file_exists($file_destination)){
					
					if(!empty($order_file)){
				
						//Get xml file data
						$xml = simplexml_load_file(HTTP_ROOT."upload_xml_order_files/".$order_file);
						$xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
						
						$file_number = isset($xml_array['FileNumber'])?$xml_array['FileNumber']:'';
						
						//CHECK THAT FILE IS VALID OR NOT
						if(empty($file_number)){
							
							$file_destination = realpath('../webroot/upload_xml_order_files').'/'.$order_file;
							unlink($file_destination);
							
							$this->Flash->error('Seems you have upload invalid file, Please upload descartes xml file');
							return $this->redirect(['controller' => 'users','action' => 'login']);
						
						}else{
							//Set Basic Configuration
							set_time_limit(240);//4 Minutes
							ini_set('memory_limit', '64M');
							error_reporting(1);
							
							$this->loadModel('Users');
							$this->loadModel('Orders');
							$this->loadModel('OrderDetails');
							$this->loadModel('OrderPackages');
							$this->loadModel('OrderLocations');		
							
							//Check xml file data
							if(!empty($xml_array)){
								
								//ACCESS PRTIES ARRAY
								if(!empty($xml_array['Parties']['Party'])){
									
									foreach($xml_array['Parties']['Party'] as $partyKey=>$partyVal){
									
										//Check Customer Array AND CREATE NEW CUSTOMER
										if(strtolower($partyVal['PartyType'])=='account'){
											
											$descartes_customer_id = $partyVal['PartyCode'];
											$userCount = $this->Users->find('all')->where(['Users.descartes_customer_id' => $descartes_customer_id])->count();
											
											//CHECK THAT CUSTOMER IS ALREADY CREATED OR NOT
											if($userCount <= 0){
												$user = $this->Users->newEntity();
												$userdata['password'] = $this->RandomStringGenerator();
												$userdata['descartes_customer_id'] = $descartes_customer_id;
												$userdata['username'] = $descartes_customer_id;
												$userdata['role'] = 5;
												$userdata['status'] = 1;
												
												$user = $this->Users->patchEntity($user, $userdata);
																					
												$this->Users->validator()->remove('name');
												$this->Users->validator()->remove('email');
												$this->Users->validator()->remove('phone');
											
												
												if ($this->Users->save($user)) {
														
														//Send registeration email to sky2c pre-defined email id
														$replace = array('{full_name}','{username}','{password}','{link}');
														$with = array('Sky2C',$descartes_customer_id , $userdata['password'], HTTP_ROOT);
														
														//Send email function
														$this->send_email('',$replace,$with,'registration_invitation',NEW_USER_SKY2C);
												}else{
													pr($user->errors()); die;
												}
											}//END BRACES OF CHECK THAT CUSTOMER IS ALREADY CREATED OR NOT
											$customerData = $this->Users->find('all')->where(['Users.descartes_customer_id' => $descartes_customer_id])->first();
											$customer_id = $customerData->id;
										}
									}
									
								}
								
								//IMPORT ORDER INTO DATABASE TABLE
								if(!empty($xml_array)){
									
									$exploded_file_number = explode("-",$file_number);
									$descartes_order_id = $exploded_file_number[0];
									$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
									
									$orderTableData['descrates_app_id'] = $descartes_order_id;
									$orderTableData['customer_id'] = $customer_id;
									
									$orderTableData['transaction_id'] = isset($xml_array['TransactionId'])?$xml_array['TransactionId']:'';
									
									$TransactionDateTime = isset($xml_array['TransactionDateTime'])?$xml_array['TransactionDateTime']:'';
									$transaction_date_time = explode("T",$TransactionDateTime);
									
									$orderTableData['transaction_date_time'] =$transaction_date_time[0].' '.$transaction_date_time[1];
									$orderTableData['shipment_type'] =  isset($xml_array['ShipmentType'])?$xml_array['ShipmentType']:'';
									$orderTableData['house_bill_number'] = isset($xml_array['HouseBillNumber'])?$xml_array['HouseBillNumber']:'';
									$orderTableData['booking_number'] = isset($xml_array['BookingNumber'])?$xml_array['BookingNumber']:'';
									$orderTableData['customer_reference'] = isset($xml_array['CustomerReference'])?$xml_array['CustomerReference']:'';
									$orderTableData['payment_method'] = isset($xml_array['PaymentMethod'])?$xml_array['PaymentMethod']:'';
									$orderTableData['transportation_method'] = isset($xml_array['TransportationMethod'])?$xml_array['TransportationMethod']:'';
									$orderTableData['type_of_move'] =  isset($xml_array['TypeOfMove'])?$xml_array['TypeOfMove']:'';
									$orderTableData['type_of_service'] = isset($xml_array['TypeOfService'])?$xml_array['TypeOfService']:'';
									$orderTableData['vessel_name'] = isset($xml_array['VesselName'])?$xml_array['VesselName']:'';
									$orderTableData['voyage_flight_number'] =  isset($xml_array['VoyageFlightNumber'])?$xml_array['VoyageFlightNumber']:'';
									$departureDate =  isset($xml_array['DepartureDateTime'])?$xml_array['DepartureDateTime']:'';
									$arrivalDate =  isset($xml_array['ArrivalDateTime'])?$xml_array['ArrivalDateTime']:'';
									
									$pickup_date =   explode("T",$departureDate);
									$drop_off_date = explode("T",$arrivalDate);
									
									$orderTableData['pickup_date'] = $pickup_date[0].' '.$pickup_date[1];
									$orderTableData['drop_off_date'] = $drop_off_date[0].' '.$drop_off_date[1];
									$orders = $this->Orders->newEntity();
									$orders = $this->Orders->patchEntity($orders, $orderTableData, ['validate' => false]);
										//CHECK THAT ORDER IS EXISTS OR NOT WITH PROVIDED FILE NUMBER
									if($orderQuery->count() > 0){
										$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
										$orderRecords = $orderQuery->first();
										$orders->id =$orderRecords->id;
										$orderTableData['status']=$orderRecords->status;
									}else{
											$orderTableData['status'] = 1;
									}
									$this->Orders->save($orders);
									
									$orderQuery = $this->Orders->find('all')->where(['Orders.descrates_app_id' => $descartes_order_id]);
									$orderRecords = $orderQuery->first();
									$new_order_id = $orderRecords->id;
										
									//}
									
									foreach($xml_array['Parties']['Party'] as $partyKey=>$partyVal){
										
										$OrderDetailsCount = $this->OrderDetails->find('all')->where(['OrderDetails.order_id' => $new_order_id, 'OrderDetails.party_type' => $partyVal['PartyType']]);
										
										//CHECK THAT ORDER DETAILS WITH ORDER ID AND PARTY TYPE EXISTS OR NOT
										//if($OrderDetailsCount->count() <= 0){
											$OrderDetailsRec = $OrderDetailsCount->first();	
											//ADD DATA INTO ORDER DETAILS TABLE
											
											$orderDetailsData['order_id'] =   $new_order_id;
											$orderDetailsData['party_type'] = isset($partyVal['PartyType'])?$partyVal['PartyType']:'';
											$orderDetailsData['party_code'] = isset($partyVal['PartyCode'])?$partyVal['PartyCode']:'';
											$orderDetailsData['party_name'] = isset($partyVal['Name'])?$partyVal['Name']:'';
											$orderDetailsData['address_1'] =  isset($partyVal['Address1'])?$partyVal['Address1']:'';
											$orderDetailsData['city_name'] =  isset($partyVal['CityName'])?$partyVal['CityName']:'';
											$orderDetailsData['state_or_province_code'] = isset($partyVal['StateOrProvinceCode'])?$partyVal['StateOrProvinceCode']:'';
											$orderDetailsData['postal_code'] =            isset($partyVal['PostalCode'])?$partyVal['PostalCode']:'';
											$orderDetailsData['country_code'] =           isset($partyVal['CountryCode'])?$partyVal['CountryCode']:'';
											$OrderDetails = $this->OrderDetails->newEntity();
											$OrderDetails = $this->OrderDetails->patchEntity($OrderDetails, $orderDetailsData, ['validate' => false]);
									
											$OrderDetails->id = isset($OrderDetailsRec->id)?$OrderDetailsRec->id:'';
											$this->OrderDetails->save($OrderDetails);
											
											
											if(strtolower($orderDetailsData['party_type'])=='shipper'){
												$source = $orderDetailsData['party_name'].', '.$orderDetailsData['address_1'].', '.$orderDetailsData['city_name'].', '.$orderDetailsData['postal_code'].', '.$orderDetailsData['country_code'];
												
												$this->Orders->updateAll(['source' => $source], ['id' => $new_order_id]);
											}
											if(strtolower($orderDetailsData['party_type'])=='consignee'){
												$destination = $orderDetailsData['party_name'].', '.$orderDetailsData['address_1'].', '.$orderDetailsData['city_name'].', '.$orderDetailsData['postal_code'].', '.$orderDetailsData['country_code'];
												$this->Orders->updateAll(['destination' => $destination], ['id' => $new_order_id]);
											}
										//}
										
									}	
								}
								
								//ACCESS LOCATION ARRAY
								if(!empty($xml_array['Locations']['Location'])){
									
									foreach($xml_array['Locations']['Location'] as $locationKey=>$locationVal){
										
										$OrderLocationsCount = $this->OrderLocations->find('all')->where(['OrderLocations.order_id' => $new_order_id, 'OrderLocations.location_type' => $locationVal['LocationType']]);
										
										//CHECK THAT ORDER DETAILS WITH ORDER ID AND PARTY TYPE EXISTS OR NOT
										//if($OrderLocationsCount->count() <= 0){
											$orderLocationRec = $OrderLocationsCount->first();	
											//ADD DATA INTO ORDER LOCATION TABLE
											
											
											$orderLocationData['order_id'] =               $new_order_id;
											$orderLocationData['location_type'] =          isset($locationVal['LocationType'])?$locationVal['LocationType']:'';
											$orderLocationData['location_id_qualifier'] =  isset($locationVal['LocationIdQualifier'])?$locationVal['LocationIdQualifier']:'';
											$orderLocationData['location_id'] =            isset($locationVal['LocationId'])?$locationVal['LocationId']:'';
											$orderLocationData['location_name'] =          isset($locationVal['LocationName'])?$locationVal['LocationName']:'';
											$orderLocationData['state_or_province_code'] = isset($locationVal['StateOrProvinceCode'])?$locationVal['StateOrProvinceCode']:'';
											$orderLocationData['country_code'] = isset($locationVal['CountryCode'])?$locationVal['CountryCode']:'';
											$OrderLocations = $this->OrderLocations->newEntity();			
											$OrderLocations = $this->OrderLocations->patchEntity($OrderLocations, $orderLocationData, ['validate' => false]);
											$OrderLocations->id = isset($orderLocationRec->id)?$orderLocationRec->id:'';
											$this->OrderLocations->save($OrderLocations);
										//}
												
									}
								}
								
								//ACCESS PACKAGE ARRAY
								if(!empty($xml_array['Containers']['Container'])){
										
									$pkgCount = $this->OrderPackages->find('all')->where(['OrderPackages.package_number' => $file_number,'OrderPackages.order_id' => $new_order_id]);
									
									//if($pkgCount->count() <=0 ){
										
										$packageVal = $xml_array['Containers']['Container'];
											
										//ADD DATA INTO ORDER LOCATION TABLE
										
										$OrderPackagesRec = $pkgCount->first();
										$OrderPackagesData['order_id'] = $new_order_id;
										
										$OrderPackagesData['equipment_initial'] =  isset($packageVal['EquipmentInitial'])?$packageVal['EquipmentInitial']:'';
										$OrderPackagesData['equipment_number'] =   isset($packageVal['EquipmentNumber'])?$packageVal['EquipmentNumber']:'';
										//$OrderPackagesData['package_number'] =     isset($packageVal['SealNumber1'])?$packageVal['SealNumber1']:'';
										$OrderPackagesData['package_number'] =     isset($file_number)?$file_number:'';
										$OrderPackagesData['package_title'] =      isset($packageVal['EquipmentTypeCode'])?$packageVal['EquipmentTypeCode']:'';
										
										$containerVal = $packageVal['Contents']['Content'];
										
										$OrderPackagesData['quantity_shipped'] =   isset($containerVal['QuantityShipped'])?$containerVal['QuantityShipped']:'';
										$OrderPackagesData['unit_of_measure'] =    isset($containerVal['UnitOfMeasure'])?$containerVal['UnitOfMeasure']:'';
										$OrderPackagesData['description'] =        isset($containerVal['Description'])?$containerVal['Description']:'';
										$OrderPackagesData['gross_weight'] =       isset($containerVal['GrossWeight'])?$containerVal['GrossWeight']:'';
										$OrderPackagesData['weight_unit'] =        isset($containerVal['WeightUnit'])?$containerVal['WeightUnit']:'';
										$OrderPackagesData['quantity_packaging_units'] = isset($containerVal['QuantityPackagingUnits'])?$containerVal['QuantityPackagingUnits']:'';
										$OrderPackages = $this->OrderPackages->newEntity();
										$OrderPackages = $this->OrderPackages->patchEntity($OrderPackages, $OrderPackagesData, ['validate' => false]);
									
										$OrderPackages->id= isset($OrderPackagesRec->id)?$OrderPackagesRec->id:'';
										$this->OrderPackages->save($OrderPackages);
									//}
										
								} //PACKAGES IMPORT END							
								
							}//XML ARRAY BRACES END
					
						}//ELSE PART END FOR FILE NUMBER CHECK
						
					}//END CHECK ORDER FILE IS EXIST OR NOT
					
				}//END OF FILE DESTINATION
				/*
				$source_folder = realpath('../webroot/upload_xml_order_files');
				$destination_folder = realpath('../webroot/processed_descartes_file');
				$newfilename = time()."-".$order_file;
				$delete=array();
				$order_files = scandir($path);
				$REMAINFile = count($order_files);
				if($REMAINFile>1){
					rename($source_folder.$order_file, $destination_folder.$newfilename);
				}*/
			}
			echo $response;
			$index++;
			set_time_limit(0);
			ob_clean();
			sleep(10); // this should halt for 3 seconds for every loop
			
			$this->redirect(['action' => 'auto-import-orders',$index]);
			$this->set('orders', '');
		}
		
		
	}
	
	 public function ordersHistory($order_status='open-orders'){   
		
		$user_id = $this->Auth->user('id');
        $role = $this->Auth->user('role');
        
        if($role=='5'){  
			
            $order_status_array = array('open-orders'=>1,'inprogress-orders'=>2,'completed-orders'=>3);
            $orders = $this->Orders->find('all')
									->where(['Orders.customer_id'=>$user_id,
											 'Orders.status' => $order_status_array[$order_status]])
									->toArray();
            $this->set(compact('orders','order_status'));
            
        }else{
			$this->Flash->error('Oops ! You are not authorize to check order history');
			return $this->redirect(['controller' => 'users','action' => 'dashboard']);
		}
    }
			
}
?>
