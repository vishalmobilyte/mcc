<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                <i class="fa fa-circle"></i>
			</li>
			
			 <li>
				<span>Change password</span>
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
							<i class="fa fa-unlock-alt"></i>Change password </div>
							<div class="tools">
								<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body form">
          
							 <?php echo $this->Form->create($user,[
							'url' 		=> ['controller' => 'Users', 'action' => "changePassword/".@$action, $user->convertedId],
							'class'		=>'horizontal-form',
							'id'		=>'changePassword',
							'enctype'	=>'multipart/form-data',
							'novalidate'=>'novalidate',
							 // 'autocomplete'=>'off',
									]) ?>
						  <div class="form-body">
							<h3 class="form-section">Set secure password </h3>
							
							<div class="row">
								
								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Old password <span class="required">*</span>
									  </label>
									  <div >
									
										<?php 
											echo $this->Form->input('oldpassword',[
											   'label' => false,
											   'type'	=> 'password',
											   'required' => true,
											   'class'=>'form-control']);
											?>
											<div class="error-message"><?php if(isset($error)){echo $error; }?></div>
									  </div>
									</div>
										
								</div>
								
							
							</div>
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">New password <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										echo $this->Form->input('password',[
										   'label' => false,
										   'type'	=> 'password',
										   'required' => true,
										   'class'=>'form-control']);
										?>
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Confirm password <span class="required">*</span>
									  </label>
									  <div >
										<?php 
											echo $this->Form->input('passwordConfirm',[
											   'label' => false,
											   'required' => true,
											   'type'	=> 'password',
											   'class'=>'form-control']);
											?>
									  </div>
									</div>
								</div>
							</div>
							
						</div>		
						 <div class="form-actions right">
								<button type="button"  class="btn default" onclick="window.history.go(-1);"  >Cancel</button>
								<button id="send" type="submit" class="btn blue"><i class="fa fa-check"></i> Change password</button>
								
						  
						  </div>
						  
						 <?php echo $this->form->end(); ?>
					 </div>
					
					</div>
				</div>
			</div>		
         
         
        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $this->element('adminElements/phone_drop_down'); ?>
