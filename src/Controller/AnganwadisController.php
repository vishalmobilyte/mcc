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

class AnganwadisController extends AppController
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
        $this->loadModel('Anganwadis');
        $this->set('roles', $roles);

       /* $query = $this->Anganwadis->find('all')->contain(['RbskTeams','Circles'=>['Blocks'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name']);
                                                        }]])->where(['Anganwadis.delete_status' => 0 ])->limit(5)->order(['Anganwadis.id' => 'ASC'])->toArray();*/
        
         $query = $this->Anganwadis->find('all')->contain(['RbskTeams',
                                                          'data_children' => [
                                                               'SamChild' => [
                                                                                'sort' => ['SamChild.created_at' => 'DESC']
                                                                             ],
                                                                'SawChild' => [
                                                                                'sort' => ['SawChild.created_at' => 'DESC']
                                                                             ]             
                                                               ],
                                                          'Circles'=>['Blocks'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name']);
                                                        }]])->where(['Anganwadis.delete_status' => 0 ])
                                                            ->order(['Anganwadis.name' => 'ASC'])->toArray();

        $return_result = $this->get_sam_saw_child($query);
         
        $userRole = $this->Auth->user('role');
     
        $this->set('aw_data', $return_result);
        $this->set('_serialize', ['Users']);
    }

    function get_sam_saw_child($query){
        
        if( !empty($query) ){
              
            foreach($query as $key => $value){
                if( !empty($value->data_children) ){
                    
                    $query[$key]->Onesd     =   $count1sd = 0;
                    $query[$key]->Twosd     =   $count2sd = 0;
                    $query[$key]->Threesd   =   $count3sd = 0;
                    $query[$key]->Foursd    =   $count4sd = 0;

                    $query[$key]->suw       =  $countSuw     = 0; 
                    $query[$key]->muw       =  $countMuw     = 0; 
                    $query[$key]->normal    =  $countNormal  = 0;

                    foreach($value->data_children as $key_child => $value_child){

                          if( !empty($value_child['sam_child']) ){
                                
                                $result_nm = $value_child['sam_child']['0']['sam_result_id'];
                                
                                if($result_nm =='1SD' ){
                                    $count1sd++;
                                    $query[$key]->Onesd = $count1sd;
                                }
                                if($result_nm =='2SD'){
                                    $count2sd++;
                                    $query[$key]->Twosd = $count2sd;
                                }
                                if($result_nm =='3SD'){
                                    $count3sd++;
                                    $query[$key]->Threesd = $count3sd;
                                }
                                if($result_nm =='4SD'){
                                    $count4sd++;
                                    $query[$key]->Foursd = $count4sd;
                                }
                          }
                          if( !empty($value_child['saw_child']) ){
                                
                                $result_sw = $value_child['saw_child']['0']['saw_result_id'];
                                
                                if($result_sw =='SUW' ){
                                    $countSuw++;
                                    $query[$key]->suw = $countSuw;
                                }
                                if($result_sw =='MUW'){
                                    $countMuw++;
                                    $query[$key]->muw = $countMuw;
                                }
                                if($result_sw =='NORMAL'){
                                    $countNormal++;
                                    $query[$key]->normal = $countNormal;
                                }
                          }
                    }
                }
            }
           return $query;
        }
    }

    public function addAgw()
    {   
        $teams_list = $this->getRbskTeams();
        $this->set('teams_list', $teams_list);

        $block_list = $this->getBlocks();
      /*  echo "<pre>";
        print_r($block_list);
        echo "</pre>";die();*/
        $this->set('block_list', $block_list);

        $user = $this->Anganwadis->newEntity();
        if ($this->request->is('post')) {
             
            $data_agw = $this->Anganwadis->patchEntity($user, $this->request->data);
            //End image upload
            
            if ($this->Anganwadis->save($data_agw)) {
                
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'listing']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
       

        $this->set('user', $user);
    }

     public function editAgw($id = null)
    {   

        $id = convert_uudecode(base64_decode($id));

        $data_agw = $this->Anganwadis->get( $id, ['contain' => ['Circles'=>['Blocks'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name']);
                                                        }]] ] );
        //print_r($data_agw); die;
      //  $block_id = $data_agw['circle']['block_id'];
        $block_id = $data_agw['block_id'];
        $circle_id = $data_agw['circle_id'];
        $this->set('block_id', $block_id);
        $this->set('circle_id', $circle_id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data_agw = $this->Anganwadis->patchEntity($data_agw, $this->request->data);
           

           

            if ($this->Anganwadis->save($data_agw)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                
            }
        }

        $data_agw->convertedId = base64_encode(convert_uuencode($data_agw->id));
        unset($data_agw->id);

        $block_list = $this->getBlocks();
        $this->set('block_list', $block_list);

        $circle_list = $this->getCirclesList();
        $this->set('circle_list', $circle_list);

    
        

        $this->set(compact('data_agw'));
    }

    public function import() {
    //  $this->loadModel('blocks');
    //  $this->loadModel('circles');
      $circleModel = TableRegistry::get('circles');
      $blockModel = TableRegistry::get('blocks');
      $rbskTeamModel = TableRegistry::get('rbsk_teams');
        $user = $this->Anganwadis->newEntity();
   if ($this->request->is(['patch', 'post', 'put'])) {
  // print_r($_FILES); die;
        if($_FILES['csv']['name']){
        //  print_r($_FILES['csv']['name']); die;
            $filename = explode('.', $_FILES['csv']['name']);
           // debug($filename);
            if($filename[1]=='csv'){

                $handle = fopen($_FILES['csv']['tmp_name'], "r");
               // print_r($handle); die('-');
                $row=1;
                while ($data = fgetcsv($handle)){
                  if($row == 1){ $row++; continue; }
                //  die('=1=');
                  // print_r($data); die;
                    $dtcode = $data[1];
                    $pjcode = $data[2];
                    $block_name = $data[3];
                    $circle_name = $data[4];
                    $awc_code = $data[5];
                    $name = $data[6];
                    $awc_type = $data[7];
                    $rbsk_team_name = $data[8];

                    // ---------------- check BLock exists or not  --------------------------

                    $block_data = $blockModel->find('all')->select(['id','name'])->where(['name'  => $block_name ])->limit(1)->toArray();
                    if(!empty($block_data)){
                      $block_id = $block_data[0]['id'];
                    }
                    else{
                      // Add New Block
                      $data_block = array(
                        'name' => $block_name
                    );
                  
                    $block_entity = $blockModel->newEntity($data_block);
                    $result_block = $blockModel->save($block_entity);
                    $block_id =  $result_block->id;

                    }

                    // -----------------  check circle exists or not  --------------------------

                    $circle_data = $circleModel->find('all')->select(['id','name'])->where(['name'  => $circle_name ])->limit(1)->toArray();
                    if(!empty($circle_data)){
                      $circle_id = $circle_data[0]['id'];
                    }
                    else{
                      // Add New Block
                      $data_circle = array(
                        'name' => $circle_name,
                        'block_id' => $block_id
                    );
                  
                    $circle_entity = $circleModel->newEntity($data_circle);
                    $result_circle = $circleModel->save($circle_entity);
                    $circle_id =  $result_circle->id;

                    }

// -----------------  check RBSK TEAMS exists or not  --------------------------

                    $rbsk_team_data = $rbskTeamModel->find('all')->select(['id','name'])->where(['name'  => $rbsk_team_name ])->limit(1)->toArray();
                    if(!empty($rbsk_team_data)){
                      $rbsk_team_id = $rbsk_team_data[0]['id'];
                    }
                    else{
                      // Add New Block
                      $data_rbsk = array(
                        'name' => $rbsk_team_name
                       
                    );
                  
                    $rbsk_entity = $rbskTeamModel->newEntity($data_rbsk);
                    $result_rbsk = $rbskTeamModel->save($rbsk_entity);
                    $rbsk_team_id =  $result_rbsk->id;

                    }





                    $data = array(
                        'dtcode' => $dtcode,
                        'pjcode' => $pjcode,
                        'block_id' => $block_id,
                        'circle_id' => $circle_id,
                        'awc_code' => $awc_code,
                        'name' => $name,
                        'awc_type' => $awc_type,
                        'rbsk_team_id' => $rbsk_team_id
                    );
                  //  $item2 = $data[1];
                  //  $item3 = $data[2];
                  //  $item4 = $data[3];
                    $Applicant = $this->Anganwadis->newEntity($data);
                    $this->Anganwadis->save($Applicant);
                    $row++;
                }
                fclose($handle);
            }
        }
    }
     $this->set('user', $user);
   // $this->render(FALSE);
}

