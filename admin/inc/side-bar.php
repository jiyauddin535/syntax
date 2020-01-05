<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <!-- <div class="pull-left image">
			
				
				<img src="images/user.png" class="img-circle" alt="User Image" />
            </div> -->
           <!--  <div class="pull-left info">
				<p><?php //echo $admin['name']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div> -->
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li  class="treeview <?php if($side=='dashboard'){ ?> active <?php } ?>">
				<a href="dashboard.php">
					<i class="fa fa-dashboard"></i>
					<span>Dashboard</span> 
				</a>
            </li>				
		
		
		<li class="<?php  if($side=='change_password'){ ?> active <?php } ?> treeview">
			<a href="changepass.php">
				<i class="fa fa-edit"></i> <span>Change Password</span>
			</a>
        </li>

      

		
		<li class="treeview">
			<a href="user-list.php">
				<i class="fa fa-edit"></i> <span>User List</span>
			</a>
        </li>

        <li class="treeview">
			<a href="manage-category.php">
				<i class="fa fa-edit"></i> <span>Category</span>
			</a>
        </li>

         


    
        

        

       

        
	</ul>
    </section>
    <!-- /.sidebar -->
</aside>