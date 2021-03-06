
<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                <i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="<?= HTTP_ROOT.'anganwadis/listing'; ?>">Anganwadis</a>
                <i class="fa fa-circle"></i>
			</li>
			 <li>
				<span>Add Anganwadi</span>
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
							<i class="fa fa-building-o"></i>Add Anganwadi </div>
							<div class="tools">
								<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body form">
          
							<?php echo $this->Form->create($user,[
							'url' 		=> ['controller' => 'Anganwadis', 'action' => 'add-agw'],
							'class'		=>'horizontal-form',
							'id'		=>'agwAdd',
							'enctype'	=>'multipart/form-data',
							'novalidate'=>'novalidate',
							'autocomplete'=>'off'
							]); ?>
						  <div class="form-body">
							<h3 class="form-section">Anganwadi</h3>
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Name <span class="required">*</span>
									  </label>
									  <div >
									
										<?php 
											echo $this->Form->input('name',[
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
									  <label for="exampleInputPassword1">AWC Code <span class="required">*</span>
									  </label>
									  <div >
										<?php 
											echo $this->Form->input('awc_code',[
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
									  <label for="exampleInputPassword1">DTCODE <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										echo $this->Form->input('dtcode',[
										   'label' => false,
										 
										   'maxlength' => TEXT_LIMIT,
										   'class'=>'form-control']);
										?>
									  </div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">PJCODE <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										echo $this->Form->input('pjcode',[
										   'label' => false,
										 
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
									  <label for="exampleInputPassword1">AWC Type <span class="required">*</span>
									  </label>
									  <div >
										<select class='form-control' name="awc_type" id="worker_type" rel_url="<?php echo HTTP_ROOT; ?>/anganwadis/get-circles"  >
										<option value="">Select Type</option>
										
											  
											  <option value='AWC' >AWC</option>
											  <option value='Mini AWC' >Mini AWC</option>
											  
										
									  </select> 
									  </div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Block <span class="required">*</span>
									  </label>
									  <div >
										<select class='form-control' name="block_id" id="blocks_list" rel_url="<?php echo HTTP_ROOT; ?>/anganwadis/get-circles"  onclick="getCircleOptions(this);" >
										<option value="">Select Block</option>
										 <?php 
										  if(!empty($block_list)){
											foreach($block_list as $cc_key=>$cc_val){
											  ?>
											 
											  
											  <option value='<?php echo $cc_key; ?>' ><?php echo $cc_val; ?></option>
											  
											  <?php
											}
										  }
										?>
									  </select> 
									  </div>
									</div>
								</div>

								<!-- <div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Circle <span class="required">*</span>
									  </label>
									  <div >
										<select class="form-control" name="circle_id" id="circle_options">
											<option>Select Circle</option>
										</select>
									  </div>
									</div>
								</div> -->

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Circle <span class="required">*</span>
									  </label>
									  <div >
										<select class="form-control" name="circle_id" id="circle_options">
											<option>Select Circle</option>
										</select>
									  </div>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Select team <span class="required">*</span>
									  </label>
									  <div >
										<select class='form-control' name="rbsk_team_id" id="team_list" rel_url="<?php echo HTTP_ROOT; ?>/anganwadis/get-circles"  onclick="getRbskTeams(this);" >
											<option value="">Select team</option>
											 <?php 
											  if(!empty($teams_list)){
												foreach($teams_list as $tl_key=>$tl_val){
												  ?>
												   <option value='<?php echo $tl_key; ?>' ><?php echo $tl_val; ?></option>
												  <?php
												}
											  }
											?>
									    </select> 
									  </div>
									</div>
								</div>
							</div>

							
							
						
						
							
						</div>		
						 <div class="form-actions right">
								<button type="button"  class="btn default" onclick="window.history.go(-1);"  >Cancel</button>
								<button id="send" type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								
						 
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
