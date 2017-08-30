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


class UsersController extends AppController
{

    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['login', 'logout','forgotPassword', 'resetPassword','autoRefreshNotification']);
        $this->viewBuilder()->layout('admin_inner');
        if($this->request->action != 'logout' && $this->request->action !='updateAcceptTermForAgent'){
            $getUserDetail = $this->Auth->user();

          
        }
        $this->loadComponent('Cookie');
    }


    /**
     * Get List usert in systems as per the users roles
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {   
       return $this->redirect(['action' => 'dashboard']);
      /*  $roles = Configure::read('users.roles');
        $this->set('roles', $roles);
        $query = $this->Users->find('all');
        $userRole = $this->Auth->user('role');
        if( $userRole == 3 )
        {
            $query->where(['parent_id' => $this->Auth->user('id')]);
        }
        
        $this->set('users', $query);
        $this->set('_serialize', ['Users']);*/
    }
    
    public function staffListing()
    {   
        $roles = Configure::read('users.roles');
        $userId = $this->Auth->user('id');
        
        $this->set('roles', $roles);
        $query = $this->Users->find('all')->where(['Users.role !=' => '1' , 'Users.id !=' => $userId ])->order(['created' => 'DESC'])->toArray();
       
        $this->set('users', $query);
        $this->set('roles', $roles);
        $this->set('_serialize', ['Users']);
    }
   
    public function agentsListing()
    {   
       
        $roles = Configure::read('users.roles');
        $this->set('roles', $roles);
        $query = $this->Users->find('all')->where(['role' => AGENT_ROLE])->order(['created' => 'DESC']);;
        $userRole = $this->Auth->user('role');
      
        
        $this->set('users', $query);
        $this->set('_serialize', ['Users']);
    }

     public function workersListing()
    {   
        $roles = Configure::read('users.roles');
       $this->loadModel('Workers');
        $this->set('roles', $roles);
        $query = $this->Workers->find('all')->contain(['TypeWorkers','Anganwadis','RbskTeams'])->order(['Workers.created' => 'DESC'])->toArray();
       // print_r($query); die;
        $userRole = $this->Auth->user('role');
      
        
        $this->set('users', $query);
        $this->set('_serialize', ['Users']);
    }

    public function addWorker()
    {   

       $this->loadModel('Workers');
        
        $user = $this->Workers->newEntity();
        if ($this->request->is('post')) {
          // die("-");
            //$this->request->data['password'] = $this->RandomStringGenerator();  
            $this->request->data['password'] = '123456';  
            $user = $this->Workers->patchEntity($user, $this->request->data);
            $user->status = 1;
            $user->type_worker_id = $this->request->data['type_worker_id'];

            $user->anganwadi_id = $this->request->data['anganwadi_id'];
           

           
            
            if ($this->Workers->save($user)) {
                
                 //Send registeration email to user
                /*$data_arr = array();
                $data_arr['email']=$user->email;
                $data_arr['name']=$user->name;
                $data_arr['username']=$user->username;
                $data_arr['password']=$this->request->data['password'];

                    //Send email function
                   $this->sendmail($data_arr);*/
                //End send email
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'workers-listing']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }

        $roles_info = $this->getRolesWorker();
        $this->set('roles_info', $roles_info);

        $agw_info = $this->getAgws();
        $this->set('agw_info', $agw_info);

        $rbsk_teams_list = $this->getRbskTeams();
        $this->set('rbsk_teams_list', $rbsk_teams_list);

        $this->set('user', $user);
    }
    
    public function editWorker($id = null)
    {   
        $this->loadModel('Workers');
        $id = convert_uudecode(base64_decode($id));

        $user = $this->Workers->get( $id, ['contain' => [] ] );
        
        if ($this->request->is(['patch', 'post', 'put'])) {
             $user->type_worker_id = $this->request->data['type_worker_id'];
            $user->anganwadi_id = $this->request->data['anganwadi_id'];
        
            $user = $this->Workers->patchEntity($user, $this->request->data);
        
            if ($this->Workers->save($user)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'workers-listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                
            }
        }

        $user->convertedId = base64_encode(convert_uuencode($user->id));
        unset($user->id);

       $roles_info = $this->getRolesWorker();
        $this->set('roles_info', $roles_info);

         $agw_info = $this->getAgws();
        $this->set('agw_info', $agw_info);

         $rbsk_teams_list = $this->getRbskTeams();
        $this->set('rbsk_teams_list', $rbsk_teams_list);


        $this->set(compact('user'));
        $this->set('_serialize', ['Workers']);
    }


    

   
    public function login()
    {
        $this->viewBuilder()->layout('admin_login');

        if($this->Cookie->check('User')){
                    $this->set("userCookie", $this->Cookie->read('User'));
        } 
        if ($this->request->is('post')) {

                 $loginId = $this->request->data['username'];
                 $org_password = $this->request->data['password'];

                if (Validation::email($this->request->data['username'])) {

                    $this->Auth->config('authenticate', [
                        'Form' => [
                            'fields' => ['username' => 'email']
                        ]
                    ]);
                    //$this->Auth->constructAuthenticate();
                    $this->request->data['email'] = $this->request->data['username'];
                    unset($this->request->data['username']);
                }
                $user = $this->Auth->identify();

            if ($user) {
                    
                 
                    if (array_key_exists("remember", $this->request->data))
                    {
                        $this->Cookie->write('User',
                                  ['loginId' => $loginId , 'password' => $org_password, 'userRole' => $user['role']]
                        );

                    } else {
                        $this->Cookie->delete('User');
                    }
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));  
            $this->set('login_error','Invalid username or password, try again');     
           
           
        }
    }
   
   /**
    Function for forgot password
   */
    function forgotPassword(){
       
        $this->viewBuilder()->layout('admin_login');
        // Loaded Admin Model
        $usersModel = TableRegistry::get('Users');
        $userData = $usersModel->newEntity();
        
        if($this->request->is('post')==1){
            if(isset($this->request->data['email']) && $this->request->data['email']!=''){
                $user = $usersModel->find('all',['conditions' => ['Users.email' => $this->request->data['email']]]);
                $getAdminData =  $user->first();
                
                if(empty($getAdminData)){
                    $this->Flash->error(__('Email id not register with us, try again'));
                }else{
                    date_default_timezone_set("UTC");
                    $dateNow = date('Y-m-d H:i:s');

                    $new_pass_key  = md5(rand().microtime());

                    $userData->id = $getAdminData->id;
                    $userData->new_pass_key = $new_pass_key;
                    $userData->new_password_requested = $dateNow;
                    //save adnin data       
                    if($usersModel->save($userData)){
                        $adminId = base64_encode($getAdminData->email);
                        
                        $replace = array('{user}','{link}');

                        $link = HTTP_ROOT.'Users/reset-password/'.urlencode($adminId).'/'.urlencode($new_pass_key);
                        $linkOnMail = '<a href="'.$link.'" target="_blank">Click here to reset password </a>';

                        $with = array($getAdminData->username, $linkOnMail);
                        //Send email function
                        $this->send_email('',$replace,$with,'forgot_password',$getAdminData->email);

                        $this->Flash->success(__('Password sent on your email address'));
                         return $this->redirect(['controller' => 'users','action' => 'login']);
                    }
                }
            }else{
                $this->Flash->error(__('Kindly provide your email address'));
                
            }
        }
    }
    /**
     * Replace user password (forgotten) with a new one (set by user).
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function resetPassword($uid = null, $key= null)
    {
        $this->viewBuilder()->layout('admin_login');
      
        $session = $this->request->session();
        // Loaded Admin Model
        $UsersModel = TableRegistry::get('Users');
        $UserData = $UsersModel->newEntity();

        $this->request->data = @$_REQUEST;
        
        $uid = base64_decode(urldecode($uid));
       
        if($uid !=""){
            $this->set("email",$uid);
        }else{
            $uid = $this->request->data['Users']['email'];
            $this->set("email",$uid);
        }
        
        if($key !=""){
            $this->set("key",$key);
        }else{
            $key = $this->request->data['Users']['key'];
            $this->set("key",$key);
        }
        
        
        $count = $UsersModel->find("all",["conditions"=>['Users.email'=>$uid,'Users.new_pass_key'=>$key]])->first();
        
        if(!empty($count)){
             date_default_timezone_set("UTC");
             $dateNow = date('Y-m-d H:i:s');

             $diff_in_minute = $this->get_date_diff($count->new_password_requested ,$dateNow);
             
             $diff_in_hr = $diff_in_minute/60;
             if($diff_in_hr >= 24){
                 $this->Flash->error(__('Your link has been expired,Please try another'));

                 return $this->redirect(['controller' => 'Users', 'action' => 'login']);
             }
        }
        if(isset($count->email) &&  $count->new_pass_key==$key)
        { 
            if(isset($this->request->data['Users']) && !empty($this->request->data['Users'])){
            
                $data = $this->request->data;
                $error=$this->validate_resetPwd($data);
             
                if(count($error) == 0)
                {
                    $UserData->password = $this->request->data['Users']['password'];
                    $UserData->new_password_requested = null;
                    $UserData->new_pass_key = null;
                    $UserData->id = $count->id;

                    $UsersModel->save($UserData);
                    $getUserData =  $UsersModel->find('all',
                                            ['conditions' => ['Users.email' => $uid]]
                                        )->toArray();
                    
                    $replace = array('{full_name}');
                    $with = array($count->name);
                    $this->send_email('',$replace,$with,'reset_password',$count->email);

                    $this->Flash->success(__('Password has been reset successfully'));

                     return $this->redirect(['controller' => 'Users', 'action' => 'login']); 
                }else{
                   
                    $this->set('resetError',$error);
                    if(isset($error['re_password'])){
                        foreach($error['re_password'] as $singleError){
                            $this->Flash->error(__($singleError));
                        }
                    }
                    if(isset($error['password'])){
                        foreach($error['password'] as $singleError){
                            $this->Flash->error(__($singleError));
                        }    
                    }
                    
                     
                   $uid = base64_encode( convert_uuencode($uid));
                    return $this->redirect('/Users/reset-password/'.$uid.'/'.$key);
                    
                }
            }   
        }else{
                $this->Flash->error(__('Athetication failed,Please try another'));
           return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    function get_date_diff($date1, $date2)
    {
        
          $date1 = strtotime($date1);
          $date2 = strtotime($date2);

         $old_date = $date1;
         $new_date = $date2;
        
        $datediff = $new_date-$old_date; //strtotime($date2) - strtotime($date1);
        $get_minutes = ceil($datediff/60);
        
    return $get_minutes;
    } 
/**
    * Function for Validate RESET PASSWORD
    */
    function validate_resetPwd($data)
    {
        
        $errors=array();
                
        if(trim($data['Users']['password'])=="")
        {
             $errors['password'][]= "Please enter your password";
        }
        else 
        {
            $length=strlen($data['Users']['password']);
            if($length < 6)
            {
                $errors['password'][]= "Please enter minimum 6 characters";
            }

           
        }
        if(trim($data['Users']['re_password'])=="")
        {
            $errors['re_password'][]="Please enter your Confirm password";
        }
        else 
        {
            if($data['Users']['password'] != $data['Users']['re_password'])
            {
                 $errors['re_password'][] = "Password does not match";
            }
        }
           
        return $errors;
    }
   
    public function logout()
    {
        if($this->Cookie->check('User')){
                $this->Cookie->delete('User');
        } 

        /*if($this->Auth->user('id') == 1){
             $this->Auth->setUser("");
            return $this->redirect(['action' => 'login?admin=true']);
        }*/
        
       return $this->redirect($this->Auth->logout());
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {   
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
   
    public function addStaff()
    {   

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
          //  print_r($this->request->data['role']); die;
            $this->request->data['password'] = $this->RandomStringGenerator();   
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->status = 1;
            $user->password = 123456;
            $user->role =$this->request->data['role'];
            $user->parent_id = $this->Auth->user('id');
            
            if ($this->Users->save($user)) {
                //Send registeration email to user
                  
                    //Send email function
              /*  $data_arr = array();
                $data_arr['email']=$user->email;
                $data_arr['name']=$user->name;
                $data_arr['username']=$user->username;
                $data_arr['password']=$this->request->data['password'];

                    $this->sendmail($data_arr);*/
                //End send email
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'staff-listing']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
         $roles_list = $this->getRoles();

        $this->set('roles_list', $roles_list);


       $this->set('user', $user);
    }
    /**
     * Edit Users
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editProfile($id = null)
    {   
       
         $beforeDecodeId = $id;
         $id = convert_uudecode(base64_decode($id));

         $user = $this->Users->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            
           

            if ($this->Users->save($user)) {
                //Update auth data
                if ($this->Auth->user('id') === $user->id) {
                        $data = $user->toArray();
                        unset($data['password']);
                        $this->Auth->setUser($data);
                }

                $this->Flash->success(__('Record has been saved.'));
                return $this->redirect(['action' => 'dashboard']);
                
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'edit-profile',$beforeDecodeId]);
            }
        }
        $user->convertedId = base64_encode(convert_uuencode($user->id));
        unset($user->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);
        //pr($user->role); die;
        $this->set(compact('user'));
    }
   
    public function editStaff($id = null)
    {   
        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user->role = $this->request->data['role'];
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {
             
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'staff-listing']);
            } else {
                
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $user->convertedId = base64_encode(convert_uuencode($user->id));
        unset($user->id);

       $roles_list = $this->getRoles();

        $this->set('roles_list', $roles_list);

        $this->set(compact('user'));
    }
   
    public function editAgent($id = null)
    {   

        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->role = AGENT_ROLE;

            //Upload profile image
            $imageData = $this->request->data['image'];

            if($imageData['name']!=''){
                $profileImage = $this->upload_file('profilePic',$imageData);
                $profileImage = explode(':',$profileImage);

                if($profileImage[0]=='error'){
                        $this->Flash->error(__($profileImage[1]));
                        return $this->redirect(['action' => 'agents-listing']);
                }else{
                    $user->profile_image =  $profileImage[1];
                }               
            }
           //End image upload

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'agents-listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                
            }
        }

        $user->convertedId = base64_encode(convert_uuencode($user->id));
        unset($user->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set(compact('user'));
    }
   /**
     * Change Password
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function changePassword($action=null,$id = null)
    {   
        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->data['oldpassword'] !=''){
                
                $oldpassword = $this->request->data['oldpassword'];
                if((new DefaultPasswordHasher)->check($oldpassword, $user->password)) 
                { 
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Password has been changed.'));
                        //Send change password email
                           
                            
                        //End change password

                        if($action==null){
                            return $this->redirect(['action' => 'index']);
                        }else{
                            return $this->redirect(['action' => $action]);
                        }
                    } else {
                        $this->Flash->error(__('Password could not be changed. Please, try again.'));
                    }
                }else{
                    $this->set('error','Old Password not matched');
                    $this->Flash->error(__('Old Password not matched, try again.'));    
                } 
            }else{
                $this->Flash->error(__('Please provide old password, try again.'));
            }
        }

         $user->convertedId = base64_encode(convert_uuencode($user->id));
         unset($user->id);

        $roles = Configure::read('users.roles');
        unset($roles['1']);
        unset($user->password);
        $this->set('roles', $roles);
        $this->set(compact('user','action'));
        $this->set('_serialize', ['application']);
    }
      /**
      Function for dashboard
    */
    function dashboard(){

      //  echo phpinfo(); die;
        
        $loggedInUserId = $this->Auth->user('id'); 
        $this->viewBuilder()->layout('admin_dashboard');

        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');

        $this->loadModel('Anganwadis');
        $this->loadModel('DataChildren');
        $this->loadModel('Workers');
        $this->loadModel('SamChild');
        $this->loadModel('SawChild');
        $this->loadModel('RbskTeams');
        $this->loadModel('Notification');


        $UsersModel = TableRegistry::get('Users');
       
        
        $admindata = $UsersModel->find('all');
        $AllAdmins = $admindata->all()->first();
        $today =  date('Y-m-d'); 
        //echo $today; die;
        $data['allUsersCount'] = $UsersModel->find('all')->where(['role NOT IN'  => 1])->count();
        $data['workersCount'] = $this->Workers->find('all')->count();
        $data['AnganwadisCount'] = $this->Anganwadis->find('all')->count();
        $data['DataChildren'] = $this->DataChildren->find('all')->count();
       
      // $sam_chilldren = $this->SamChild->find('all')->order(['SamChild.id' => 'DESC'])->group('SamChild.data_children_id');
        $subquery = $this->SamChild->find('all',array('fields' => array('id' => 'MAX(SamChild.id)')))->autoFields(false)->group('SamChild.data_children_id');

        $subquerySAW = $this->SawChild->find('all',array('fields' => array('id' => 'MAX(SawChild.id)')))->autoFields(false)->group('SawChild.data_children_id');
       

       // working query 
      //  $subquery = $this->SamChild->find('all',array('fields' => array('id' => 'MAX(SamChild.id)')))->autoFields(false)->group('SamChild.data_children_id');
        $sam_chilldren = $this->SamChild->find('all')->where(['id IN'=> $subquery])->order(['SamChild.id' => 'DESC'])->toArray();
        $saw_chilldren = $this->SawChild->find('all')->where(['id IN'=> $subquerySAW])->order(['SawChild.id' => 'DESC'])->toArray();

       //SELECT * FROM sam_child where id in (SELECT max(id) FROM sam_child GROUP BY data_children_id ) order by id desc
        $sam_chilldren_all = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->contain([
                            'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams','Blocks']);
                                                        }]])->order(['SamChild.id' => 'DESC'])->hydrate(false)->toArray();

        $saw_chilldren_all = $this->SawChild->find('all')->where(['SawChild.id IN'=> $subquerySAW])->contain([
                            'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams','Blocks']);
                                                        }]])->order(['SawChild.id' => 'DESC'])->hydrate(false)->toArray();

       // $sam_chilldren = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->group('SamChild.data_children_id')
       // debug($sam_chilldren);die;

        // --------------------------------- TEAMWISE CHART queries ----------------------------------------------------

        $sam_chilldren_teams = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->contain([
                                                        'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams']);
                                                        }]])->group('RbskTeams.id')->order(['SamChild.id' => 'DESC'])->hydrate(false)->toArray();

       

        
        $team_arr = array();
        
        foreach($sam_chilldren_teams as $sam_team){
        
            $count1sd = 0;
            $count2sd = 0;
            $count3sd = 0;
            $count4sd = 0;

            $team_name_sam = $sam_team['data_child']['anganwadi']['rbsk_team']['name'];

            foreach($sam_chilldren_all as $sam_data){
               
                 $team_name = $sam_data['data_child']['anganwadi']['rbsk_team']['name'];
                $result_nm = $sam_data['sam_result_id'];
               

                if($team_name_sam ==$team_name ){


                if($result_nm =='1SD' ){
                    $count1sd++;
                $team_arr[$team_name]['sam_data']['1sd'] = $count1sd;
                    
                }
                if($result_nm =='2SD'){

                    $count2sd++;
                $team_arr[$team_name]['sam_data']['2sd'] = $count2sd;
                    
                }
                if($result_nm =='3SD'){
                    $count3sd++;
                $team_arr[$team_name]['sam_data']['3sd'] = $count3sd;
                    
                }
                if($result_nm =='4SD'){
                    $count4sd++;
                $team_arr[$team_name]['sam_data']['4sd'] = $count4sd;
                    
                }
            }
                

                $team_arr[$team_name]['team_name'] = $team_name;

            }
    }
    //For showing team graph
    $final_team_arr = [];
    /*echo "<pre>";
    print_r($team_arr);
    echo "</pre>";die();*/

    if(!empty($team_arr)){
            foreach($team_arr as $key => $team){
                $final_data = [];
                $final_data['team_name'] = $team['team_name'];
                foreach($team['sam_data'] as $sam_key => $single_sam_data){

                    $final_data[$sam_key] = $single_sam_data;

                }
                $final_team_arr[] = $final_data;

            }
    }
    
    // -------------------------------------- blockwise chart queries ---------------------------


        $sam_chilldren_blocks = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->contain([
                            'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['Blocks']);
                                                        }]])->group('Blocks.id')->order(['SamChild.id' => 'DESC'])->hydrate(false)->toArray();

        


      //  pr($sam_chilldren_all); die;

        $block_arr = array();
        
        foreach($sam_chilldren_blocks as $sam_team_block){


            $count1sd = 0;
            $count2sd = 0;
            $count3sd = 0;
            $count4sd = 0;

             $team_name_sam = $sam_team_block['data_child']['anganwadi']['block']['name'];

        foreach($sam_chilldren_all as $sam_data){
           
             $team_name = $sam_data['data_child']['anganwadi']['block']['name'];
            $result_nm = $sam_data['sam_result_id'];
           

            if($team_name_sam ==$team_name ){


            if($result_nm =='1SD' ){
                $count1sd++;
            $block_arr[$team_name]['sam_data']['1sd'] = $count1sd;
                
            }
            if($result_nm =='2SD'){

                $count2sd++;
            $block_arr[$team_name]['sam_data']['2sd'] = $count2sd;
                
            }
            if($result_nm =='3SD'){
                $count3sd++;
            $block_arr[$team_name]['sam_data']['3sd'] = $count3sd;
                
            }
            if($result_nm =='4SD'){
                $count4sd++;
            $block_arr[$team_name]['sam_data']['4sd'] = $count4sd;
                
            }
        }
            

            $block_arr[$team_name]['block_name'] = $team_name;

        }
    }
    
    //For showing team graph
    $final_team_arr_block = [];
    if(!empty($block_arr)){
            foreach($block_arr as $key => $team){
                $final_data = [];
                $final_data['block_name'] = $team['block_name'];
                foreach($team['sam_data'] as $sam_key => $single_sam_data){
                    $final_data[$sam_key] = $single_sam_data;
                }
                $final_team_arr_block[] = $final_data;

            }
    }

   // print_r($final_team_arr_block); die;


