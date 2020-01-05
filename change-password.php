<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
$noteId = $_GET['id'] ;
$url = $base_url."api/api.php";
/* *******Create Note******** */
if(isset($_POST['update'])){
$password = $_POST['password'] ;

$data = array('action' => 'reset_password');
$data['data'] = array('userId' => $userId, 'password' => $password);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;
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

<?php include('include/header.php'); ?>
<section class="login first">
<div class="container">
         <div class="row">
      	<div class="col-md-12">
         <p>&nbsp;</p>
        
        <div class="row">    
        <?php include('include/profile-left.php'); ?>
      	<div class=" col-lg-7 col-md-7">
      
          <?php echo $sms ; ?>
          	
          	<div class="user-form login-user">
          	  <form action="" method="post">
             <div class="login-sec">
          		<h3>Change Password</h3>
                <p>&nbsp;</p>
          	</div>
                <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Password</label>
				      <input type="password" name="password" id="password" class="form-control"  >			    
				  	</div>
          	      </div>
          	    </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                    <label>Confirm Password</label>
              <input type="password" name="cpassword" id="cpassword" class="form-control"   >         
            </div>
                  </div>
                </div>
          	    
          	   
          	    <div class="row">
          	      <div class="col-3"> 
                  <div class="login-tab">
			  <button type="submit" name="update" class="btn user-submit1">Update</button>
			  </div>
                  </div>
                  
                  </div>
			  
			 
			 
			</form>
          	</div>
           
          </div>
          </div>
          </div>
      </div>
      </div>
      </section>






  <?php include('include/common-js.php'); ?> 
  <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){ 
           jQuery("#password").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid Password"
                });
                jQuery("#cpassword").validate({
                    expression: "if ((VAL == jQuery('#cpassword').val()) && VAL) return true; else return false;",
                    message: "Confirm password doesn't match"
                });
               
            });
            /* ]]> */
        </script>


<style>
.profile-left ul li:last-child{background:#00a5e4;}
.profile-left ul li:last-child a{color:#fff;}
</style>

</body>
</html>