<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                <i class="fa fa-circle"></i>
			</li>
			
			<li>
				<a href="<?= HTTP_ROOT.'cmspages/email-templates'; ?>">Email templates</a>
                <i class="fa fa-circle"></i>
			</li>
			
			 <li>
				<span>Edit email template</span>
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
							<i class="fa fa-envelope-o"></i>Email templates </div>
							<div class="tools">
								<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body form">
							  <?php echo $this->Form->create(null, [
										'url' => ['controller' => 'cmspages', 'action' => 'email-template-edit'],
										'class'=>'horizontal-form',
										'id'=>'templateedit',
										'enctype'=>'multipart/form-data',
										'novalidate'=>'novalidate',
										 'autocomplete'=>'off'
								
								 ]);

									echo $this->Form->input('EmailTemplates.id',[
										'type'=>'hidden',
										'value'=>$emailTemp->id]);
								 ?>
									
						  <div class="form-body">
							
							<h3 class="form-section">Update information</h3>			
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Title <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										   echo $this->Form->input('EmailTemplates.title',[
											  'label' => false,
											  'required' => true,
											  'maxlength' => TEXT_LIMIT,
											  'class'=>'form-control',
											  'value'=>$emailTemp->title != ''?$emailTemp->title:'']);
										?>
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Subject <span class="required">*</span>
									  </label>
									  <div >
										<?php echo $this->Form->input('EmailTemplates.subject',[
										  'label' => false,
										  'required' => true,
										  'maxlength' => TEXT_LIMIT,
										  'class'=>'form-control',
										  'value'=>$emailTemp->subject != ''?$emailTemp->subject:'']);
										?>
									  </div>
									</div>
								</div>
								
							</div>
							
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Allow vars <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										   echo $this->Form->input('EmailTemplates.allowed_vars',[
												'label' => false,
												'required' => true,
												'readonly' => 'readonly',
												'disabled' => 'disabled',
												'class'=>'form-control',
												'value'=>$emailTemp->allowed_vars != ''?$emailTemp->allowed_vars:'']);
										?>  
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Email from <span class="required">*</span>
									  </label>
									  <div >
										 <?php   echo $this->Form->input('EmailTemplates.email_from',[
												  'label' => false,
												  'required' => true,
												  'maxlength' => TEXT_LIMIT,
												  'class'=>'form-control',
												  'value'=>$emailTemp->email_from != ''?$emailTemp->email_from:'']);
										  ?>
									  </div>
									</div>
								</div>
								
								
							</div>
							<div class="row">
								
							
								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Email name<span class="required">*</span>
									  </label>
									  <div >
										<?php   
										echo $this->Form->input('EmailTemplates.email_name',[
												  'label' => false,
												  'required' => true,
												  'maxlength' => TEXT_LIMIT,
												  'class'=>'form-control',
												  'value'=>$emailTemp->email_name != ''?$emailTemp->email_name:'']);
										  ?>
									  </div>
									</div>
								</div>
								
							</div>
							<div class="row">
								
							
								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Email content <span class="required">*</span>
									  </label>
									  <div >
										  <?php echo $this->Form->textarea('EmailTemplates.description',[
												   'escape' => false,
												   'label' => false,
												   'value'=>$emailTemp->description != ''?$emailTemp->description:'',
												   'class'=>'form-control col-md-7 col-xs-12 tinymce', 'id'=>'elm1']);
										?>
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

<style>
.form-body {
  padding: 10px 20px !important;
}
</style>
<?php //echo $this->element('adminElements/phone_drop_down'); ?>
<?php echo $this->element('adminElements/main_editor');?>