// -----------------------------------------------------------------------------------------

     // --------------------------------- TEAMWISE CHART queries SUW ----------------------------------------------------

        $saw_chilldren_teams = $this->SawChild->find('all')->where(['SawChild.id IN'=> $subquerySAW])->contain([
                                                        'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams']);
                                                        }]])->group('RbskTeams.id')->order(['SawChild.id' => 'DESC'])->hydrate(false)->toArray();

       

        
        $team_arr_saw = array();
        
        foreach($saw_chilldren_teams as $saw_team){
        
            $count1sd = 0;
            $count2sd = 0;
            $count3sd = 0;
            $count4sd = 0;

            $team_name_saw = $saw_team['data_child']['anganwadi']['rbsk_team']['name'];

            foreach($saw_chilldren_all as $saw_data){
               
                 $team_name = $saw_data['data_child']['anganwadi']['rbsk_team']['name'];
                $result_nm = $saw_data['saw_result_id'];
               

                if($team_name_saw ==$team_name ){


                if($result_nm =='SUW' ){
                    $count1sd++;
                $team_arr_saw[$team_name]['saw_data']['suw'] = $count1sd;
                    
                }
                if($result_nm =='MUW'){

                    $count2sd++;
                $team_arr_saw[$team_name]['saw_data']['muw'] = $count2sd;
                    
                }
                if($result_nm =='NORMAL'){
                    $count3sd++;
                $team_arr_saw[$team_name]['saw_data']['normal'] = $count3sd;
                    
                }
              
            }
                

                $team_arr_saw[$team_name]['team_name'] = $team_name;

            }
    }
    //For showing team graph
    $final_team_arr_saw = [];
    
    if(!empty($team_arr_saw)){
            foreach($team_arr_saw as $key => $team){
                $final_data = [];
                $final_data['team_name'] = $team['team_name'];
                foreach($team['saw_data'] as $sam_key => $single_sam_data){

                    $final_data[$sam_key] = $single_sam_data;

                }
                $final_team_arr_saw[] = $final_data;

            }
    }

    // ================= BLOCKWISE SUW CHART ========================================

     // --------------------------------- TEAMWISE CHART queries SUW ----------------------------------------------------

        $saw_chilldren_teams = $this->SawChild->find('all')->where(['SawChild.id IN'=> $subquerySAW])->contain([
                                                        'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['Blocks']);
                                                        }]])->group('Blocks.id')->order(['SawChild.id' => 'DESC'])->hydrate(false)->toArray();

       

        
        $team_arr_saw_block = array();
        
        foreach($saw_chilldren_teams as $saw_team_block){
        
            $count1sd = 0;
            $count2sd = 0;
            $count3sd = 0;
            $count4sd = 0;

            $team_name_saw = $saw_team_block['data_child']['anganwadi']['block']['name'];

            foreach($saw_chilldren_all as $saw_data_block){
               
                 $team_name = $saw_data_block['data_child']['anganwadi']['block']['name'];
                $result_nm = $saw_data_block['saw_result_id'];
               

                if($team_name_saw ==$team_name ){


                if($result_nm =='SUW' ){
                    $count1sd++;
                $team_arr_saw_block[$team_name]['saw_data_block']['suw'] = $count1sd;
                    
                }
                if($result_nm =='MUW'){

                    $count2sd++;
                $team_arr_saw_block[$team_name]['saw_data_block']['muw'] = $count2sd;
                    
                }
                if($result_nm =='NORMAL'){
                    $count3sd++;
                $team_arr_saw_block[$team_name]['saw_data_block']['normal'] = $count3sd;
                    
                }
              
            }
                

                $team_arr_saw_block[$team_name]['block_name'] = $team_name;

            }
    }
    //For showing team graph
    $final_team_arr_saw_block = [];
    
    if(!empty($team_arr_saw_block)){
            foreach($team_arr_saw_block as $key => $team){
                $final_data_block = [];
                $final_data_block['block_name'] = $team['block_name'];
                foreach($team['saw_data_block'] as $sam_key => $single_sam_data){

                    $final_data_block[$sam_key] = $single_sam_data;

                }
                $final_team_arr_saw_block[] = $final_data_block;

            }
    }


  
       $children_count = $this->DataChildren->find('all')->contain([
                            'Anganwadis'=>['RbskTeams'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name']);
                                                        }]])->select([
                                                                        'DataChildren.id',
                                                                        'count' => "COUNT(DISTINCT DataChildren.id)",'name'=>"RbskTeams.name"
                                                                    ])->group('RbskTeams.id')->hydrate(false)->toarray();
            //  print_r($children_count); die;  




       $today_children_count = $this->DataChildren->find('all')->contain(['Anganwadis'])->select([
                'DataChildren.id',
                'count' => "COUNT(DISTINCT DataChildren.id)",'rbsk_team_id'=>"Anganwadis.rbsk_team_id",'Anganwadis_id'=>"Anganwadis.id"
                ])->where(['DataChildren.created_at >='=>date('Y-m-d 00:00:00'),'DataChildren.created_at <='=>date('Y-m-d 23:59:59')])->group('Anganwadis.rbsk_team_id')->hydrate(false)->toarray();
        foreach ($today_children_count as $children_dt){
             $children_count_dt = $children_dt['count'];
             $Anganwadis_id = $children_dt['Anganwadis_id'];
             $rbsk_teams_detail = $this->Workers->find('all')->where( ['Workers.rbsk_team_id' => $children_dt['rbsk_team_id']])->toarray();
             foreach ($rbsk_teams_detail as $rbsk_teams_dt){
                 //echo 'Dear '.$rbsk_teams_dt['name'].' '.$children_count_dt.' new children has been added in your RBSK team.';echo '<br>';
            //  $this->sendGoogleCloudMessage($rbsk_teams_dt['id'],'Dear '.$rbsk_teams_dt['name'].' '.$children_count_dt.' new children has been added in your RBSK team.',$children_count_dt,$children_dt['rbsk_team_id'],$Anganwadis_id);
                
             }
        }
        $userRole = $this->Auth->user('role');
        $loginUserID = $this->Auth->user('id');
  
        
      
         
            $DataChildren = $this->DataChildren->find('all');
           
            /*Order list as per new and date wise*/
          
            $todayStart =  date('Y-m-d')." 00:00:00";                    
            $todayEnd =  date('Y-m-d')." 23:59:00";                    
            $todayChildren = $this->DataChildren->find('all')
                                      
                                        ->where(['DataChildren.created_at >='=> $todayStart,'DataChildren.created_at <='=> $todayEnd]);
                                   
        
    
      //  $this->set(compact('DataChildren'));
        $this->set('allChildren', @$DataChildren);
        $this->set('sam_chilldren', @$sam_chilldren);
        $this->set('saw_chilldren', @$saw_chilldren);
        $this->set('todayChildren', @$todayChildren);
        $this->set('children_count', @$children_count);
        $this->set('team_data', @$final_team_arr);
        $this->set('team_data_saw', @$final_team_arr_saw);
        $this->set('block_chart_data', @$final_team_arr_block);
        $this->set('block_saw_chart_data', @$final_team_arr_saw_block);
        /*Order list as per new and date wise*/
        $this->set(['admins_info' => @$AllAdmins , 'usersInfo' => @$data]);
       
    }



    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
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
        return $this->redirect(['action' => 'staff-listing']);
    }

