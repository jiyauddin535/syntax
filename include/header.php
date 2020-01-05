<?php 
if(!isset($_SESSION['userId'])){
header('Location: '.$base_url);
		}
?>
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
<header class="affix ">
  <div class="container padding-zero">
  	<div class="header">
  	  <nav class="navbar navbar-expand-lg padding-zero">
	  	<a class="navbar-brand text-uppercase" href="<?=$base_url ;?>my-note.php"><img src="images/logo.png"></a>
	  	<!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	  	
	    <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
	  	</button>-->
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav navbar-right">
        	<li><a href="<?=$base_url ;?>my-note.php" class="text-white">My Note</a></li>
        	<li><a href="" class="text-white" data-toggle="modal" data-target="#addNote">Add Note</a></li>
        	<li><a href="<?=$base_url ;?>trash.php" class="text-white">Trash</a></li>
        	<li></li>
        <!-- <div class="input-group">
	  	  	  	
			     
		      	  <input type="text" id="text-in-style" class="form-control border-white" aria-label="Text input with segmented button dropdown" placeholder="Search Note Here..">
		      	  <button type="button" class="button-search"><img src="images/search.png"></button>
		      	</div> -->
        
	      	
	      	<li>    
            <a href="<?=$base_url?>profile.php" class="text-white"><i class="fa1 fa fa-user" aria-hidden="true"></i> <?=$_SESSION['userName'] ;?></a>   
	       <!--<div class="dropdown dro1">
  <button class="dropbtn1"><i class="fa1 fa fa-user" aria-hidden="true"></i> <?=$_SESSION['userName'] ;?></button>
  <div class="dropdown-content1">
    <a href="<?=$base_url ?>logout.php">Sign Out</a>
  </div>
</div>-->
	      
	      </li>
<li><a href="<?=$base_url ?>logout.php" class="text-white">Sign Out</a></li>
          

	      		      	
	      </ul>
	  </nav>
      
  	</div>
  </div>
</header>




  <div class="modal" id="addNote">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Add Note</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">

      	<div class="px-4">
          <?php echo $sms ; ?>
          	
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
			  <button type="submit" name="create_note" class="btn user-submit1">Create</button>
			  </div>
			 
			</form>
          	</div>
          </div>

        </div>
        
        
        
      </div>
    </div>
  </div>
  
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

