
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
    </nav><div class=" container-fluid">
   <div class="lgo">
     <!--   <a href="<?php echo HTTP_ROOT;?>">
           <img src="<?php echo HTTP_ROOT;?>assets/images/logo.sky2c.png" width="210" alt=""/>
       </a>  -->
    </div>
    
    <div id="wrapper">
        <div class=" login">
		<?php 
		  if(isset($userCookie) && !empty($userCookie)){
				  $loginId =  $userCookie['loginId'];
				  $password =  $userCookie['password'];
				  $remember =  "checked";
				  $userRole =  $userCookie['userRole'];

		  }else{
				  $loginId = "";
				  $password = "";
				  $remember = "";
				  $userRole = "";
		  }


		?>
                <!-- BEGIN LOGO -->
                <!-- END LOGO -->
                <!-- BEGIN LOGIN -->
                <div class="content">
                <!-- BEGIN LOGIN FORM -->
                    <?php 
                    echo $this->Form->create(null, [
                        'url' => ['controller' => 'Users', 'action' => 'login'],
                        'id'=>'formLoginUser',
                        'autocomplete'=>'off',
                        'class' =>'login-form',
                        'autocomplete' =>'off',
                    ]);
                    ?>
                   
                     <h3 class="form-title">Log in</h3>
                   
					<?php if(isset($login_error) && $login_error !=''){ ?>
						<div class="alert alert-danger loginError">
							<span> <?= @$login_error; ?> </span>
						</div> 
                    <?php } ?>
                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <div id="usernameDiv" class="input-icon">
                            <i class="fa fa-user"></i>
                            <?php echo $this->Form->password('username', [
                                'label' => false,
                                'id'=>'username',
                                'type' => 'text',
                                'placeholder'=>'Enter username or email',
                                'class'=>'form-control placeholder-no-fix',
                                'autocomplete'=>'off',
                                'value' => @$loginId
                                ]);  ?> 
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <div id="passwordDiv" class="input-icon">
                            <i class="fa fa-lock"></i>
                            <?php echo $this->Form->password('password', [
                                'label' => false,
                                'id'=>'password',
                                'placeholder'=>'Enter Password',
                                'class'=>'form-control placeholder-no-fix',
                                'autocomplete'=>'off',
                                'value' => @$password
                                ]);  ?> 
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input <?= $remember ?> id="rememberme" type="checkbox" name="remember" value="1" /> Remember me
                            <span></span>
                        </label>
                        <input type="submit" id="btn-login"  name="btn-login" class="btn green pull-right" value='Log in'>
                    </div>
                    <!--
                    <div class="login-options">
                        <h4>Or login with</h4>
                        <ul class="social-icons">
                            <li>
                                <a class="facebook" data-original-title="facebook" href="javascript:;"> </a>
                            </li>
                            <li>
                                <a class="twitter" data-original-title="Twitter" href="javascript:;"> </a>
                            </li>
                            <li>
                                <a class="googleplus" data-original-title="Goole Plus" href="javascript:;"> </a>
                            </li>
                            <li>
                                <a class="linkedin" data-original-title="Linkedin" href="javascript:;"> </a>
                            </li>
                        </ul>
                    </div>
                    -->
                     <div class="forget-password">
                        <h4>Forgot password ?</h4>
                        <p> No worries, click
                            <a href="<?php echo HTTP_ROOT."Users/forgot-password"; ?>" id="forget-password"> here </a> to reset your password. </p>
                    </div> 
                    <!--<div class="create-account">
                        <p> Don't have an account yet ?&nbsp;
                            <a href="javascript:;" id="register-btn"> Create an account </a>
                        </p>
                    </div>-->
                 </form>
            <!-- END LOGIN FORM -->
            



        </div>

        <div class="container">
 <div class="well" style="background: rgb(238, 238, 238, .9) !important; margin-top: 30px;">

        <div class="row">

       
            <div class="col-xs-12 col-sm-12"><h1 class="text-center" style=" margin-top: 0px;"  ><b>
DOWNLOAD ANDROID APP</b>
</h1><b />
 <a target="_blank" href="https://play.google.com/store/apps/details?id=anganwadi.haryana.samcalculator&hl=en">
           <img class="img-responsive text-center center-block" src="<?php echo HTTP_ROOT;?>assets/images/google-button.png" width="210" alt=""/>
       </a> <b />

</div>



</div>


        </div>


</div>
    </div>
        <!-- END LOGIN -->
</div>       
       
<script>
$(document).ready(function(){
    $("input").keypress(function(event) {
        if (event.which == 13) {
          $("#formLoginUser").submit();
        }
    });
    <?php
    
    if($remember  == "checked"){ ?>
              $("#formLoginUser").submit();
    <?php } ?>
});
</script>
<style>
label.error{
    color:red;
    font-size: 12px !important;
}
</style>
