<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">	
			<div class="navbar navbar-fixed-top navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo HTTP_ROOT; ?>"><img src="<?php echo HTTP_ROOT; ?>css/images/logo.png" alt="Home" /></a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav pull-right">							  
							<!--<li><a href="#"><i class="fa fa-home"></i> Home</a></li>-->
							<li class="active"><a href="<?php echo HTTP_ROOT; ?>"><i class="fa fa-map-marker"></i> Track Order</a></li>
							<?php if(empty($authUser['role'])){ ?>
							<li><a href="<?php echo HTTP_ROOT; ?>partner/login" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-unlock-alt"></i> Partner Login</a></li>
							<li><a href="<?php echo HTTP_ROOT; ?>customer/login" data-toggle="collapse" data-target=".navbar-collapse.in"><i class="fa fa-user"></i> Customer Login</a></li>
							<?php }else { ?>
							<li class="dropdown">
								<?php 
                              	if($authUser['role']==1){
									$userRole = "Administrator";
								}else if($authUser['role']==2){
									$userRole = "Sky2c staff";
								}else if($authUser['role']==3){
									$userRole = "Agent";
								}else if($authUser['role']==4){
									$userRole = "Driver";
								}else if($authUser['role']==5){
									$userRole = "Customer";
								}else{
								
								}
                              	?>	
								<a class="dropdown-toggle" data-toggle="dropdown"  data-target=".dropdown-menu" href="#"> <i class="fa fa-user"></i> <?php  echo ucfirst($authUser['name']) ;?> (<?=$userRole; ?>) <b class="caret"></b> </a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo HTTP_ROOT.'users/dashboard/'.base64_encode(convert_uuencode($authUser['id']));?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
									<li><a href="<?php echo HTTP_ROOT.'users/edit-profile/'.base64_encode(convert_uuencode($authUser['id']));?>"><i class="fa fa-pencil"></i> Edit Profile</a></li>
									<li><a href="<?php echo HTTP_ROOT.'users/change-password/dashboard/'.base64_encode(convert_uuencode($authUser['id']));?>"><i class="fa fa-key"></i> Change Password</a></li>
									<li><a href="<?php echo HTTP_ROOT.'users/logout';?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div><!--/.nav-collapse -->
			  </div>
			</div>
			
			
		</div>
	</div>
</div>
	
