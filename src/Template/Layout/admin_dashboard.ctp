<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes 
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo SITE_TITLE;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
       
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo HTTP_ROOT; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
		 
        <link href="<?php echo HTTP_ROOT; ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT; ?>assets/layouts/layout/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo HTTP_ROOT; ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.ico" />  -->
        <!-- <link rel="icon" href="<?php echo HTTP_ROOT; ?>img/uploads/favicon.jpg" sizes="32x32" /> -->
        </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <?php echo $this->element('adminElements/header'); ?>
         
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <?php echo $this->element('adminElements/left_sidebar'); ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    <?php // echo $this->element('adminElements/admin_theme_panel'); ?>
                    
                    <!-- END THEME PANEL -->
					<!-- BEGIN Content INCLUDE -->

                     <?php echo $this->Flash->render(); ?>
                    <?php echo $this->fetch('content');?>
                    <!-- END Content INCLUDE -->
                    <!-- BEGIN PAGE BAR -->
                     
                    </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
    
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php echo $this->element('adminElements/footer'); ?>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
		<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/respond.min.js"></script>
		<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
       
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
       
        <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
 
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo HTTP_ROOT; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo HTTP_ROOT; ?>assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo HTTP_ROOT;?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT;?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		<script src="<?php echo HTTP_ROOT;?>js/table-datatables-responsive.js"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT; ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    
        <!-- END THEME LAYOUT SCRIPTS -->
           <!-- END THEME LAYOUT SCRIPTS -->          
           <script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<script src="<?php echo HTTP_ROOT;?>js/form-validation.js"></script>
        <script src="<?php echo HTTP_ROOT;?>js/developer.js"></script>
        <link href="<?php echo HTTP_ROOT; ?>css/developer.css" rel="stylesheet" type="text/css" />
		<?php if (isset($authUser['role']) && in_array( $authUser['role'], ['3','4']) ) { ?>
			<script>
			$(function(){
				
				//GET USER MESSAGES COUNT
				setInterval(function(){
						var actionURL = '<?php echo HTTP_ROOT; ?>users/auto-refresh-notification';
						
						$.ajax({
							url: actionURL,//AJAX URL WHERE THE LOGIC HAS BUILD
									 
							success:function(res)
							{
							
								$('.autoRefresh').html($.trim(res));
									
							}
						});
						
				}, 5000);//END
				
			});
			</script>
		<?php } ?>		
    </body>

</html>


