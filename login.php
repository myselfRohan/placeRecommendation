<?php

session_start();

// If form submitted, insert values into the database.
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: site/dashboard.php");
} else{
?>      

<?php
    $title = "LOGIN";
    
    include 'template/indexheader.php';
?>
<body>
<div class="gtco-loader"></div>

	<div id="page">
		<?php include 'template/nav.php';?>
		<?php include 'template/headers/headerlogin.php';?>
<!--==============================Content=================================-->
<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row myform">
            <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                            		<p>Enter username and password to log in:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form method="POST" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="username">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                                        </div>
                                        <div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" id="login" value="Login">
													</div>
												</div>
				                        
                                        <div class="loginmsg" style="color:red;"></div>
				                    </form>
			                    </div>
		                    </div>
		                
		                	
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form id="signup_form" method="POST" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="username">Username</label>
                                            <input type="text" name="username" placeholder="Enter Username.." class="form-first-name form-control" id="username-new">
                                            <span style="color: red;" class="username_err invalid-feedback"></span>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="email">Email</label>
                                            <input type="email" name="email" placeholder="Enter Email.." class="form-last-name form-control" id="email-new">
                                            <span style="color: red;" class="email_err invalid-feedback"></span>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="password">Password</label>
				                        	<input type="password" name="password" placeholder="Pasword.." class="form-email form-control" id="password-new">
                                        </div>
                                        <div class="msg">&nbsp;</div>
				                        <div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" id="signup" value="Sign Up">
													</div>
												</div>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>    
            
			</div>
		</div>
	</div>
<!--==============================footer=================================-->
        <?php include 'template/footer.php'; ?>

        <script src="assets/js/login.js"></script>

       
    <?php }  ?>
    </body>
</html>