public function importboyssaw() {
    //  $this->loadModel('blocks');
    //  $this->loadModel('circles');
      $ChartModel = TableRegistry::get('girls_saw_chart');
     
        $user = $ChartModel->newEntity();
   if ($this->request->is(['patch', 'post', 'put'])) {
  // print_r($_FILES); die;
        if($_FILES['csv']['name']){
        //  print_r($_FILES['csv']['name']); die;
            $filename = explode('.', $_FILES['csv']['name']);
           // debug($filename);
            if($filename[1]=='csv'){

                $handle = fopen($_FILES['csv']['tmp_name'], "r");
               // print_r($handle); die('-');
                $row=1;
                while ($data = fgetcsv($handle)){
                  if($row == 1){ $row++; continue; }
                //  die('=1=');
                  // print_r($data); die;

                    $sd4 = $data[0];
                    $sd3 = $data[1];
                    $sd2 = $data[2];
                    $sd1 = $data[3];
                    $median = $data[4];
                    $height = $data[5];

                    $data = array(
                        'height' => $height,
                        'median' => $median,
                        '1sd' => $sd1,
                        '2sd' => $sd2,
                        '3sd' => $sd3,
                        '4sd' => $sd4
                        
                    );
                  //  $item2 = $data[1];
                  //  $item3 = $data[2];
                  //  $item4 = $data[3];
                    $Applicant = $ChartModel->newEntity($data);
                    $ChartModel->save($Applicant);
                    $row++;
                }
                fclose($handle);
            }
        }
    }
     $this->set('user', $user);
   // $this->render(FALSE);
}

