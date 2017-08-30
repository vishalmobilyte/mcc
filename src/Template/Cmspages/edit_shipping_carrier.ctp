<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?= HTTP_ROOT.'users/dashboard'; ?>">Dashboard</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="<?= HTTP_ROOT.'cmspages/shipping-carriers'; ?>">Shipping carrier management</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Edit shipping carrier</span>
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
              <i class="fa fa-truck"></i>Edit shipping carrier</div>
              <div class="tools">
                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
              </div>
            </div>
            <div class="portlet-body form">
          
              <?php echo $this->Form->create($carrierInfo,[
              'url'    => ['controller' => 'cmspages', 'action' => 'edit-shipping-carrier' , $carrierInfo->convertedId],
              'class'   =>'horizontal-form',
              'id'    =>'addShipping',
              'enctype' =>'multipart/form-data',
              'novalidate'=>'novalidate',
              'autocomplete'=>'off'
              ]); ?>
              <div class="form-body">
              <h3 class="form-section">Shipping carrier info</h3>
              <div class="row">
                
                <div class="col-md-12">
                  <div class="form-group" >
                    <label for="exampleInputPassword1">Carrier name <span class="required">*</span>
                    </label>
                    <div >
                     
                      <select class='form-control input-medium' name="carrier_name" id="carrier_name">
						 <?php 
						 $carrier_name_array=array("fedex"=>'FedEx',"ups"=>'UPS',"dhl"=>'DHL',"yrc"=>'YRC',"estes"=>'Estes'); 
						  if(!empty($carrier_name_array)){
						  foreach($carrier_name_array as $carrier_key=>$carrier_val){
							?>
							<option <?php if($carrierInfo['carrier_name']==$carrier_key){echo "selected"; }?> value='<?php echo $carrier_key; ?>'><?php echo $carrier_val; ?></option>
							<?php
						  }
						  }
						?>
						</select> 
                    </div>
                  </div>
                </div>
              </div>
              
             <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country code <span class="required">*</span>
                    </label>
                    <select class='form-control input-small' name="country_code" id="countries">
                     <?php 
                      if(!empty($country_info)){
                      foreach($country_info as $cc_key=>$cc_val){
                        ?>
                        <option <?php if($carrierInfo['country_code']==$cc_key){echo "selected"; }?> value='<?php echo $cc_key; ?>' data-image="<?php echo HTTP_ROOT; ?>img/blank.gif" data-imagecss="flag <?php echo strtolower($cc_val); ?>"><?php echo $cc_key; ?></option>
                        <?php
                      }
                      }
                    ?>
                    </select> 
                  </div>
                  
                </div>
                <div class="col-md-6">
                  <div class="form-group" >
                    <label for="exampleInputPassword1">Phone <span class="required">*</span>
                    </label>
                    <div >
                    <?php 
                    echo $this->Form->input('phone',[
                       'label' => false,
                       'required' => true,
                       'class'=>'form-control']);
                    ?>
                    </div>
                  </div>
                  
                </div>
              </div>
              
              
            </div>    
             <div class="form-actions right">
                <button type="button"  class="btn default" onclick="window.history.go(-1);"  >Cancel</button>
                <button id="send" type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
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
