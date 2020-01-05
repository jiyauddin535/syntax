<?php
    require_once ("inc/main.php"); 
    error_reporting(1);
	$side = "faq"; 
	$title = "Note Details" ;
	$pid = $_GET['edit'] ;

	if(isset($_GET['edit'])){
		$pid=$_GET['edit'];
		$fetchResult=$user->getResultById('note_data',$pid);
		$arr = count($fetchResult);

		$cat = $user->getResultById('category_list', $fetchResult['catId']);
		
	}
	

	if(isset($_POST['submit']) && isset($_GET['action'])=='add'){	 
		 
		  $insert = array(
	      'title' => $_POST['title'],
	      'description' => $_POST['description']	      
	      );
	  	  $ins_results = $user->insertQuery($insert,'note_data');
	  	  if ($ins_results) {
	  	  	?>
	  	  	<script type="text/javascript">alert("list added successfully.");window.location.href="note_list.php";</script>
	  	  	<?php
	  	  }
		}
	

	if(isset($_POST['update'])){
		$id=$_GET['edit'];
		  $update = array(
	      'title' => $_POST['title'],
	      'answer' => $_POST['answer'],  
	      );
	  	  $where = "id=".$id;
	 	  $query1 = $user->updateStatementwithAnd($update,'note_data',$where);
	  	  	?>
	  	  	<script type="text/javascript">alert("data has been updated successfully.");window.location.href="note_list.php";</script>
	  	  	<?php
	  	
	}
	
	
	include 'inc/head.php';
?>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include"inc/header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include"inc/side-bar.php";?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?=$title ;?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Note</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box box-warning" style="width=200px">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$title ;?>
                  </h3>
				  <?php if(isset($_SESSION['sms'])){
					  echo $_SESSION['sms'];
					  unset($_SESSION['sms']);
				  } ?>
                
		
                </div><!-- /.box-header -->
                <div class="box-body">
				
            <form name="mgaform" id="mgaform" method="post" action="" enctype="multipart/form-data" >
					<div class="col-xs-12">
					<div class="form-group">
						<label>Category </label>
						<input type="text" name="title" required id="title" class="form-control" 
						<?php if(isset($_GET['edit'])){ ?>
						 value="<?php echo $cat['catName']; ?>" 
						 <?php } ?> />
                    </div>
                    </div>

					<div class="col-xs-12">
					<div class="form-group">
						<label>Tittle </label>
						<input type="text" name="title" required id="title" class="form-control" 
						<?php if(isset($_GET['edit'])){ ?>
						 value="<?php echo $fetchResult['title']; ?>" 
						 <?php } ?> />
                    </div>
                    </div>

                    <div class="col-xs-12">
					<div class="form-group">
						<label>Description</label>
						<textarea name="description" required id="description"  class="form-control" ><?php if(isset($_GET['edit'])){?> <?php echo $fetchResult['description']; ?> <?php } ?>
						</textarea>
                    </div>
                    </div>

                    <div class="col-xs-12">
					<div class="form-group">
						<label>Status</label>
						<input type="text" name="status" required id="status" class="form-control" 
						<?php if(isset($_GET['edit'])){ ?>
						 value="<?php echo (($fetchResult['status'] ==1)?'Active':'Trash'); ?>" 
						 <?php } ?> />
                    </div>
                    </div>

                    	<?php /* ?>
				    <div style="margen-left:140px;">
				    	<?php if(isset($_GET['edit'])){ ?>
				    		<input type="submit" class="btn btn-success" name="update" id="submit" value="Update"> 
				    	<?php }else{ ?>
				    	<input type="submit" class="btn btn-success" name="submit" id="submit" value="Add"> 

				    	<?php } ?>
                      
                                                         
                    </div> <?php */?>
					
					
        </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include"inc/footer.php"; ?>
    <!-- page script -->
<style>
	.required{
		color:red;
	}
</style>
	
	<script>
	function validateFileExtension1(fld) {
			if(!/(\.PNG|\.JPG|\.JPEG|\.BMP)$/i.test(fld.value)) {
				alert("Invalid Image file type.");
				$("#photo_file").val("");
				fld.focus();        
				return false;   
			}   
			return true; 
		}
		$(document).ready(function(){

		});
	</script>
  </body>
</html>