//============================ IMPORT SUW CHARTS ===========================================

public function importboyssuw() {
    //  $this->loadModel('blocks');
    //  $this->loadModel('circles');
      $ChartModel = TableRegistry::get('girls_suw_chart');
     
        $user = $ChartModel->newEntity();
   if ($this->request->is(['patch', 'post', 'put'])) {
  // print_r($_FILES); die;
        if($_FILES['csv']['name']){
        //  print_r($_FILES['csv']['name']); die;
            $filename = explode('.', $_FILES['csv']['name']);
           // debug($filename);
            if($filename[1]=='csv'){

                $handle = fopen($_FILES['csv']['tmp_name'], "r");
               //print_r($handle); die('-');
                $row=1;
                while ($data = fgetcsv($handle)){
                  if($row == 1){ $row++; continue; }
                //  die('=1=');
                 //  print_r($data); die;

                    $age = $data[0];
                    
                    $sd3_minus = $data[1];
                    $sd2_minus = $data[2];
                    $sd1_minus = $data[3];
                    $median = $data[4];
                    $sd1 = $data[5];
                    $sd2 = $data[6];
                    $sd3 = $data[7];


                    $data = array(
                        'age' => $age,
                        'median' => $median,
                        '3sd_minus' => $sd3_minus,
                        '2sd_minus' => $sd2_minus,
                        '1sd_minus' => $sd1_minus, 
                        '1sd' => $sd1,
                        '2sd' => $sd2,
                        '3sd' => $sd3
                        
                        
                    );
                  //  $item2 = $data[1];
                  //  $item3 = $data[2];
                  //  $item4 = $data[3];
                    $Applicant = $ChartModel->newEntity($data);
                    $ChartModel->save($Applicant);
                    $row++;
                }
                fclose($handle);
            }
        }
    }
     $this->set('user', $user);
   // $this->render(FALSE);
}


   


    public function getCircles(){
          if ($this->request->is('post')) {
            $data = $this->request->data;
            $block_id = $data['block_id']; 
            if($block_id !='' && $block_id>0){
             $circleModel = TableRegistry::get('circles');
             $circle_data = $circleModel->find('all')->where(['block_id'  => $block_id ])->order(['circles.name'=>"ASC"])->toArray();
             $str_circle = '';
     foreach($circle_data as $key=>$val){

               $name_circle = $val['name'];
               $id_circle = $val['id'];
               $str_circle .="<option value=".$id_circle.">".$name_circle."</option>";
            }
     }
     else{

               $str_circle .="<option value=''>No Record Found</option>";
     }
            echo $str_circle;
            die;
      


            }
            die('-end-');

    }

     /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeDeleteStatus( $id = null )
    {
      // echo "fdhjg".$this->request->action;die;
        // $this->request->allowMethod(['post', 'changeDeleteStatus']);

        $anganwadi = $this->Anganwadis->get($id);
        $anganwadi->delete_status = 1;
        
   /*     echo "<pre>";
        print_r($anganwadi);
        echo "</pre>";die();*/

        if ($this->Anganwadis->save($anganwadi)) 
        {
            $this->Flash->success(__('The angnwadi has been deleted.'));
        } 
        else 
        {
            $this->Flash->error(__('The angnwadi could not be deleted. Please, try again.'));
        }        
        return $this->redirect(['action' => 'listing']);
    }

}

?>