<?php
	
    require 'include/User.php';
    $user = new User();

	if ($user->get_session() && isset($_SESSION['admin_id']))
	{
		header("location:dashboard.php");
	}
	
	/*$_SESSION['login'] = true;  
				$_SESSION['admin_id'] = 1;
				$_SESSION['name'] = 'jiyauddin';*/
/* check Admin Login */
if(isset($_POST['login'])){
	extract($_POST);  
	$adminlogin = new AdminUser();
	$login = $adminlogin->check_login($email, $password);
	if ($login) {
		/*  Login Success */

		header("LOCATION:dashboard.php");
		die;
	}else{
		$_SESSION['LOG_ERROR'] = true;
		header("LOCATION:index.php?log_type=login&mess=error");
		die;
	}
}

	$miscfunc = new miscfunc();
	/* admin reset password email sent */

	if(isset($_POST['forget_pass'])) {
		extract($_POST); 
		$table = "admin";
	    $reset = $miscfunc->resetPassword($email,$table);
		if($reset){
	        /* reset Success */
			
			$_SESSION['popup'] = true;
			$_SESSION['status'] = "success";
			header("LOCATION:index.php");
			die;
	    }else{
			$_SESSION['popup'] = true;
			$_SESSION['status'] = "error";
			header("LOCATION:index.php");
			die;
	        /*  reset Failed */
			
	    }
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
<script src="//code.jquery.com/jquery-1.9.1.js"></script>

  


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><a href="# "  target="_blank"  class="logo">Admin Dashboard<!-- <img src="images/admin_profile.png"  class=img-responsive/ width="150px" height="auto"> --></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form id="frm123" class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><div  class="input-group"> <?php 

		if(@$_SESSION['LOG_ERROR']){

			echo '<span style="color:red;font-size:15px;font-weight:500;">Wrong email or Password</span>';

			unset($_SESSION['LOG_ERROR']);

		}

	?> </div>
          <div class="form-group has-feedback">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Id" />
			<span id="error_email" class="text-danger"></span>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
			<span id="error_password" class="text-danger"></span>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!---<div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>-- /.col -->
            <div class="col-xs-4">
              <input type="submit" id="submit_login" name="login" value="Sign In" class="btn btn-primary btn-block btn-flat"/>
            </div><!-- /.col -->
			<!-- <div class="col-xs-8">
              <a href="" data-toggle="modal" data-target=".bs-example-modal-sm">Forgot Password</a>
            </div> -->
          </div>
		  
        </form>

        <!-- /.social-auth-links -->

      <!---  <a href="#">I forgot my password</a><br> --->
       

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<!-- forget Popup Start -->

<div class="modal fade bs-example-modal-sm" id="forgetpassword"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>

      </div>

      <div class="modal-body">

        <form action=""  id="forget_pass" method="post">

		<?php if($_SESSION['status']=="success"){?>

						<h4 class="text-center text-success">Email sent to Reset Your Password</h4>

					<?php }?>

					<?php if($_SESSION['status']=="error"){?>

						<h4 class="text-center text-danger">Email does not Exits!</h4>

					<?php }?>

      		<div class="form-group has-feedback">

        		<input type="email" class="form-control" name="email" placeholder="Email" id="f_email">
				<span id="error_f_email" class="text-danger"></span>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      		</div>

      		<div class="row">

        		<div class="col-xs-12">

          			<button type="submit" id="forget_submit" name="forget_pass" class="btn btn-primary btn-block btn-flat">Submit</button>

        		</div>

        		<!-- /.col -->

      		</div>

    	</form>

      </div>

    </div>

  </div>

</div>

<!-- forget Popup End -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $('#submit_login').click(function() {
		
			var formdata = $('#frm123').serialize();
			var email = $('#email').val();
			var password = $('#password').val();

			var error = 0;

			if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) || email.length < 6){
				error = 1;
				$('#error_email').html('Error: Please Enter valid Email');
			}
			else {
				$('#error_email').html('');
			} 
			
			if (password.length < 5) {
				error = 1;
				$('#error_password').html('Please Enter min 5 digit Password');
			}
			else {
				$('#error_password').html('');
			}
			
			if (error == 0) {
				return true;
			}
			else 
			{
				return false;
			}
		});
	  $('#forget_submit').click(function() {
		
			var formdata = $('#forget_pass').serialize();
			var f_email = $('#f_email').val();

			var error = 0;

			if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(f_email) || f_email.length < 6){
				error = 1;
				$('#error_f_email').html('Error: Please Enter valid Email');
			}
			else {
				$('#error_f_email').html('');
			} 
			
			if (error == 0) {
				return true;
			}
			else 
			{
				return false;
			}
		});
    </script>
<?php	if(isset($_SESSION['popup'])){?>
			<script type="text/javascript">
				$(document).ready(function () {
					$('#forgetpassword').modal('show');
				});
			</script>
<?php
		unset($_SESSION['popup']);
		unset($_SESSION['status']);
	}
?>
 <style>
     .login-logo .logo img{
         display: block;
         margin: auto;
     }      
        
        
        
        </style>       
        
        
        
  </body>
</html>
