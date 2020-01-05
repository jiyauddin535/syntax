<?php 
include('admin/include/User.php'); ?>
<?php 
$user = new User();
/* ********User Login********** */
if(isset($_POST['login'])){
$email = $_POST['email'] ;
$password = $_POST['password'] ;

$data = array('action' => 'login');
$data['data'] = array('email' => $email, 'password' => $password);
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

/* ***********Forgot Email********** */
if(isset($_POST['forgot_password'])){
$email = $_POST['email'] ;
$data = array('action' => 'forgot_password');
$data['data'] = array('email' => $email);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;

if($result->status == '1'){
   $_SESSION['userId'] = $result->data->userId ;
   $_SESSION['userName'] = $result->data->name ;
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
<title>Syntax Apps</title>
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
          		<h3>Log in and get to work</h3>
          	</div>
          	<div class="user-form login-user">
          	  <form action="" method="post">
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
				      <input type="email" class="form-control" name="email"  id="email" aria-describedby="emailHelp" placeholder="Email">			    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
				      <input type="password" name="password"  class="form-control" id="password" aria-describedby="emailHelp" placeholder="Password">			    
				  	</div>
          	      </div>
          	    </div>
          	   
          	    <div class="row">
          	      <div class="col-7">
          	      	
				     <div class="checkbox check-style">
      <label><input type="checkbox" value="">Remember me next time</label>
    </div>	

				  
          	      </div>
          	      <div class="col-5 pass2 text-right">
          	      	<a href="#" data-toggle="modal" data-target="#fpass">Forget password?</a>
          	      </div>
          	    </div>
			  <div class="row">
        <div class="col-3">
			  <div class="login-tab form-group">
			  <button type="submit" name="login" class="btn user-submit1">Login</button>
			  </div>
      </div>

        <div class="col-9">
           <div class="soshare login-tab form-group">
             <ul id="blshare">       

<!-- <li><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=&amp;p[url]=&amp;&p[description][0]=', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><i class="fa fa-facebook"></i></a></li> -->

<li><a onClick="window.open('https://www.syntaxnote.com/glogin/google_login.php');"  href="javascript: void(0)"><i class="fa fa-google-plus"></i></a></li>




</ul>

            </div>
                  </div>
                </div>
			 <div class="cotse-style text-center">
			 	<h2>NEW TO SYNTAX? <span class="sign-style1"><a href="signup.php"> SIGNUP </a></span></h2>
			 </div>
			</form>
          	</div>
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
                
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid email id"
                });

                 jQuery("#femail").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Please enter a valid email id"
                });

                
                jQuery("#password").validate({
                    expression: "if (VAL.length > 3 && VAL) return true; else return false;",
                    message: "Please enter a valid password"
                });
              
               
            });
            /* ]]> */
        </script>



</body>
</html>