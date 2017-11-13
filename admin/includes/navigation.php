    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        DIA Admin
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-plus" aria-hidden="true"></i>DashBoard</a>
                </li>
                <li>
                    <a href="images.php"><i class="fa fa-plus" aria-hidden="true"></i>View Images</a>
                </li>
                <li>
                    <a href="images.php?source=add_image"><i class="fa fa-plus" aria-hidden="true"></i>Add Image</a>
                </li>
          
                <li>
                    <a href="categories.php"><i class="fa fa-plus" aria-hidden="true"></i>Categories</a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa fa-plus" aria-hidden="true"></i>Profile</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        
               <!-- Page Menu -->
        <div id="page-content-wrapper">


          <div class="row">
              <div class="container-fluid">
                  <div class="dropdown">
                    <a class="btn admin-btn dropdown-toggle float-right"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user" aria-hidden="true"></i> <?php 
                            if(isset($_SESSION['username'])){
                                echo $_SESSION['username'];
                            }
                        ?> 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="includes/logout.php">Log Out</a>
                       <a class="dropdown-item" href="login.php">Log In</a>
           
                    </div>
                  </div>
                  <a href="../index.php" class="btn admin-btn float-right"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
              </div>
          </div>