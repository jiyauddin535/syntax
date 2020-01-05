<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
$noteId = $_GET['id'] ;
$url = $base_url."api/api.php";
/* *******Create Note******** */
if(isset($_POST['update_profile'])){
$name = $_POST['name'] ;
$mobile = $_POST['mobile'] ;

$data = array('action' => 'update_profile');
$data['data'] = array('userId' => $userId, 'name' => $name, 'mobile' => $mobile);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;
//print_r($result);
if($result->status == '1'){
  $sms = '<div class="alert alert-success alert-dismissible">'.$result->message.'</div>';
}else{
  $sms = '<div class="alert alert-danger alert-dismissible">'.$result->message.'</div>';
} 

}


/* *****View Note********* */
$dataProfile = array('action' => 'get_profile');
$dataProfile['data'] = array('userId' => $userId);
$url = $base_url."api/api.php";
$viewProfile = $user->curlPost($url, $dataProfile) ;
$viewProfile = $viewProfile->data ;

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
          		<h3>My Profile</h3>
                <p>&nbsp;</p>
          	</div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Name</label>
				      <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="<?=$viewProfile->name ;?>">			    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Email</label>
				        <input type="text" readonly="readonly" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$viewProfile->email ;?>">		    
				  	</div>
          	      </div>
          	    </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                    <label>Phone No.</label>
                <input type="text" name="mobile" class="form-control" id="mobile" aria-describedby="emailHelp" value="<?=$viewProfile->mobile ;?>">       
            </div>
                  </div>
                </div>

                
          	   
          	    <div class="row">
          	      <div class="col-3"> 
                  <div class="login-tab">
			  <button type="submit" name="update_profile" class="btn user-submit1">Update</button>
			  </div>
                  </div>
                  <div class="col-9">
                  
            <div class="soshare">
             <ul id="profile">        

<!-- <li><a href="<?=$base_url?>edit-profile.php">Edit Profile </a> |</li> -->







</ul>

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
        
                jQuery("#name").validate({
                    expression: "if (VAL.match(/^[a-zA-Z]*$/) && VAL && VAL.length > 5) return true; else return false;",
                    message: "Please enter the name"
                });
               
               
                

                jQuery("#mobile").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Please enter a valid mobile number"
                });
                
              
               
            });
            /* ]]> */
        </script>

<style>
.profile-left ul li:first-child{background:#00a5e4;}
.profile-left ul li:first-child a{color:#fff;}
</style>


</body>
</html>