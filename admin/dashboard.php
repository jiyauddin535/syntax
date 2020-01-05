<?php 
    require_once ("inc/main.php"); 
	$side='dashboard';
	include 'inc/head.php';
?> 
<style type="text/css">
  
.rounded .progress-track,
.rounded .progress-fill {
  border-radius: 3px;
  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
}



/* Vertical */

.vertical .progress-bar {
  float: left;
  height: 300px;
  width: 40px;
  margin-right: 25px;
}

.vertical .progress-track {
  position: relative;
  width: 40px;
  height: 100%;
  background: #ebebeb;
}

.vertical .progress-fill {
  position: relative;
  background: #825;
  height: 50%;
  width: 40px;
  color: #fff;
  text-align: center;
  font-family: "Lato","Verdana",sans-serif;
  font-size: 12px;
  line-height: 20px;
}

.rounded .progress-track,
.rounded .progress-fill {
  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
  border-radius: 3px;
}
</style>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include"inc/header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
     <?php include"inc/side-bar.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
		 <section class="content">
		  <div class="row">
		  
		  
   
		
		<?php 
			
			$query = "SELECT * FROM user_data";
			$results = $user->getResult($query);
			$arr = count($results);
		?>
        <div class="col-lg-3 col-xs-6">
         
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $arr ;?></h3>

              <p>Total User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="user-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

          <?php 
      $cdate = date('Y-m-d') ;
      $query = "SELECT * FROM user_data WHERE createdDate like '".$cdate."%' ";
      $results = $user->getResult($query);
      $arr = count($results);
    ?>
        <div class="col-lg-3 col-xs-6">
         
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $arr ;?></h3>

              <p>Today New User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="user-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<!-- ./col -->
		<?php 
				//$query3="select * from earn_more_item ";              
			  /*   $query22= "SELECT * FROM user_data WHERE join_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";		   
			     $results22 = $user->getResult($query22);     							 
                  $arr22 = count($results22);*/
		?>
        <!--  <div class="col-lg-3 col-xs-6">
       
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php //echo $arr22 ;?></h3>
              <p>Today's Joining </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="user-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>  -->
		
        <!-- ./col -->
		
      
		
		
		
        <!-- ./col -->
      </div>
      <div class="row">
        <section class="col-lg-7 connectedSortable ui-sortable">
		
		
		
		
		
         
        </section>
        
      </div>
		 </section>
		
		
      </div><!-- /.content-wrapper -->
     <?php include"inc/footer.php"; ?>
  </body>
</html>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script type="text/javascript">
  $('.vertical .progress-fill span').each(function(){
  var percent = $(this).html();
  var pTop = 100 - ( percent.slice(0, percent.length - 1) ) + "%";
  $(this).parent().css({
    'height' : percent,
    'top' : pTop
  });
});
</script>