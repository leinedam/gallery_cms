
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>


    <?php

        if(isset($_SESSION['username'])){

                $username = $_SESSION['username'];

                $query = "SELECT * FROM users WHERE username = '{$username}' ";

                $select_user_profile = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_user_profile)){

                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $first_name =  $row['first_name'];
                        $last_name =   $row['last_name'];
                        $user_password = $row['user_password'];
                        $user_email = $row['user_email'];
 
                }
         
                 if(isset($_POST['edit_user'])){
                     

                        $user_email = escape($_POST['user_email']);
                        $user_password = escape($_POST['user_password']);
                        $first_name =  escape($_POST['first_name']);
                        $last_name =   escape($_POST['last_name']);
                     
                     
                         if(!empty($user_password)){

                        $query_password = "SELECT user_password FROM users WHERE user_id = {$user_id} ";
                        $get_user = mysqli_query($connection, $query_password);

                        confirmQuery($get_user);

                        $row = mysqli_fetch_array($get_user);

                        $db_user_password = $row['user_password'];

                         if($db_user_password != $user_password){

                            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                             }else
                            {
                                $hashed_password = $user_password;
                            }

                            $query = "UPDATE users SET ";
                            $query .= "user_email = '{$user_email}', ";
                            $query .= "first_name = '{$first_name}', ";
                            $query .= "last_name = '{$last_name}', ";
                            $query .= "user_password = '{$hashed_password}' ";
                            $query .= "WHERE username = '{$username}' ";

                            $update_user = mysqli_query($connection, $query);

                            confirmQuery($update_user);

                            }

                          }

                    }    

        ?>     
             
              <!-- /.container -->

                <div class="admin-content">

                   <h1><?php echo $username ;?>'s Profile</h1>
                   <br>

                   <div class="row">
                     <div class="col-md-12">

                       <form action="" method="post">
                         <div class="row">
                            <div class="form-group col-md-6">
                             <label for="first_name">First Name</label>
                             <input type="text" class="form-control" name="first_name"  value="<?php echo $first_name ;?>" aria-describedby="first_name" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-6">
                             <label for="last_name">Last Name</label>
                             <input type="text" class="form-control" value="<?php echo $last_name ;?>" name="last_name" placeholder="Enter last name">
                            </div>
                          </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                             <label for="exampleInputEmail1">Email address</label>
                             <input type="email" class="form-control" name="user_email"  value="<?php echo $user_email ;?>" aria-describedby="emailHelp" placeholder="Enter email">
                             <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group col-md-6">
                             <label for="user_password">Password</label>
                             <input type="password" class="form-control" value="<?php echo $user_password ;?>" name="user_password" placeholder="Password">
                            </div>
                          </div>

                          <button type="submit" name="edit_user" class="btn btn-primary">Edit</button>
                        </form>

                     </div>
                   </div>

      </div>
      <!-- /#page-content-wrapper -->


    <?php include "includes/footer.php"; ?>