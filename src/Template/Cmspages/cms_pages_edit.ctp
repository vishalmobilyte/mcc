<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
                <i class="fa fa-circle"></i>
			</li>
			
			<li>
				<a href="<?= HTTP_ROOT.'cmspages/cms-pages'; ?>">CMS pages</a>
                <i class="fa fa-circle"></i>
			</li>
			
			 <li>
				<span>Edit cms page</span>
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
							<i class="icon-layers"></i>CMS page </div>
							<div class="tools">
								<a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
							</div>
						</div>
						<div class="portlet-body form">
							  <?php echo $this->Form->create(null, [
										'url' => ['controller' => 'cmspages', 'action' => 'cms-pages-edit'],
										'class'=>'horizontal-form',
										'id'=>'cmspageedit',
										'enctype'=>'multipart/form-data',
										'novalidate'=>'novalidate',
										 'autocomplete'=>'off'
								
								 ]);

								  echo $this->Form->input('CmsPages.id',[
															'type'=>'hidden',
															'value'=>$page->id]);
								 ?>
								 
						  <div class="form-body">
							
							<h3 class="form-section">Update information</h3>					
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Page name <span class="required">*</span>
									  </label>
									  <div >
										 <?php 
												echo $this->Form->input('CmsPages.pagename',[
														'label' => false,
														'class'=>'form-control col-md-7 col-xs-12',
														'id'=>'pagename',
														'maxlength' => TEXT_LIMIT,
														'value'=>$page->pagename != ''?$page->pagename:'']
												);
											?>
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Page url <span class="required">*</span>
									  </label>
									  <div >
										<?php 
                                  
										  echo $this->Form->input('CmsPages.pageurl',[
														'label' => false,
														'readonly' => true,
														'id'=>'pageurl',
														'maxlength' => TEXT_LIMIT,
														'class'=>'form-control col-md-7 col-xs-12',
														'value'=>$page->pageurl != ''?$page->pageurl:'']);
										?>
									  </div>
									</div>
								</div>
								
							</div>
							
							
							<div class="row">
								
								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Page heading <span class="required">*</span>
									  </label>
									  <div >
										<?php 
										   echo $this->Form->textarea('CmsPages.pageheading',
													 ['escape' => false,
													 'class'=>'form-control col-md-7 col-xs-12' ,
													 'id'=>'pageheading',
													 'maxlength' => TEXT_LIMIT,
													 'value'=>$page->pageheading != ''?$page->pageheading:'']);
											?>  
									  </div>
									</div>
								</div>
							
							</div>	
							
							
							<div class="row">	
								<div class="col-md-12">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Page content <span class="required">*</span>
									  </label>
									  <div >
										 <?php   echo $this->Form->textarea('CmsPages.pagecontent',
													 ['escape' => false,
													 'value'=>$page->pagecontent != ''?$page->pagecontent:'',
													 'id'=>'pagecontent',
													 'class'=>'form-control col-md-7 col-xs-12 tinymce', 'id'=>'elm1']);
										  ?>
									  </div>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group" >
									  <label for="exampleInputPassword1">Banner image <span class="required">*</span>
									  </label>
									  <div >
										  <?php   echo $this->Form->file('CmsPages.banner_image',[
												  'label' => false,
												  'class'=>'form-control col-md-7 col-xs-12']);
											?>
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group" >
										<label for="exampleInputPassword1">&nbsp;</span>
									  <div >
										<img class="profile_img catImg  img-thumbnail"  src="<?php echo HTTP_ROOT.'img/uploads/'.($page->banner_image != ''?$page->banner_image:'no-image.png'); ?>"/>
									  </div>
									</div>
								</div>
								
							</div>
						
						</div>		
						<div style="padding: 20px !important;" class="form-actions right">
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
<?php echo $this->element('adminElements/main_editor');?>

<script>
/*SCRIPT FOR EDIT CMS PAGE START*/
 $(document).ready(function(){
				
	});
/*SCRIPT FOR EDIT CMS PAGE END*/
</script>
