<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <title><?php echo SITE_TITLE;?></title>

    <!-- Bootstrap core CSS -->
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
     <!-- BEGIN THEME LAYOUT STYLES -->

	<link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME LAYOUT STYLES -->
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<link href="<?php echo HTTP_ROOT; ?>assets/pages/css/contact.min.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo HTTP_ROOT; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href=".<?php echo HTTP_ROOT; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    
    
	

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

	<!-- Custom Css for sonoclick -->
	<link href="<?php echo HTTP_ROOT;?>css/developer.css" rel="stylesheet" type="text/css" />
	<!-- End Custom Css -->
</head>


    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <?php echo $this->element('adminElements/header'); ?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
               

                    <!-- BEGIN Content INCLUDE -->

                     <?php echo $this->Flash->render(); ?>
                    <?php echo $this->fetch('content');?>
                    <!-- END Content INCLUDE -->

               
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
    
        </div>
        <!-- END CONTAINER -->
       
        <!--[if lt IE 9]>
		<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/respond.min.js"></script>
		<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
       
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo HTTP_ROOT;?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS 
        <script src="<?php echo HTTP_ROOT;?>assets/pages/scripts/table-datatables-buttons.js" type="text/javascript"></script>-->
        <!-- <script src="<?php echo HTTP_ROOT;?>assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo HTTP_ROOT;?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT;?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
      
        <script src="<?php echo HTTP_ROOT;?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->          

        <script src="<?php echo HTTP_ROOT;?>js/developer.js"></script>
         <link href="<?php echo HTTP_ROOT; ?>/css/developer.css" rel="stylesheet" type="text/css" />

    </body>


<script>
$(document).ready(function(){
	$('div.success, div.error').on('click',function(){
			$(this).slideUp(1000);
	});
	setInterval(function() {
		
	   $('div.success, div.error').slideUp();
	}, 5000);
});
</script>
</html>
