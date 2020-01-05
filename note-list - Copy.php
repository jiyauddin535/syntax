<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;
/* *********Note List******** */

$data = array('action' => 'notes_by_category');
$data['data'] = array('userId' => $userId);
$url = $base_url."api/api.php";
$noteResult = $user->curlPost($url, $data) ;
print_r($noteResult) ;
$noteList = $noteResult->data ; 
$contTnote = count($noteList) ;

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
      	
      	<div class=" col-md-12">
          	<div class="login-sec">
            <p>&nbsp;</p>
          		<h3>Note List</h3>
          	</div>
          	<div class="user-form login-user">
              <?php if($contTnote > 0){ ?>            

          	  <table class="table table-bordered">
    <thead>
      <tr>
      <th width="5%">SN.</th>
        <th width="20%">Title</th>
        <th>Note</th>
        <th>Category Name</th>
        <th align="right" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1 ;
      foreach ($noteList as $note) { ?>
        
     
      <tr>
      <td><?=$no++ ;?></td>
        <td><?=$note->title ;?></td>
        <td><?=$note->desc ;?></td>
        <td><?=$note->catName ;?></td>
        <td align="right"><button class="btn btn-sm btn-danger">Delete</button><a class="share-btn"><i class="fa fa-facebook"></i></a><a class="share-btn"><i class="fa fa-google-plus"></i></a><a class="share-btn"><i class="fa fa-whatsapp"></i></a></td>
        
      </tr>
      <?php  } ?>
     

    </tbody>
  </table>
<?php  }else{ ?>
<div class="noResult"> Note List Empty </div>

<?php } ?>
          	</div>
          </div>
      </div>
      </div>
      </section>






  <?php include('include/common-js.php'); ?> 
  <style>
  .share-btn{    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
    background: #555;
    color: #fff;
    margin: 0 0px 0 5px;
    line-height: 30px;
    vertical-align: middle;
    text-align: center;}
	.share-btn i{color:#fff;}
  </style>

</body>
</html>