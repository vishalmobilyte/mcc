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

        $this->set('roles', $roles);
        $query = $this->Users->find('all')->where(['Users.role !=' => '1'])->order(['created' => 'DESC'])->toArray();
       // $userRole = $this->Auth->user();
       // print_r($userRole); die;
     // pr($roles);die;
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
        $query = $this->Workers->find('all')->contain(['TypeWorkers'])->order(['created' => 'DESC']);
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
                $data_arr = array();
                $data_arr['email']=$user->email;
                $data_arr['name']=$user->name;
                $data_arr['username']=$user->username;
                $data_arr['password']=$this->request->data['password'];

                    //Send email function
                   $this->sendmail($data_arr);
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
        // print_r($user); die;

        if ($this->request->is(['patch', 'post', 'put'])) {
             $user->type_worker_id = $this->request->data['type_worker_id'];
            $user->anganwadi_id = $this->request->data['anganwadi_id'];
          //  print_r($this->request->data); die;
            $user = $this->Workers->patchEntity($user, $this->request->data);
          //  $user->role = AGENT_ROLE;


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
            $user->role =$this->request->data['role'];
            $user->parent_id = $this->Auth->user('id');
            
            
             
            if ($this->Users->save($user)) {
                //Send registeration email to user
                  
                    //Send email function
                $data_arr = array();
                $data_arr['email']=$user->email;
                $data_arr['name']=$user->name;
                $data_arr['username']=$user->username;
                $data_arr['password']=$this->request->data['password'];

                    $this->sendmail($data_arr);
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
  
    /*public function addAgent()
    {   
        
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['password'] = $this->RandomStringGenerator();  
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->status = 1;
            $user->role = AGENT_ROLE;
            $user->parent_id = $this->Auth->user('id');

            //Upload profile image
            $imageData = $this->request->data['image'];
            if($imageData['name']!=''){
                $profileImage = $this->upload_file('profilePic',$imageData);
                $profileImage = explode(':',$profileImage);

                if($profileImage[0]=='error'){
                        $this->Flash->error(__($profileImage[1]));
                        return $this->redirect(['action' => 'add-agent']);
                }else{
                    $user->profile_image =  $profileImage[1];
                }               
            }
            unset($this->request->data['image']);
            //End image upload
            
            if ($this->Users->save($user)) {
                
                 //Send registeration email to user
                    $replace = array('{full_name}','{email}','{username}','{password}','{phone}');
                    $with = array($user->name, $user->email , $user->username , $this->request->data['password'] , $user->phone);
                    //Send email function
                    $this->send_email('',$replace,$with,'registration',$user->email);
                //End send email
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'agents-listing']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set('user', $user);
    }*/
   
    /*public function addDriver()
    {   
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            if(empty($this->request->data['email'])){
                $this->Users->validator()->remove('email');
            }
            
            $this->request->data['password'] = $this->RandomStringGenerator();
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->status = 1;
            $user->role = DRIVER_ROLE;
            $user->parent_id = $this->Auth->user('id');

            //Upload profile image
            $imageData = $this->request->data['image'];
            if($imageData['name']!=''){
                $profileImage = $this->upload_file('profilePic',$imageData);
                $profileImage = explode(':',$profileImage);

                if($profileImage[0]=='error'){
                        $this->Flash->error(__($profileImage[1]));
                        return $this->redirect(['action' => 'add-driver']);
                }else{
                    $user->profile_image =  $profileImage[1];
                }               
            }
            unset($this->request->data['image']);
            //End image upload
           
            
            if ($this->Users->save($user)) {
                if(!empty($this->request->data['email'])){
                    //Send registeration email to user
                        $replace = array('{full_name}','{email}','{username}','{password}','{phone}');
                        $with = array($user->name, $user->email , $user->username , $this->request->data['password'] , $user->phone);
                        //Send email function
                        $this->send_email('',$replace,$with,'registration',$user->email);
                    //End send email
                }
                //Start Send message on mobile
                $to_mobile_number = $user->phone;
                $message_body =  "Use ".$this->request->data['password']." ".LOGIN_MESSAGE;
                $country_code = $user->country_code;
                $this->sendMessages($to_mobile_number , $message_body , $country_code);
                //End send message 
                
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'drivers-listing']);
            }
            $this->Flash->error(__('Kindly fix the errors.'));
        }
        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);

        $this->set('user', $user);
    }*/
    /*public function addDriverCertificate()
    {   
        $this->loadModel('UserDetails');
       
        if ($this->request->is('post')) {
            
            $userDetail = $this->UserDetails->newEntity();
            $userDetail = $this->UserDetails->patchEntity($userDetail, $this->request->data);
           
            $userDetail->user_id = $this->Auth->user('id');
         
            //Upload profile image
            $imageData = $this->request->data['image'];
            if($imageData['name']!=''){
                $userDocument = $this->upload_file('documentImg',$imageData);
            
                $userDocument = explode(':',$userDocument);

                if($userDocument[0]=='error'){
                        $this->Flash->error(__($userDocument[1]));
                        return $this->redirect(['action' => 'add-driver-certificate']);
                }else{
                    $userDetail->scanned_image =  $userDocument[1];
                }               
            }
            unset($this->request->data['image']);
            //End image upload
            
            if ($this->UserDetails->save($userDetail)) {
                   $this->Flash->success(__('Document has been saved.'));
                   return $this->redirect(['action' => 'driver-certificates']);
            }
            $this->Flash->error(__('Unable to add document.'));
         $this->set('userDetail', $userDetail);
        }
    }
    public function editDriverCertificate($id = null)
    {   
        $this->loadModel('UserDetails');

         $beforeDecodeId = $id;
         // echo $beforeDecodeId;die;
         $id = convert_uudecode(base64_decode($id));
        //echo $id;die; 

         $userDetail = $this->UserDetails->get( $id, ['contain' => [] ] );
         // pr($userDetail);die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userDetail = $this->UserDetails->patchEntity($userDetail, $this->request->data);
            
            
            //Upload profile image
            $imageData = $this->request->data['image'];
            if($imageData['name']!=''){
                $profileImage = $this->upload_file('documentImg',$imageData);
                $profileImage = explode(':',$profileImage);

                if($profileImage[0]=='error'){
                        $this->Flash->error(__($profileImage[1]));
                       return $this->redirect(['action' => 'edit-profile',$beforeDecodeId]);
                }else{
                    $userDetail->scanned_image =  $profileImage[1];
                }               
            }
             
           //End image upload

            if ($this->UserDetails->save($userDetail)) {
                 $this->Flash->success(__('Record has been saved.'));
                return $this->redirect(['action' => 'driver-certificates']);
                
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'edit-driver-certificate',$beforeDecodeId]);
            }
        }
        $userDetail->convertedId = base64_encode(convert_uuencode($userDetail->id));
        unset($userDetail->id);
        $this->set(compact('userDetail'));quotemeta(str)
    }*/
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
   
    /*public function editDriver($id = null)
    {   
        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->role = DRIVER_ROLE;

            //Upload profile image
            $imageData = $this->request->data['image'];

            if($imageData['name']!=''){
                $profileImage = $this->upload_file('profilePic',$imageData);
                $profileImage = explode(':',$profileImage);

                if($profileImage[0]=='error'){
                        $this->Flash->error(__($profileImage[1]));
                        return $this->redirect(['action' => 'drivers-listing']);
                }else{
                    $user->profile_image =  $profileImage[1];
                }               
            }
           //End image upload
            if(empty($this->request->data['email'])){
                $this->Users->validator()->remove('email');
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Record has been saved.'));

                return $this->redirect(['action' => 'drivers-listing']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $user->convertedId = base64_encode(convert_uuencode($user->id));
        unset($user->id);

        $country_info = $this->countryCodes();
        $this->set('country_info', $country_info);
        
        $this->set(compact('user'));
    }*/
    

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
        $this->loadModel('RbskTeams');
        $this->loadModel('Notification');


        $UsersModel = TableRegistry::get('Users');
        $ordersModel = TableRegistry::get('Orders');
        
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
       

       // working query 
      //  $subquery = $this->SamChild->find('all',array('fields' => array('id' => 'MAX(SamChild.id)')))->autoFields(false)->group('SamChild.data_children_id');
        $sam_chilldren = $this->SamChild->find('all')->where(['id IN'=> $subquery])->order(['SamChild.id' => 'DESC'])->toArray();

       //SELECT * FROM sam_child where id in (SELECT max(id) FROM sam_child GROUP BY data_children_id ) order by id desc
        $sam_chilldren_all = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->contain([
                            'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams','Blocks']);
                                                        }]])->order(['SamChild.id' => 'DESC'])->hydrate(false)->toArray();

       // $sam_chilldren = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->group('SamChild.data_children_id')
       // debug($sam_chilldren);die;

        // --------------------------------- TEAMWISE CHART queries ----------------------------------------------------

        $sam_chilldren_teams = $this->SamChild->find('all')->where(['SamChild.id IN'=> $subquery])->contain([
                            'DataChildren'=>['Anganwadis'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name'])->contain(['RbskTeams']);
                                                        }]])->group('RbskTeams.id')->order(['SamChild.id' => 'DESC'])->hydrate(false)->toArray();

        


       // pr($sam_chilldren_blocks);

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

    
    
       $children_count = $this->DataChildren->find('all')->contain([
                            'Anganwadis'=>['RbskTeams'=>function($q) {
                                                            return $q->autoFields(false)
                                                                ->select([ 'name']);
                                                        }]])->select([
																		'DataChildren.id',
																		'count' => "COUNT(DISTINCT DataChildren.id)",'name'=>"RbskTeams.name"
																	])->group('RbskTeams.id')->hydrate(false)->toarray();
			//	print_r($children_count); die;	




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
			//	$this->sendGoogleCloudMessage($rbsk_teams_dt['id'],'Dear '.$rbsk_teams_dt['name'].' '.$children_count_dt.' new children has been added in your RBSK team.',$children_count_dt,$children_dt['rbsk_team_id'],$Anganwadis_id);
				
			 }
		}
        $userRole = $this->Auth->user('role');
        $loginUserID = $this->Auth->user('id');
  
        
      
         
            $DataChildren = $this->DataChildren->find('all');
           
            /*Order list as per new and date wise*/
            $newOrders = $ordersModel->find('all')
                                     ->where(['Orders.status'=>1])
                                     ->contain(['customer_detail'=> function($q){
                                                                        return $q->select(['id','name','username']);
                                                                     }]);
            $todayStart =  date('Y-m-d')." 00:00:00";                    
            $todayEnd =  date('Y-m-d')." 23:59:00";                    
            $todayChildren = $this->DataChildren->find('all')
                                      //->where(['DataChildren.created_at'=> new \DateTime('today')]);
                                        ->where(['DataChildren.created_at >='=> $todayStart,'DataChildren.created_at <='=> $todayEnd]);
                                    //  debug($todayChildren); die;
            // print_r($todayChildren); die;
        
        
       

      //  $this->set(compact('DataChildren'));
        $this->set('allChildren', @$DataChildren);
        $this->set('sam_chilldren', @$sam_chilldren);
        $this->set('todayChildren', @$todayChildren);
        $this->set('children_count', @$children_count);
        $this->set('team_data', @$final_team_arr);
        $this->set('block_chart_data', @$final_team_arr_block);
        /*Order list as per new and date wise*/
        $this->set(['admins_info' => @$AllAdmins , 'usersInfo' => @$data]);
        //pr($newOrders);die;
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
      Function for Agent Details
    */
    function agentDetail($id){
        
        $user_id = convert_uudecode(base64_decode($id));
        $this->loadModel('OrderAssignments');
        $this->loadModel('OrderAssignmentLogs');
         
        $user_data = $this->Users->get($user_id); //GET USER DATA
        
         
        $open_orders = $this->OrderAssignments->find('all')
                ->where(['OrderAssignments.assign_to' => $user_id,'OrderAssignments.status_to' => 1])
                ->contain(['Orders','OrderPackages'])
                ->toArray();
     
        $assigned_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_by' => $user_id,'OrderAssignmentLogs.status' => 2])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->toArray();
      
        $completed_orders = $this->OrderAssignments->find('all')
                ->where(['OrderAssignments.assign_to' => $user_id,'OrderAssignments.status_to' => 3])
                ->contain(['Orders','OrderPackages'])
                ->toArray();
        //pr($assigned_orders); die;
        $this->set(compact('user_data','open_orders','assigned_orders','completed_orders'));    
    }
    
    /**
      Function for Driver Details
    */
    function driverDetail($id){
        
        $user_id = convert_uudecode(base64_decode($id));
        $this->loadModel('OrderAssignmentLogs');
        
        $user_data = $this->Users->get($user_id , ['contain' => ['UserDetails']]); //GET USER DATA
        
        //pr($user_data);die;
        $open_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status IN' => [1,2]])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->toArray();
                
        $completed_orders = $this->OrderAssignmentLogs->find('all')
                ->where(['OrderAssignmentLogs.assign_to' => $user_id,'OrderAssignmentLogs.status' => 3])
                ->contain(['OrderAssignments'=>['Orders','OrderPackages']])
                ->toArray();        
       // pr($open_orders);die;
        $this->set(compact('user_data','open_orders','completed_orders'));  
    
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
    
    function autoRefreshNotification(){
         
        if (!$this -> request -> is('ajax')) {
            return $this->redirect(['controller' => 'users','action' =>'dashboard']);
        }       
         
         /* NOTIFICATION CODE START*/
         
            $userRole = $this->Auth->user('role');
            $loggedInUserId = $this->Auth->user('id');
            $this->loadModel('UserLogs');
            $newNotifications='';
            $OldNotifications='';
            $newNotificationsCount=0;
                               
            $newNotifications = $this->UserLogs->find('all')
                                                  ->where(['UserLogs.notification_to'=>$loggedInUserId,'UserLogs.read_status'=>0])
                                                  ->order(['UserLogs.created_date' => 'DESC'])
                                                  ->contain(['sent_from'=> function($q) {
                                                                return $q->autoFields(false)
                                                                        ->select([ 'id','role','name','email']);
                                                            },
                                                            'sent_to'=> function($q) {
                                                                return $q->autoFields(false)
                                                                        ->select([ 'id','role','name','email']);
                                                            }])
                                                 ->hydrate(false)
                                                 ->group(['UserLogs.order_id','UserLogs.notification_from'])
                                                 ->toArray();   
                                                 
            $OldNotifications = $this->UserLogs->find('all')
                                                  ->where(['UserLogs.notification_to'=>$loggedInUserId,'UserLogs.read_status'=>1])
                                                  ->order(['UserLogs.created_date' => 'DESC'])
                                                  ->contain(['sent_from'=> function($q) {
                                                                return $q->autoFields(false)
                                                                        ->select([ 'id','role','name','email']);
                                                            },
                                                            'sent_to'=> function($q) {
                                                                return $q->autoFields(false)
                                                                        ->select([ 'id','role','name','email']);
                                                            }])
                                                 ->hydrate(false)
                                                 ->group(['UserLogs.order_id','UserLogs.notification_from'])
                                                 ->toArray();                                                      
            
            $newNotificationsCount = count($newNotifications);
            
            if($userRole != 4){
                $orderAction = base64_encode(convert_uuencode('open-orders'));
            }else{
                $orderAction = base64_encode(convert_uuencode('new-orders'));
            }
            
            $notification = '';
            $customNotification='';
            if(!empty($newNotifications) || !empty($OldNotifications)){
                $customNotification = '<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">';
                if(!empty($newNotifications)){
                    foreach($newNotifications as $new_notification){
                        
                        /*NOTIFICATION FOR Staff and Admin*/
                        if(($userRole==1 || $userRole==3) && ($new_notification['notification_type']=='order')){
                            $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($new_notification['order_id']));
                        }else if(($userRole==1 || $userRole==3)  && ($new_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->select(['Orders.descrates_app_id'])->where(['Orders.id' => $new_notification['order_id']])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        /*NOTIFICATION FOR Agent*/
                        if($userRole==3 && ($new_notification['notification_type']=='order')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $new_notification['order_id']])->contain(['OrderAssignments'])->select(['Orders.descrates_app_id','OrderAssignments.status_to'])->first();
                            if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==1){
                                $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }else if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==2){
                                $red_url = HTTP_ROOT.'orders/assigned-order-detail/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }else if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==3){
                                $red_url = HTTP_ROOT.'orders/completed-order-detail/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }   
                            
                        }else if($userRole==3 && ($new_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $new_notification['order_id']])->contain(['OrderAssignments'])->select(['Orders.descrates_app_id','OrderAssignments.status_to'])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        
                        /*NOTIFICATION FOR Driver*/
                        if($userRole==4 && ($new_notification['notification_type']=='order')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $new_notification['order_id']])->contain(['OrderAssignmentLogs'])->select(['Orders.descrates_app_id','OrderAssignmentLogs.status'])->first();
                            
                            if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==1){
                                $red_url = HTTP_ROOT.'orders/new-order-detail-driver/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==2){
                                $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==3){
                                $red_url = HTTP_ROOT.'orders/completed-order-detail-driver/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==4){
                                $red_url = HTTP_ROOT.'orders/rejected-order-detail-driver/'.base64_encode(convert_uuencode($new_notification['order_id']));
                            }   
                            
                        }else if($userRole==4 && ($new_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $new_notification['order_id']])->contain(['OrderAssignmentLogs'])->select(['Orders.descrates_app_id','OrderAssignmentLogs.status'])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        
                        $customNotification .='<li class="new_notification">
                                                    <a href="javascript:void(0);">
                                                        <span class="time">'.$this->humanTiming(strtotime($new_notification['created_date'])).'</span>
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span> '.$new_notification['description'].'. </span>
                                                    </a>
                                                </li>';
                    }
                }
                
                if(!empty($OldNotifications)){
                    foreach($OldNotifications as $old_notification){
                        /*NOTIFICATION FOR Staff and Admin*/
                        if(($userRole==1 || $userRole==3) && ($old_notification['notification_type']=='order')){
                            $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($old_notification['order_id']));
                        }else if(($userRole==1 || $userRole==3)  && ($old_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->select(['Orders.descrates_app_id'])->where(['Orders.id' => $old_notification['order_id']])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        /*NOTIFICATION FOR Agent*/
                        if($userRole==3 && ($old_notification['notification_type']=='order')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $old_notification['order_id']])->contain(['OrderAssignments'])->select(['Orders.descrates_app_id','OrderAssignments.status_to'])->first();
                            if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==1){
                                $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }else if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==2){
                                $red_url = HTTP_ROOT.'orders/assigned-order-detail/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }else if(isset($orders->order_assignment->status_to) && $orders->order_assignment->status_to==3){
                                $red_url = HTTP_ROOT.'orders/completed-order-detail/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }   
                            
                        }else if($userRole==3 && ($old_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $old_notification['order_id']])->contain(['OrderAssignments'])->select(['Orders.descrates_app_id','OrderAssignments.status_to'])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        
                        /*NOTIFICATION FOR Driver*/
                        if($userRole==4 && ($old_notification['notification_type']=='order')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $old_notification['order_id']])->contain(['OrderAssignmentLogs'])->select(['Orders.descrates_app_id','OrderAssignmentLogs.status'])->first();
                            
                            if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==1){
                                $red_url = HTTP_ROOT.'orders/new-order-detail-driver/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==2){
                                $red_url = HTTP_ROOT.'orders/open-order-detail/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==3){
                                $red_url = HTTP_ROOT.'orders/completed-order-detail-driver/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }else if(isset($orders->order_assignment_log->status) && $orders->order_assignment_log->status==4){
                                $red_url = HTTP_ROOT.'orders/rejected-order-detail-driver/'.base64_encode(convert_uuencode($old_notification['order_id']));
                            }   
                            
                        }else if($userRole==4 && ($old_notification['notification_type']=='track')){
                            $orders = $this->Orders->find('all')->Where(['Orders.id' => $old_notification['order_id']])->contain(['OrderAssignmentLogs'])->select(['Orders.descrates_app_id','OrderAssignmentLogs.status'])->first();
                            $red_url = HTTP_ROOT.'orders/track-order/'.$orders->descrates_app_id;
                        }
                        
                        $customNotification .='<li>
                                                    <a href="javascript:void(0);">
                                                        <span class="time">'.$this->humanTiming(strtotime($old_notification['created_date'])).'</span>
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span> '.$old_notification['description'].'. </span>
                                                    </a>
                                                </li>';
                    }
                }
                
                $customNotification .= '</ul>';
                
            }               
            
            $notification = '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default">'.$newNotificationsCount.'</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">'.$newNotificationsCount.' pending</span> notifications</h3>
                                        <a href="'.HTTP_ROOT.'orders/view-all/'.$orderAction.'">view all</a>
                                    </li>
                                    <li>
                                        '.$customNotification.'
                                    </li>
                                </ul>
                            ';
            
        echo $notification; die;    
        /* NOTIFICATION CODE END*/
    }
    
    public function customersListing()
    {   
        $roles = Configure::read('users.roles');
        $this->set('roles', $roles);
        $query = $this->Users->find('all')->where(['role' => CUSTOMER_ROLE])->contain(['UserDetails'])->order(['created' => 'DESC']);
        $userRole = $this->Auth->user('role');
      
        $this->set('users', $query);
        $this->set('_serialize', ['Users']);
    }
    
    public function editCustomer($id = null)
    {   

        $id = convert_uudecode(base64_decode($id));

        $user = $this->Users->get( $id, ['contain' => [] ] );

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->role = CUSTOMER_ROLE;

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

                return $this->redirect(['action' => 'customers-listing']);
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
      Function for Driver Details
    */
    function customerDetail($id){
        
        $user_id = convert_uudecode(base64_decode($id));
        $this->loadModel('Orders');
        
        $user_data = $this->Users->get($user_id , ['contain' => ['UserDetails']]); //GET USER DATA
                
        $open_orders = $this->Orders->find('all')
                ->where(['Orders.customer_id' => $user_id,'Orders.status IN' => [1,2]])
                ->hydrate(false)
                ->toArray();
                
        $completed_orders = $this->Orders->find('all')
                ->where(['Orders.customer_id' => $user_id,'Orders.status IN' => [3]])
                ->hydrate(false)
                ->toArray();
                       
       //pr($open_orders);die;
        $this->set(compact('user_data','open_orders','completed_orders'));  
    
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
