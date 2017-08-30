<script type="text/javascript"> var base_url = '<?php echo HTTP_ROOT; ?>'</script>
<?php 
if($this->request->params['action'] != 'index')
{
    $set_filename_csv = $this->request->params['controller']."-".$this->request->params['action'];
}
else
{
    $set_filename_csv = $this->request->params['controller'];
}
?>
<script type="text/javascript"> var set_filename_csv = '<?php echo $set_filename_csv; ?>'</script>

<div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                   <a href="<?php echo HTTP_ROOT.'users/dashboard';?>" style="font-size: 22px; font-weight: bold; color: #fff; position: absolute; top: 9px; left: 37px;">
                   <!-- <img height="30" class="logo-default img-responsive" alt="logo" src="<?php echo HTTP_ROOT; ?>/assets/images/logo_inner.png"> -->
SWAASTHMAAP
                <!--    <img class=" sizeLogo logo-default" src="<?php echo HTTP_ROOT.'img/uploads/'.(@$siteinfo->site_logo != ''?@$siteinfo->site_logo:'logo.jpg'); ?>"/> -->
                        <!-- <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> --> </a>
                    
                </div>
                <!-- END LOGO -->
            
               
            </div>
            <!-- END HEADER INNER -->
        </div>
<style>
.sizeLogo{
	height:45px;
	width:110px;
}
</style>
