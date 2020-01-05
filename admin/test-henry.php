<?php   
    require_once ("inc/main.php");
    error_reporting(1); 

	 $table = 'category_list' ;

	  if(isset($_POST['submit'])){
	$catName=$_POST['catName'];		
	$status=$_POST['status'];	
   $insert = array(
      'catName' => $catName,
      'status' => $status,
      );
  $results = $user->insertQuery($insert,$table);
    if($results)
    {  
       $sms="<p style='text-align:center;color:green;'>Category Added Successfully.</p>";
        header("refresh:2;url=manage-category.php");   
     
    }
    else
    {
        $sms="This Category Already Exist";
    }
	 }


    if(isset($_POST['update'])){
    $catId = $_GET['edit'] ;
    $catName=$_POST['catName'];   
    $status=$_POST['status']; 
     $insert = array(
      'catName' => $catName,
      'status' => $status,
      );
  $results = $user->updateQuery($insert,$table,$catId);
    
       $sms="<p style='text-align:center;color:green;'>Category Updated Successfully.</p>";
        header("refresh:2;url=manage-category.php");   
     
    
    
   }

   if(isset($_GET['edit'])){
    $catId = $_GET['edit'] ;
    $row = $user->getResultById($table, $catId); ;
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage Category</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	 <link href="plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	

  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include"inc/header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include"inc/side-bar.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Category
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Category</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box box-warning" style="width=200px">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Category</h3>
				  <?php if(isset($sms)){
					  echo $sms;
				  } ?>
                
                </div><!-- /.box-header -->
                <div class="box-body">
				
                   <form name="mgaform" id="mgaform" method="post" action="" enctype="multipart/form-data" >
         <input type="hidden" name="parentid" value="<?=$pid;?>">
          <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" name="catName" value="<?php echo (isset($_GET['edit']) ?$row['catName']:'')  ?>" class="form-control" placeholder="Category Name..." />
					  
                    </div>
				
									
					
					
					
					<div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select2">
                  <option <?php echo ((isset($_GET['edit']) &&($row['status'] == '1')) ?'selected':'')  ?> value="1">Active</option>
                  <option <?php echo ((isset($_GET['edit']) &&($row['status'] == '0')) ?'selected':'')  ?> value="0" >DeActive</option>
                     
                    </select>
                  </div>
				   <div style="margen-left:140px;">
            <?php if(isset($_GET['edit'])){ ?>
               <input type="submit" class="btn btn-success" name="update" id="submit" value="Update">
             <?php }else{ ?> 
               <input type="submit" class="btn btn-success" name="submit" id="submit" value="Save">
             <?php } ?>
         
          <input type="button" class="btn btn-info" value=" Cancel" onClick="window.location.href = 'manage-category.php'"> 
                                                         
                      </div>
        </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include"inc/footer.php"; ?>

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


    
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

	<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    <!-- page script -->


<script>
  $(function () {
    CKEDITOR.replace('description');
    CKEDITOR.replace('shortdescription');
  });
</script>

  </body>
</html>
