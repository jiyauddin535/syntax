<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
$url = $base_url."api/api.php";
/* *******Create Note******** */
if(isset($_POST['create_note'])){
$title = $_POST['title'] ;
$desc = $_POST['desc'] ;
$catId = $_POST['catId'] ;

$data = array('action' => 'create_note');
$data['data'] = array('userId' => $userId, 'title' => $title, 'desc' => $desc, 'catId' => $catId);
$url = $base_url."api/api.php";
$result = $user->curlPost($url, $data) ;
//print_r($result);
if($result->status == '1'){
  $sms = '<div class="alert alert-success alert-dismissible">'.$result->message.'</div>';
}else{
  $sms = '<div class="alert alert-danger alert-dismissible">'.$result->message.'</div>';
} 

}
/* *****Category List********* */

$dataCat = array('action' => 'category_list');
$dataCat['data'] = array('userId' => $userId);
$url = $base_url."api/api.php";
$categoryResult = $user->curlPost($url, $dataCat) ;
$categoryResult = $categoryResult->data ;
//print_r($categoryResult) ;
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
      	<div class="user-action-sec col-lg-5 col-md-6 md-offset-3">
          <?php echo $sms ; ?>
          	<div class="login-sec">
          		<h3>Add Note</h3>
          	</div>
          	<div class="user-form login-user">
          	  <form action="" method="post">
              <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Category</label>
				              <select class="form-control" name="catId" id="catId">
                      <option value="" selected disabled>-- Select Category--</option>
                       <?php foreach ($categoryResult as $category) { ?>
                       <option value="<?=$category->id ; ?>" ><?=$category->catName ; ?></option>
                     <?php } ?>
                      </select>		    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Title</label>
				      <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">			    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Note</label>
				      <textarea class="form-control" name="desc" id="desc" aria-describedby="emailHelp" placeholder="Note">	</textarea>		    
				  	</div>
          	      </div>
          	    </div>
          	   
          	    
			  
			  <div class="login-tab">
			  <button type="submit" name="create_note" class="btn user-submit1">Done</button>
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
              jQuery("#catId").validate({
                    expression: "if (VAL != '') return true; else return false;",
                    message: "Please select a category"
                });        
                jQuery("#title").validate({
                    expression: "if (VAL.length > 5) return true; else return false;",
                    message: "Please enter the title"
                });

                jQuery("#desc").validate({
                    expression: "if (VAL.length > 1) return true; else return false;",
                    message: "Please enter description"
                });
               
                
              
               
            });
            /* ]]> */
        </script>

  

</body>
</html>