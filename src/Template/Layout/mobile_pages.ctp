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
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
       <!--  <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <!-- <link href="<?php echo HTTP_ROOT;?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo HTTP_ROOT;?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
      <!--   <link href="<?php echo HTTP_ROOT;?>assets/pages/css/login.min.css" rel="stylesheet" type="text/css" /> -->
	<!-- <link rel="icon" href="<?php echo HTTP_ROOT; ?>img/uploads/favicon.jpg" sizes="32x32" /> -->
    
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <link href="<?php echo HTTP_ROOT; ?>assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo HTTP_ROOT; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href=".<?php echo HTTP_ROOT; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <link href="<?php echo HTTP_ROOT; ?>assets/pages/css/log.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HTTP_ROOT; ?>assets/pages/css/custom-css.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?php echo HTTP_ROOT;?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
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

<body style="background:#fff !important" class="login" >
	<!-- BEGIN HEADER -->
        <?php echo $this->element('mobileElements/header'); ?>
                <!-- END HEADER -->
                <!-- BEGIN HEADER & CONTENT DIVIDER -->
                <div class="clearfix"> </div>
                <!-- END HEADER & CONTENT DIVIDER -->
                <!-- BEGIN CONTAINER -->
                <div class="paddingT50 page-container">
                    <div class="page-content-wrapper">
                        <div class="container">
                        <div class="clearfix"> </div>
                        <div class="clearfix"> </div>
                        <?php echo $this->Flash->render(); ?>
                        <?= $this->fetch('content');?>
                        </div>
                    </div>
                </div>
        <?php echo $this->element('mobileElements/footer'); ?>
</body>

<script src="<?php echo HTTP_ROOT;?>js/front-developer.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('div.success, div.error').on('click',function(){
			$(this).slideUp(1000);
	});
	setInterval(function() {
		
	   $('div.success, div.flasherror').slideUp();
	}, 5000);

});

</script>
<style>
.paddingT50{padding-top:50px;}
.bgBlue{background:#2d5f8b;}
</style>
</html>
