<?php
    require_once ("inc/main.php"); 
    error_reporting(1);
  $side = "category"; 
  $title = "Category List" ;
  $table = "category_list" ;
//Singel Delete
if(isset($_GET['ids'])){
   $deleteid = $_GET['ids'];   
  $sql = $user->QueryDelete($table,$deleteid);
  
  if($sql){
    $sms = "<p style='text-align:center;color:green;'>Record deleted successfully</p>"; 
    ?>
   <!--  <script type="text/javascript">alert("Record has been deleted successfully.");window.location.href="register.php";</script> -->
    <?php
  
  }
}

 //Status active/deactive

if(isset($_GET['tag']) && $_GET['tag']=='ProgarmActivateDeactivate')
{
   $query= $user->updateStatus($table,"status",$_GET['active'],$_GET['id']);
} 
  $query = "select * from $table order by id desc";
  $results = $user->getResult($query);
  $arr = count($results);
  $x = 0;
  $i = 1;
  
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
          <h1>
           <?=$title ;?>
          </h1>

          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li> >> 
            <?=$title?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
    <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?=$title ; ?></h3>
                  <div class="pull-right">
                    <button type="submit" onclick="window.location.href='add-category.php?action=add'" id="button-invoice" form="form-order" formaction="#" formtarget="_blank" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add"><i class="fa fa-plus-circle"></i></button>
                  </div>
        
                </div><!-- /.box-header -->
                <div class="box-body">
          <?php if(isset($_SESSION['sms'])){
            echo $_SESSION['sms'];
            unset($_SESSION['sms']);
          } ?>
               <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
           
                        <th>S.No</th>
                        <th>Category</th>                                                
                        <th>Status</th>
                        <th>Action</th>
            
                      </tr>
                    </thead>
                    <tbody>
  
          <?php while($x < $arr){?>
        <tr>        
            <td><?php echo $i; ?></td>
             <td> <?php echo $results[$x]['catName']; ?></td>
            <td>  <?php echo (($results[$x]['status']=='1')?'Active':'deActive') ?>
                     <!--  <form method="POST" class="toggle-form">
                           <label class="checkbox-inline">
                            <input type="hidden" name="table_name" value="<?=$table ;?>">
                               <input type="hidden" name="toggle_id" value="<?php //echo $results[$x]['id'] ?>">
                                            <input  <?php // if ($results[$x]['status']=='1') {?> checked <?php //} ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="checkbox_toggle" type="checkbox">
                                          </label>
                                        </form>  -->     
                            
                        </td>
            
            
                      
            <td>
              <a href="add-category.php?edit=<?php echo $results[$x]['id'];?>"><span class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</span></a>
      
               <a href="manage-category.php?ids=<?php echo $results[$x]['id'];?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure want to delete')">Delete</a>
        
            </td>
            
            
            
                      </tr>
             <?php $x++;$i++;}?>
                      
                     
                    </tbody>
                    <tfoot>
                      
                    </tfoot>
                  </table>
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

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- page script -->
       <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
   <script type="text/javascript">
    function checkAll()
    {

      len = document.getElementsByClassName('check').length;
      //alert("Please Select Ok to Send All");
      if (document.getElementById('check_all').checked == true)
      {
        for (i = 1; i <= len; i++)
        {
          //alert("I : "+i)
          document.getElementById('check' + i).checked = true;
        }
      }
      else
      {
        for (i = 1; i <= len; i++)
        {
          document.getElementById('check' + i).checked = false;
        }
      }
    }
        </script>
        <script src="js/bootstrap-toggle.js"></script>
  </body>
</html>
<script type="text/javascript">
    
//regex for email validation
    $(document).ready(function() {
        $('input[name="checkbox_toggle"]').change(function(){
            $(this).find('input[type=checkbox]');
            var status =  $(this).parents('.toggle-form').serialize();
            //$(this).parents('.cart_update').submit();
            //alert(status);
            $.ajax({
                type: "POST",
                url: "update_status.php",
                data: status,
                    //dataType: 'html'
                beforeSend: function(){
                $('#msg').html('<img src="../libs/ajaxloader.gif" />');
                    },
            success: function(msg){
                $('#msg').html(''+msg+'');
                //alert(msg);
               //window.location.href="category-listing.php";
                  
            }
             });
        });
    });
</script> 
