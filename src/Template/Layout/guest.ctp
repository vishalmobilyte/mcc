<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=2.0 user-scalable=yes" />
	<title><?php echo SITE_TITLE;?></title>
	<link href="<?php echo HTTP_ROOT;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HTTP_ROOT;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT; ?>css/Front/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT; ?>css/Front/dev.css" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet" /> 
	
	<!--script type="text/javascript" src="js/jquery.js"></script-->
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo HTTP_ROOT; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo HTTP_ROOT;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	
	<!--[if lt IE 9]><script src="/sites/mhrd.gov.in/themes/nexus/js/html5.js"></script><![endif]-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

	
<body>
	<header id="masthead">
		<!-- BEGIN Header -->
		<?php echo $this->element('frontElements/header'); ?>
		 <?php echo $this->element('frontElements/pace'); ?>
		<!-- END Header -->
	</header>
	<!-- BEGIN Content INCLUDE -->
		<?php echo $this->fetch('content');?>
	<!-- END Content INCLUDE -->
	<footer class="footer">
		<!-- BEGIN Header -->
		<?php echo $this->element('frontElements/footer'); ?>
		<!-- END Header -->
    </footer>
<script>
	$(function(){
		$(".reset").click(function() {
			$(this).closest('form').find("input[type=text]").val("");
			return false;
		});
		
		$('#orderTracking').validate({
			messages: {
				descartes_id: {
					required: 'This field is required'
				}
			},
			rules: {
				descartes_id: {
					required: true
				}
			}
		});
	});
	
	function ScrollToTop(el, callback) { 
		$('html, body').animate({ scrollTop: $(el).offset().top - 50 }, 'slow', callback);
	} 

</script>
</body>

</html>
