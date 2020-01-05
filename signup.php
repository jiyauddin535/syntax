<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();

if(isset($_POST['register'])){
$phone = $_POST['phone'] ;
$name = $_POST['name'] ;
$email = $_POST['email'] ;
$password = $_POST['password'] ;

$data = array('action' => 'register');
$data['data'] = array('phone' => $phone,'name' => $name,'email' => $email, 'password' => $password);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;

if($result->status == '1'){
   $_SESSION['userId'] = $result->data->userId ;
   $_SESSION['userName'] = $result->data->name ;
  header('Location: my-note.php');
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
          	<div class="login-sec">
          		<h3>Sign up and get to work</h3>
          	</div>
          	<div class="user-form login-user">
          	  <form action="" method="post">
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
				      <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Your Name">			    
				  	</div>
          	      </div>
                  <div class="col-12">
          	      	<div class="form-group">
				      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email Id">			    
				  	</div>
          	      </div>
                  
                  <div class="col-12">
          	      	<div class="form-group">
				      <input type="text" name="phone" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Phone no">			    
				  	</div>
          	      </div>
                  
                  <div class="col-12">
          	      	<div class="form-group">
				      <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Password">			    
				  	</div>
          	      </div>
          	    </div>
          	    
          	   
          	    
			  
			  <div class="login-tab form-group">
			  <button type="submit" class="btn user-submit1" name="register">Signup</button>
			  </div>
			 <div class="cotse-style text-center">
			 	<h2>Already Register? <span class="sign-style1"><a href="index.php"> Login </a></span></h2>
			 </div>
			</form>
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
        
                jQuery("#name").validate({
                    expression: "if (VAL.match(/^[a-zA-Z]*$/) && VAL && VAL.length > 5) return true; else return false;",
                    message: "Please enter the name"
                });
               
                jQuery("#lname").validate({
                    expression: "if (VAL.match(/^[a-zA-Z]*$/) && VAL && VAL.length > 3) return true; else return false;",
                    message: "Please enter the Name"
                });
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid email id"
                });

                jQuery("#phone").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid mobile number"
                });
                jQuery("#password").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid password"
                });
              
               
            });
            /* ]]> */
        </script>


</body>
</html>