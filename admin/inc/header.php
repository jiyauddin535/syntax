<header class="main-header">
        <!-- Logo -->
        <a href="dashboard.php" class="logo new-logo">Syntax<!-- <img src="<?php //echo $user->getLogo(); ?>" class="img-responsive logo1" alt="Syntax"/> -->
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="images/admin_profile.png"/></span> 
          <!-- logo for regular state and mobile devices -->
        <!--   <span class="logo-lg"><img src="images/logo.png" height="150px" width="200px"/></span> --->
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
          
             <!-- </li>-->
              <!-- Tasks: style can be found in dropdown.less -->
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 
                  <span class="hidden-xs">Welcome <?php echo  $admin['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="logout.php" >Sign out</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
 <style>
	  	  /*.new-logo img{
		  display:block;
	  margin:auto;}*/
	  .logo-mini img{
		  width:50px;
	  }
	  @media (min-width: 768px){
		  .sidebar-mini.sidebar-collapse .main-header .logo>.logo1{
			 display:none;
		  }
		  
		  
	  }
	  </style>