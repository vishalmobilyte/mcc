<div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                <i class="fa fa-circle"></i>
      </li>
     
       <li>
        <span>Website settings</span>
      </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->

<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->

<div class="row">
	
	<div class="col-md-12">
		
		<div class="portlet light bordered">
			
			<div class="portlet-body form">
				
				<div class="row">
					
					<div id="tab_1" class="tab-pane active">
							
						<div class="portlet box blue">
							
							<div class="portlet-title">
								
								<div class="caption">
									<i class="fa fa-gears"></i>Website settings
								</div>
								
								<div class="tools">
									<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
								</div>
							
							</div>
							
							<div class="portlet-body form">
          
								<?php echo $this->Form->create($settings,[
								  'url'     => ['controller' => 'Users', 'action' => 'website-settings'],
								  'class'   =>'horizontal-form',
								  'id'    =>'settings',
								  'enctype' =>'multipart/form-data',
								  'novalidate'=>'novalidate',
								  'autocomplete'=>'off'
								  ]); 
								?>
								
								<div class="form-body">
									
									<h3 class="form-section">Change website settings</h3>
              
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Site title <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('site_title',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Text field limit <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('input_text_limit',[
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Site owner title <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('site_owner_email',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">New user notification email <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('new_user_notification_email',[
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>

									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Otp Message <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('otp_message',[
													 'label' => false,
												     'type' => 'textarea',
												     'maxlength' => 160,
												     'required' => true,
												     'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Login message <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('login_message',[
												   'label' => false,
												   'type' => 'textarea',
												   'maxlength' => 160,
												   'required' => true,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									<h4 class="form-section caption-subject font-green bold uppercase">Fedex Details</h4>
									
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">FedEx access key <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('fedex_access_key',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">FedEx password <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('fedex_password',[
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">FedEx account number <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('fedex_account_number',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">FedEx meter number <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('fedex_meter_number',[
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									<h4 class="form-section caption-subject font-green bold uppercase">UPS Details</h4>
									
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">UPS access code <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('ups_access_code',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">UPS user id <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('ups_user_id',[
												   'type' => 'text',
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									<div class="row">

										<div class="col-md-12">
										  <div class="form-group" >
											<label for="exampleInputPassword1">UPS password <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('ups_password',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>
									
									</div>	
									
									<h4 class="form-section caption-subject font-green bold uppercase">Twilio Details</h4>
									
									<div class="row">

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Twilio sid <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('twilio_sid',[
													 'label' => false,
													 'required' => true,
													 'maxlength' => TEXT_LIMIT,
													 'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

										<div class="col-md-6">
										  <div class="form-group" >
											<label for="exampleInputPassword1">Twilio auth token <span class="required">*</span></label>
											<div>
												<?php 
												  echo $this->Form->input('twilio_auth_token',[
												   'label' => false,
												   'required' => true,
												   'maxlength' => TEXT_LIMIT,
												   'class'=>'form-control']);
												?>
											</div>
										  </div>
										</div>

									</div>
									
									
								</div>    

								<div class="form-actions right">
									<button type="button"  class="btn default" onclick="window.history.go(-1);"  >Cancel</button>
									<button id="send" type="submit" class="btn blue"><i class="fa fa-check"></i> Update</button>
								</div>
              
								<?php echo $this->form->end(); ?>
							
							</div>
          
						</div>
					
					</div>
				
				</div>    
			
			</div>
      
		</div>
  
	</div>
	
</div><style>
    
.form-body {
  padding: 10px 20px !important;
}
.form .form-actions, .portlet-form .form-actions {
  background-color: #f5f5f5 !important;
  border-top: 1px solid #e7ecf1;
  margin: 0;
  padding: 20px !important;
}
p.note_msg {
  bottom: 0;
  position: relative;
  top: 20px;
}
</style>
