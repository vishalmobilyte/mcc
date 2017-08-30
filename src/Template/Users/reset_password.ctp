
	<?php if(!isset($resetError['re_password']) && !empty($resetError['re_password'])){ ?>
		<div onclick="this.classList.add('hidden');" class="message flasherror">The application could not be saved. Please try again.</div>
    <?php } ?>
	 
	 
	<div class="container-fluid">
		<div class="lgo">
			<a href="<?php echo HTTP_ROOT;?>">
				<img src="<?php echo HTTP_ROOT;?>assets/images/logo.sky2c.png" width="210" alt=""/>
			</a>
		</div>
		<div id="wrapper">
			<div class=" login">
				<!-- BEGIN LOGIN -->
				<div class="content">
					<!-- BEGIN LOGIN FORM -->
						<?php 
							echo $this->Form->create(null, [
								//'url' => ['controller' => 'Users', 'action' => 'reset-password'],
								'id'=>'formResetPassword',
								'autocomplete' =>'off',
							]);
							echo $this->Form->input('Users.email',[               
								'label' => false,
								'type' => 'hidden',
								'value' => $email
								//'value'=>(@$_POST['data']['Users']['email'] ? $_POST['data']['Users']['email'] : (@$signupdata['Users']['email'] ? $signupdata['Users']['email'] : ''))
							  ]);
							echo $this->Form->input('Users.key',[               
								'label' => false,
								'type' => 'hidden',
								'value' => $key
								//'value'=>(@$_POST['data']['Users']['key'] ? $_POST['data']['Users']['key'] : (@$signupdata['Users']['key'] ? $signupdata['Users']['key'] : ''))
							  ]);
						?>
							
						<h3 class="form-title">Reset password</h3>
						<!--  <p> Enter your new password: </p> -->
						 <!--<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<span> Enter any username and password. </span>
						</div>-->
						<?php  //pr($loginerror); ?>
						<div class="form-group">
							<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
							<label class="control-label visible-ie8 visible-ie9">New password</label>
							<?php echo $this->Form->input('Users.password', ['label' => false,'class'=>'form-control','id'=>'reset_pwd_field','placeholder'=> 'Enter your password']); ?>
							<!-- <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" />-->
						</div>
						<div class="form-group">
							<label class="control-label visible-ie8 visible-ie9">Confirm password</label>
							<?php echo $this->Form->password('Users.re_password', ['label' => false,'id'=>'re_password','class'=>'form-control','placeholder'=> 'Re-enter your password']);	?>
							<!-- <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> -->
						</div>
						<div class="form-actions">
							<button type="submit" id="submit"  name="submit" class="btn btn-success green right uppercase">Reset</button>
							<!--<a href="<?php echo HTTP_ROOT."Users/forgot-password"; ?>" id="forget-password" class="forget-password">Forgot Password?</a>-->
						</div>
					<!-- END LOGIN FORM -->
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(){
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#formResetPassword").submit();
		}
	});
});

</script>
<style>
.login_content h1::before, .login_content h1::after {
    width: 15%;
}
.admin_error{color:#C12529}
#register, #login {
    background: #f7f7f7 none repeat scroll 0 0;
    border-radius: 5px;
    padding: 10px;
    position: absolute;
    top: 0;
    border:4px solid #d3d3d3;
}
body {
    color: #73879C;
	background: #f7f7f7 none repeat scroll 0 0;
}
label {
    float: left;
    margin: 0 0 3px 3px;
}
#username,#password{
	float:left;
}
a#submit {
    float: left;
}
.login .btn.pull-right{
	float:right !important; margin-right:0 !important; margin-left:10px !important;
}


div.message {
  display: inline-block;
}
div.success {
	background: #4f9709 none repeat scroll 0 0;
    border-radius: 5px;
    top: 10px !important;
    color: #fff !important;
    cursor: pointer !important;
    float: right !important;
    height: 30px;
    opacity: 0.9 !important;
    padding: 5px 15px;
    position: fixed !important;
    right: 7px;
    text-align: center !important;
    z-index: 9999 !important;
    content: none !important;
}

div.flasherror {
	background: red none repeat scroll 0 0;
    border-radius: 5px;
    top: 10px !important;
    color: #fff !important;
    cursor: pointer !important;
    float: right !important;
    height: 30px;
    opacity: 0.9 !important;
    padding: 5px 15px;
    position: fixed !important;
    right: 7px;
    text-align: center !important;
    z-index: 9999 !important;
    content: none !important;
}

label.error{
    color:red;
    font-size: 12px !important;
}

</style>
