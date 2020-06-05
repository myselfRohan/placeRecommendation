 <?php
date_default_timezone_set("Asia/Kolkata");
include("../connection.php");
			
	?>
  <!-- /. NAV SIDE  -->
  <style>
.active a {
    background:#34495e !important;
    color: #000;
}
</style>
 <nav class="navbar-default navbar-side" role="navigation">
		<div id="sideNav" href="#"><i class="fa fa-caret-right"></i></div>
            <div class="sidebar-collapse">
                <ul class="mainmenu nav" >
	<li class="menuitem <?php if($page=='dashboard'){echo 'active';}?>" >
		<a href="dashboard.php"><span>Dashboard</span></a>
	</li>
	
	<li class="menuitem <?php if($page=='users'){echo 'active';}?>" >
		<a href="users.php"><span>Users</span></a>
	</li>  
	
	
	<li class="menuitem <?php if($page=='services'){echo 'active';}?>" >
		<a href="category.php"><span>Category</span></a>
	</li> 
	<li class="menuitem <?php if($page=='services_sub'){echo 'active';}?>" >
		<a href="place.php"><span>Add Place</span></a>
	</li> 
	 
	
	
</ul>
            </div>

  </nav>
      