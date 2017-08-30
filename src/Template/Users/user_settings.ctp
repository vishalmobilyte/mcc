<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Notification settings</span>
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
							<i class="fa fa-user"></i>Notification settings </div>
							<div class="tools">
								<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body form">
          
							<?php echo $this->Form->create(@$UserSettings,[
									'url' 		=> ['controller' => 'Users', 'action' => 'user-settings'],
									'class'		=>'horizontal-form',
									'id'		=>'user_settings',
									'enctype'	=>'multipart/form-data',
									'novalidate'=>'novalidate'
									 // 'autocomplete'=>'off',
							]); ?>		
						  <div class="form-body">
							<h3 class="form-section">Notification info</h3>
							
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
												<label class="control-label">Do you want to recieve mobile notifications ?</label>
												<div class="mt-radio-inline">
													<label class="mt-radio">
														<input name="UserSettings[mobile_notification]" id="yes" value="1" <?php if(isset($user_settings_data->mobile_notification) && $user_settings_data->mobile_notification==1){echo "checked"; } ?> type="radio"> Yes
														<span></span>
													</label>
													<label class="mt-radio">
														<input name="UserSettings[mobile_notification]" id="no" value="0" <?php if(isset($user_settings_data->mobile_notification) && $user_settings_data->mobile_notification==0){echo "checked"; } ?> type="radio"> No
														<span></span>
													</label>
													
												</div>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
												<label class="control-label">Do you want to recieve email notifications ?</label>
												
												<div class="mt-radio-inline">
													<label class="mt-radio">
														<input name="UserSettings[email_notification]" id="yes" value="1" <?php if(isset($user_settings_data->email_notification) && $user_settings_data->email_notification==1){echo "checked"; } ?> checked type="radio"> Yes
														<span></span>
													</label>
													<label class="mt-radio">
														<input name="UserSettings[email_notification]" id="no" value="0" <?php if(isset($user_settings_data->email_notification) && $user_settings_data->email_notification==0){echo "checked"; } ?> type="radio"> No
														<span></span>
													</label>
													
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
  </div>
</div>

<?php echo $this->element('adminElements/phone_drop_down'); ?>
