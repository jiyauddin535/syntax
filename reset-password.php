<?php 
include('admin/include/User.php'); ?>
<?php 
$user = new User();
/* ********User Login********** */

$email = $_GET['email'] ;
$ehash = $_GET['ehash'] ;

$data = array('action' => 'check_email_user');
$data['data'] = array('email' => $email, 'ehash' => $ehash);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;
//print_r($result) ;
if($result->status == 1){
  $error = 1 ;
}else{
  $error = 1 ;
  $sms = '<div class="alert alert-danger alert-dismissible">Link has been expire. Please try again.</div>' ;
}


/* ***********Forgot Email********** */
if(isset($_POST['reset'])){
  //echo "ggg" ;
$password = $_POST['password'] ;
$userId = $result->userId ;

$data = array('action' => 'reset_password');
$data['data'] = array('userId' => $userId, 'password' =>$password);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;
//print_r($data) ;
//print_r($result) ;
if($result->status == '1'){  
   $sms = '<div class="alert alert-success alert-dismissible">'.$result->message.'</div>';
}else{
  $sms = '<div class="alert alert-danger alert-dismissible">'.$result->message.'</div>';
} 

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Syntax</title>
<?php include('include/common-css.php'); ?>
</head>
<body>

<?php include('include/header1.php'); ?>

<section class="login first">
<div class="container">
         <div class="row">
      	<div class="col-md-12">
      	<div class="user-action-sec col-lg-5 col-md-6 md-offset-3">
          <?=$sms ; ?>
            <?php if($error == 1 ){ ?>
          	<div class="login-sec">
          		<h3>Reset Password</h3>
          	</div>
          	<div class="user-form login-user">
          	  <form action="" method="post">
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
				      <input type="password" class="form-control" name="password"  id="password"  placeholder="Password">			    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
				      <input type="password" name="confirmpassword"  class="form-control" id="confirmpassword" placeholder="Confirm Password">			    
				  	</div>
          	      </div>
          	    </div>
          	   
          	    <div class="row">
          	      <div class="col-7">
          	      	
          	      </div>
          	     
          	    </div>
			  
			  <div class="login-tab form-group">
			  <button type="submit" name="reset" class="btn user-submit1">Submit</button>
			  </div>
			 
			</form>
          	</div>
          <?php } ?>
          </div>
          </div>
      </div>
      </div>
      </section>


<div class="modal fade" id="fpass" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          
          <h4 class="modal-title f20">Forgot Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body ">
          <form action="" method="POST" >
          
          <div class="form-group">
          <input type="text" class="form-control" name="email" id="femail" placeholder="Enter Email" required>
          </div>
          
          <div class="text-center">
          <button type="submit" name="forgot_password" class="btn btn-primary cursor px-5">Send</button>
			</div>
            <p>&nbsp;</p>
          </form>
        </div>

      </div>
      
    </div>
  </div>



  <?php include('include/common-js.php'); ?> 
  <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){            
                
               

                
                jQuery("#password").validate({
                    expression: "if (VAL.length > 3 && VAL) return true; else return false;",
                    message: "Please enter a valid password"
                });
              jQuery("#confirmpassword").validate({
                    expression: "if ((VAL == jQuery('#confirmpassword').val()) && VAL) return true; else return false;",
                    message: "Confirm password doesn't match"
                });
               
            });
            /* ]]> */
        </script>



</body>
</html>