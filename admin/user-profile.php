<?php
    require_once ("inc/main.php"); 
    error_reporting(1);
  $side = "user"; 
  $table = "user_data"; 
  $title = "User Details" ;
  $pid = $_GET['edit'] ;

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
        'email' => $_POST['email'],
        'password' => base64_encode($_POST['password']),  
        'name' => $_POST['name'],  
        'mobile' => $_POST['mobile'],  
        'ehash' => $_POST['ehash'],  
        'status' => $_POST['status'],  
        );
        $where = "id=".$id;
      $query1 = $user->updateStatementwithAnd($update,$table, $where);

      $_SESSION['sms'] = $sms="<p style='text-align:center;color:green;'>Record Updated Successfully.</p>";
          ?>
          <!-- <script type="text/javascript">alert("Data has been updated successfully.");window.location.href="note_list.php";</script> -->
          <?php
      
  }

  if(isset($_GET['edit'])){
    $pid=$_GET['edit'];
    $fetchResult=$user->getResultById($table,$pid);
    $arr = count($fetchResult);
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
          } 
          ?>
                
    
                </div><!-- /.box-header -->
                <div class="box-body">
        
            <form name="mgaform" id="mgaform" method="post" action="" enctype="multipart/form-data" >
          <div class="col-xs-6">
          <div class="form-group">
            <label>Name </label>
            <input type="text" name="name" required id="name" class="form-control" 
            <?php if(isset($_GET['edit'])){ ?>
             value="<?php echo $fetchResult['name']; ?>" 
             <?php } ?> />
                    </div>
                    </div>

          <div class="col-xs-6">
          <div class="form-group">
            <label>Email </label>
            <input type="text" name="email" required id="email" class="form-control" 
            <?php if(isset($_GET['edit'])){ ?>
             value="<?php echo $fetchResult['email']; ?>" 
             <?php } ?> />
              </div>
              </div>

            <div class="col-xs-6">
             <div class="form-group">
            <label>Mobile </label>
            <input type="text" name="mobile" required id="mobile" class="form-control" 
            <?php if(isset($_GET['edit'])){ ?>
             value="<?php echo $fetchResult['mobile']; ?>" 
             <?php } ?> />
              </div>
              </div>

               <div class="col-xs-6">
          <div class="form-group">
            <label>Password </label>
            <input type="text" name="password" required id="password" class="form-control" 
            <?php if(isset($_GET['edit'])){ ?>
             value="<?php echo base64_decode($fetchResult['password']); ?>" 
             <?php } ?> />
              </div>
              </div>


                
         

                    <div class="col-xs-12">
                    <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select2">
                  <option <?php echo ((isset($_GET['edit']) &&($fetchResult['status'] == '1')) ?'selected':'')  ?> value="1">Active</option>
                  <option <?php echo ((isset($_GET['edit']) &&($fetchResult['status'] == '0')) ?'selected':'')  ?> value="0" >DeActive</option>
                     
                    </select>
                    </div>

                      
            <div style="margen-left:140px;">
              <?php if(isset($_GET['edit'])){ ?>
                <input type="submit" class="btn btn-success" name="update" id="submit" value="Update"> 
              <?php }else{ ?>
              <input type="submit" class="btn btn-success" name="submit" id="submit" value="Add"> 

              <?php } ?>
                      
                                                         
                    </div> 
          
          
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
