<?php
    require_once ("inc/main.php"); 
	$side = "change_password";
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if(isset($_POST['submit']) && ($_POST['old_password']!="") && ($_POST['new_password']!="") && ($_POST['confirm_password']!="")){
		if($_POST['old_password'] != $_POST['confirm_password']){
			if($_POST['new_password'] == $_POST['confirm_password']){
				$check = new miscfunc();
				$pass = $_POST['old_password'];
				$cngMSG = "";
				$tableName = "admin";
				$checkreult = $check->checkExits($adminid, $pass, $tableName);
				$checkreult = true;
				if($checkreult) {
					$hash = $user->hashSSHA($_POST['confirm_password']);
					$colArray['password'] = $hash["encrypted"];
					$colArray['salt'] = $hash["salt"];
					$wherevalue = 'admin_id ='.$adminid ;
					$user->updateStatementwithAnd($colArray,$tableName,$adminid);
					$cngMSG = "<span style='color:green;font-size: 18px;'>Password Changed Successfully</span>";
				} else {
					$cngMSG = "<span style='color:red;font-size: 18px;'>Invalid Old Password</span>";
				}
			}else{
				$cngMSG = "<span style='color:red;font-size: 18px;'>New Password and Confirm Password is Not Same</span>";
			}
		}else{
			$cngMSG = "<span style='color:red;font-size: 18px;'>Old Password and New Password Can't be Same</span>";
		}
		}else{
			$cngMSG = "<span style='color:red;font-size: 18px;'>Please Enter Old & New Password and try Again</span>";
		}
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
          <h1>
            Change Password
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Change Passwors</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box box-warning" style="width=200px">
                <div class="box-header with-border">
                  <h3 class="box-title">Change Password</h3>
				  <?php if(isset($cngMSG)){ echo "<div style='text-align:center;'>".$cngMSG."</div>";}?>
                
                </div><!-- /.box-header -->
                <div class="box-body">
				<style>
	.required{
		color:red;
	}
	</style>
                   <form name="mgaform" id="mgaform" method="post" action="" enctype="multipart/form-data" >
          <div class="form-group">
		  <input type="hidden" name="userid" value="<?=$_SESSION['UserId'];?>">
                      <label>Old Password </label>
					 <input type="password" required id="oldpass" class="form-control require" name='old_password' value="">
					<span class="required" id="error_oldpass"></span>
                    </div>
					
					 <div class="form-group">
                      <label>New Password </label>
					 <input id="txtPassword" type="password" required class="form-control require" name='new_password' value="">
                           <span class="required" id="error_pass"></span>
                    </div>
					
					<div class="form-group">
                      <label>Confirm Password </label>
					 <input id="txtConfirmPassword" type="password" required class="form-control require" name='confirm_password' value="">
                <span class="required" id="error_confpass"></span>
                    </div>
				
				   <div style="margen-left:140px;">
		<input type="submit" onclick="return Validate()" class="btn btn-success" name="submit" id="submit" value="Change Password">
		
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
	<script type="text/javascript">
		function Validate() {
			var password = document.getElementById("txtPassword").value;
			var confirmPassword = document.getElementById("txtConfirmPassword").value;
			if(confirmPassword != ''){
			if (password != confirmPassword) {
				alert("Confirm Password do not Match.");
				return false;
			}
			}
			return true;
		}
	</script>
	<script>
		$(document).ready(function(){
				$('.require').blur(function(){
					
					if($.trim($("#oldpass").val())=="")
				{
					$("#error_oldpass").html("Required This Field");
					$("#oldpass").focus();
					return false;
				}
				$('#error_oldpass').html("");
				
				if($.trim($("#txtPassword").val())=="" || $('#txtPassword').val().length < 5)
				{
					$("#error_pass").html("Required This Field min 5 char");
					$("#txtPassword").focus();
					return false;
				}
				$('#error_pass').html("");
				
				if($.trim($("#txtConfirmPassword").val())==""  || $('#txtConfirmPassword').val().length < 5)
				{
					$("#error_confpass").html("Required This Field min 5 char");
					$("#txtConfirmPassword").focus();
					return false;
				}
				$('#error_confpass').html("");
				
				
				});
		});
	</script>
  </body>
</html>
