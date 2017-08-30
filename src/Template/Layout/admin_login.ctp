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
    <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
      
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <link href="<?php echo HTTP_ROOT; ?>assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo HTTP_ROOT; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href=".<?php echo HTTP_ROOT; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <link href="<?php echo HTTP_ROOT; ?>assets/pages/css/custom-css.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  
    
	<!--[if lt IE 9]>
		<script src="../assets/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Custom Css for sky2c -->
	<link href="<?php echo HTTP_ROOT;?>css/developer.css" rel="stylesheet" type="text/css" />
	<!-- End Custom Css -->
	<script src="<?php echo HTTP_ROOT;?>js/front-developer.js" type="text/javascript"></script>
</head>

	<body class="login login-bg1" >
		 <?php echo $this->Flash->render(); ?>
		 <?= $this->fetch('content');?>
		 <div class="footer_text">Designed and Developed by Mobilyte Solutions</div>
	</body>

</html>