public function deleteworker($id = null)
    {
      //  die("--");
       // $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('Workers');
        $user = $this->Workers->get($id);
      //  print_r($user); die;
        if ($this->Workers->delete($user)) 
        {
            $this->Flash->success(__('The User has been deleted.'));
        } 
        else 
        {
            $this->Flash->error(__('The User could not be deleted. Please, try again.'));
        }        
        return $this->redirect(['action' => 'workers-listing']);
    }

    /**
     * Enable/Disable Users
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeStatus($id = null, $status = 'off',$controller=null,$action=null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->status = ( $status === 'on' ) ? 1: 0;
        if ($this->Users->save($user)) 
        {
            $this->Flash->success(__('The user status has been changed.'));
        } 
        else 
        {
            $this->Flash->error(__('The user status could not be changed. Please, try again.'));
        }   
        
        if($controller==null && $action==null){
            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(['controller' => $controller,'action' => $action]);
        }
       
    }
    
     /**
     * Enable/Disable Users
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeApproveStatus($id = null, $status = 'off',$controller=null,$action=null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->is_approved = ( $status === 'on' ) ? 1: 0;
        if ($this->Users->save($user)) 
        {
            $this->Flash->success(__('The user approval status has been changed.'));
        } 
        else 
        {
            $this->Flash->error(__('The user status could not be changed. Please, try again.'));
        }   
        
        if($controller==null && $action==null){
            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(['controller' => $controller,'action' => $action]);
        }
       
    }


    public function isAuthorized($user)
    {   
        
        // if ( isset( $user['role'] ) && $user['role'] === 'admin') {
        //     return true;
        // }


        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an user can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $userId = (int)$this->request->params['pass'][0]; 
            if ($this->Users->isOwnedBy($userId, $user['id'])) {
                return true;
            }
            else
            {
                $this->Flash->error(__('Authentication error.'));
                return false;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function updateAcceptTermForAgent()
    {   
        
        if(isset($this->request->data['agree_terms']) && $this->request->data['agree_terms']==1){
            $id = $this->Auth->user('id');
            $user = $this->Users->get( $id, ['contain' => [] ] );
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->data);
              
                $user->agreement_accept = 1;
                if ($this->Users->save($user)) {
                    if ($this->Auth->user('id') === $user->id) {
                        $data = $user->toArray();
                        unset($data['password']);

                        $this->Auth->setUser($data);
                    }
                    $this->Flash->success(__('Thanks for accepting Agent\'s Terms and Conditions.'));
                    return $this->redirect($this->Auth->redirectUrl());
                    
                } else {
                    
                }
            }
        }else{
            $this->Flash->error(__('Kindly accept terms and condition.'));
            return $this->redirect(['controller' => 'cmspages', 'action' => 'agent-terms-conditions']);
        }
        
        
    }
   
    
   
    
    /**
         * Change User Password
         *
         * @param string|null $id Application id.
         * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
         * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function changeUserPassword($id = null,$controller=null,$action=null)
    {   
        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
       
        $this->request->data['password'] = $this->RandomStringGenerator();  
        $user = $this->Users->patchEntity($user, $this->request->data);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Password has send to registered email address.'));
                //Send change password email
                $replace = array('{name}','{password}');
                $with = array($user->name, $this->request->data['password']);

                if(($this->Auth->user('role') == "1") && ($user->role != "1")){
                        $this->send_email('',$replace,$with,'change_password_by_admin',$user->email);
                }else{
                        $this->send_email('',$replace,$with,'change_password',$user->email);
                }
                
            //End change password
        } else {
            $this->Flash->error(__('Password could not be changed. Please, try again.'));
        }
        
        if($controller==null && $action==null){
            return $this->redirect(['action' => 'index']);
        }else{
            return $this->redirect(['controller' => $controller,'action' => $action]);
        }
    }
   
    /**
     * Edit Users
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function userSettings($id = null)
    {   
       
       
        $this->loadModel('UserSettings');
        $user_settings_data = $this->UserSettings->find('all')->where(['UserSettings.user_id'=>$this->Auth->user('id')])->first(); //GET USER DATA
        if ($this->request->is('post')) {
            
           
            if(!empty($user_settings_data)){
                $user_settings = $this->UserSettings->get($user_settings_data->id);
                $this->UserSettings->delete($user_settings);
            }
        
            $UserSetting = $this->UserSettings->newEntity();
            $UserSetting = $this->UserSettings->patchEntity($UserSetting, $this->request->data);
           
            $UserSetting->user_id = $this->Auth->user('id');
                             
            if ($this->UserSettings->save($UserSetting)) {
                   $this->Flash->success(__('Settings has been saved.'));
                     return $this->redirect(['action' => 'user-settings']);
            }
            
            $this->Flash->error(__('Unable to update settings.'));
            $this->set('UserSetting', $UserSetting);    
        }
    
        $this->set('user_settings_data', $user_settings_data);
    }
    
    /**
     * Edit Users
     *
     * @param string|null $id Application id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function websiteSettings()
    {   
       
        $this->loadModel('Settings');
        $settings = $this->Settings->get(1, ['contain' => [] ] );
        
        //Check Admin Role
        if ($this->Auth->user('role') != 1) {
            $this->Flash->success(__('You do not have access to change website settings.'));
            return $this->redirect(['controller' => 'users','action' => 'dashboard']);  
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Settings->patchEntity($settings, $this->request->data);
            
            if ($this->Settings->save($settings)) {
               

                $this->Flash->success(__('Settings has been saved.'));
                return $this->redirect(['action' => 'dashboard']);
                
            } else {
                $this->Flash->error(__('Settings could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('settings'));
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
