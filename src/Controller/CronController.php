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

class CronController extends AppController
{
 
    public function beforeFilter(Event $event){
		 $this->Auth->allow(['sendNotification']);
        //parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
      //  $this->Auth->allow(['generateQrCode','autoImportOrders']);
        //$this->viewBuilder()->layout('admin_inner');
    }
    
    public function index(){  
	
      // return $this->redirect(['action' => 'dashboard']);
    }

    public function sendNotification()
    {   
	    $this->loadModel('Anganwadis');
        $this->loadModel('DataChildren');
        $this->loadModel('Workers');
        $this->loadModel('SamChild');
        $this->loadModel('RbskTeams');
        $this->loadModel('Notification');	
	    $this->autoRender = false; // avoid to render view
	    $today_children_count = $this->DataChildren->find('all')->contain(['Anganwadis'])->select([
				'DataChildren.id',
				'count' => "COUNT(DISTINCT DataChildren.id)",'rbsk_team_id'=>"Anganwadis.rbsk_team_id",'Anganwadis_id'=>"Anganwadis.id"
				])->where(['DataChildren.created_at >='=>date('Y-m-d 00:00:00'),'DataChildren.created_at <='=>date('Y-m-d 23:59:59')])->group('Anganwadis.rbsk_team_id')->hydrate(false)->toarray();
		foreach ($today_children_count as $children_dt){
			 $children_count_dt = $children_dt['count'];
			 $Anganwadis_id = $children_dt['Anganwadis_id'];
			 $rbsk_teams_detail = $this->Workers->find('all')->where( ['Workers.rbsk_team_id' => $children_dt['rbsk_team_id']])->toarray();
			 foreach ($rbsk_teams_detail as $rbsk_teams_dt){
				 'Dear '.$rbsk_teams_dt['name'].' '.$children_count_dt.' new children has been added in your RBSK team.';echo '<br>';
				$this->sendGoogleCloudMessage($rbsk_teams_dt['id'],'Dear '.$rbsk_teams_dt['name'].' '.$children_count_dt.' new children has been added in your RBSK team.',$children_count_dt,$children_dt['rbsk_team_id'],$Anganwadis_id);
				
			 }
		}
		echo "Notification send successfully."; 
    }
	/*****send the notification to the RBSK for daily added children*****/
   function sendGoogleCloudMessage($to,$body,$count,$rbsk_team_id,$anganwadis_id){
	    $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
		$topic =  "/topics/sam".$to;
		$notification_data = array('title' => 'Swaasth Maap', 'body' => $body,'sound' => 'default',);
		$fields = array(
            'to'         => $topic,
            'notification' =>$notification_data ,
			'content_available' => true,
		    'priority'          => 'high',
            'data' => array('count'=>$count,'rbsk_team_id'=>$rbsk_team_id,'anganwadis_id' =>$anganwadis_id)
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
            $insert_data = [
                'recevier_id' => $to,
                'Body' => $body,
                'chilldren_count' => $count,
                'rbsk_team_id' => $rbsk_team_id
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