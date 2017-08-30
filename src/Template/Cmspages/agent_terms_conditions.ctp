<div class="page-content-wrapper">
	<!-- BEGIN CONTENT BODY -->
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
 
		<!-- BEGIN PAGE BAR -->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="index.html">Agent</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<span>Terms & conditions</span>
					
				</li>
			</ul>
			<span style="margin-top: 7px;" class="pull-right">
				<a style="text-decoration:none"  target="_blank" href="<?php echo HTTP_ROOT.'terms.pdf'; ?>" target="_blank">
					<img style="width:30px;" src="<?php echo HTTP_ROOT.'img/pdf_download.png'; ?>"> Download
				</a>
			</span>
		</div>
		<!-- END PAGE BAR -->
		<!-- BEGIN PAGE TITLE-->
                        
		<!-- END PAGE TITLE-->
		<!-- END PAGE HEADER-->
		
		<div class="c-content-feedback-1 c-option-1">
			<div class="row">
				<div class="col-md-12"></div>
				<div class="col-md-12">
					<div class="c-contact">
						<div class="c-content-title-1">
							<h3 class="uppercase">
								<?php echo ($CmsPageData->pagename !='')?$CmsPageData->pagename:'Heading not set yet.'; ?>
							</h3>
                            <?php echo ($CmsPageData->pagecontent !='')?$CmsPageData->pagecontent:'Content not set yet.'; ?>
                        </div>
                                        
					</div>
				</div>
			</div>
			 <?php 
				echo $this->Form->create(null, [
					'url' => ['controller' => 'Users', 'action' => 'update-accept-term-for-agent'],
					'id'=>'formsubmit',
					'class' =>'login-form',
					'autocomplete' =>'off',
				]);
			?>
			<div class="form-actions">
				<label class="rememberme check mt-checkbox mt-checkbox-outline">
					<input type="checkbox" value="1" name="agree_terms"> I agree to the Terms of Service & Privacy Policy.
					<span></span>
				</label>
			
			</div>
			<div class="form-actions">
				<button class="btn green pull-left" type="submit"> Accept and continue </button>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php 
			echo $this->Form->end();
		?>
	</div>
	<!-- END CONTENT BODY -->
</div>
