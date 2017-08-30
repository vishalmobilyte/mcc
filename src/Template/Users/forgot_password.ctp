      <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b style="color: orange; font-size: 22px;">Chandigarh MC</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
       
         
        </div><!--/.nav-collapse -->
      </div>
    </nav>

      <div class="container-fluid">
	     
	  <div id="wrapper">

		
      <div class=" login">
	<!-- BEGIN LOGO -->
       
        <!-- END LOGO -->
	  <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN FORGOT PASSWORD FORM -->
          <?php 
					echo $this->Form->create(null, [
						'url' => ['controller' => 'Users', 'action' => 'forgotPassword'],
						'id'=>'formForgotPassword',
						'autocomplete' =>'off',
					]);
				?>
				<?php if(isset($error) && $error!=""){ ?>
					<div>
						<p class="admin_error"><?php echo $error; ?></p>
					</div>
				<?php } ?>
				<?php if(isset($success) && $success!=""){ ?>
					<div>
						<p class="admin_success"><?php echo $success; ?></p>
					</div>
				<?php } ?>
                <h3>Forgot password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
				<?php
						echo $this->Form->input('email', ['label' => false,'placeholder'=> 'Enter your email','class'=>'form-control']);
					?>
                   <!-- <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> -->
				</div>
                <div class="form-actions">
				<a title="Want to login back ?" class="btn green btn-outline reset_pass" href="<?php echo HTTP_ROOT."Users/login"; ?>">
                    Back
				</a>
                    <button type="submit" class="btn green pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
            
         </div>
	
	</div>
	
	</div>
	</div>
<script>
$(document).ready(function(){
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#formForgotPassword").submit();
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



label.error{
    color:red;
    font-size: 12px !important;
}

</style>
