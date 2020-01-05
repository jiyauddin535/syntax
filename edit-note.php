<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
$noteId = $_GET['id'] ;
$url = $base_url."api/api.php";
/* *******Create Note******** */
if(isset($_POST['edit_note'])){
$title = $_POST['title'] ;
$desc = $_POST['desc'] ;
$catId = $_POST['catId'] ;

$data = array('action' => 'edit_note');
$data['data'] = array('userId' => $userId, 'noteId' => $noteId, 'title' => $title, 'description' => $desc, 'catId' => $catId);
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
$dataNote = array('action' => 'note_details');
$dataNote['data'] = array('noteId' => $noteId);
$url = $base_url."api/api.php";
$viewNote = $user->curlPost($url, $dataNote) ;
$viewNote = $viewNote->data ;

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
<meta property="og:url" content="http://syntaxnote.com/edit-note.php?id=<?=$noteId ; ?>">
 <meta property="og:title" content="<?=$viewNote->title ;?>">
<meta property="og:description" content="<?=$viewNote->description ;?>"> 
<meta property="og:type" content="article" />
<!-- <meta property="og:image" content="http://example.com/image.jpg" /> -->


<?php include('include/common-css.php'); ?>
</head>
<body>

<?php include('include/header.php'); ?>
<section class="login first">
<div class="container">
         <div class="row">
      	<div class="col-md-12">
      	<div class="user-action-sec col-lg-5 col-md-6 md-offset-3 edit-note">
          <?php echo $sms ; ?>
          	<div class="login-sec">
          		<h3>Update Note</h3>
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
                       <option <?php echo ($category->id==$viewNote->catId?'selected':'' ) ;?> value="<?=$category->id ; ?>" ><?=$category->catName ; ?></option>
                     <?php } ?>
                      
                      </select>		    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Title</label>
				      <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" value="<?=$viewNote->title ;?>">			    
				  	</div>
          	      </div>
          	    </div>
          	    <div class="row">
          	      <div class="col-12">
          	      	<div class="form-group">
                    <label>Note</label>
				      <textarea class="form-control" name="desc" id="desc" placeholder="Note"><?=$viewNote->description ;?></textarea>		    
				  	</div>
          	      </div>
          	    </div>
          	   
          	    <div class="row">
          	      <div class="col-3"> 
                  <div class="login-tab">
			  <button type="submit" name="edit_note" class="btn user-submit1">Update</button>
			  </div>
                  </div>
                  <div class="col-9">
                   <?php
              $title = urlencode($viewNote->title) ;
              $description = $viewNote->description ;
             $url=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
             $image = '';
             $url1=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
            
             ?>
            <div class="soshare">
             <ul id="blshare">        

<!-- <li><a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php //echo $title;?>&amp;p[url]=<?php //echo $url; ?>&amp;&p[description][0]=<?php //echo $description;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><i class="fa fa-facebook"></i></a></li> -->

<!-- <li><a onClick="window.open('https://plus.google.com/share?url=<?php //echo $url; ?>&amp;p[title]=<?php //echo $title;?>&amp;p[url]=<?php //echo $url1 ?>&amp;&p[description][0]=<?php //echo urlencode($description) ;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)"><i class="fa fa-google-plus"></i></a></li> -->

<li><a target="blank" onclick="engagedData('other');" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;su=<?=urlencode($viewNote->title); ?>%20|%20My%20SyntaxNote%20&amp;body=Hello%20Dear,%0D%0A%0D%0A%20%20<?=urlencode($viewNote->description) ;?>%0D%0A%0D%0A<?php echo $url_gm ; ?>" target="_top"><i class="fa fa-envelope"></i></a></li>
<!-- <li><a href="https://web.whatsapp.com/send?text=<?php //echo $title.' %0A'.$description;?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a></li> -->


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
      </section>






  <?php include('include/common-js.php'); ?> 

</body>
</html>