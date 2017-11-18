
    <?php include "includes/header.php"; ?>
    <?php include "includes/navigation.php"; ?>


    <?php

        if(isset($_SESSION['username'])){

                $usernamed =  $_SESSION['username'];
                $usernamed = escape($usernamed);

                $stmt = mysqli_prepare($connection, "SELECT user_id,username,first_name,last_name,user_password,user_email FROM users WHERE username = ? " );
                mysqli_stmt_bind_param($stmt, "s", $usernamed );
            
                mysqli_stmt_execute($stmt);
            
                mysqli_stmt_bind_result($stmt, $user_id, $username,$first_name,$last_name,$user_password, $user_email);
             
                mysqli_stmt_fetch($stmt);
            
                mysqli_stmt_close($stmt);
             
            
        }
              
                 if(isset($_POST['edit_user'])){
                     
                       
            
                     
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];
                        $first_name=  $_POST['first_name'];
                        $last_name =  $_POST['last_name'];
                     
                        $user_email = escape($user_email);
                        $user_password = escape($user_password);
                        $first_name = escape($first_name);
                        $last_name = escape($last_name);
                   
                     
                     
                        if(!empty($user_password)){

                        $stmt2 =  mysqli_prepare($connection, "SELECT user_password FROM users WHERE user_id = ? " );
                            
                        mysqli_stmt_bind_param($stmt2, "i", $user_id );
                    
                        mysqli_stmt_execute($stmt2);
                            
                        mysqli_stmt_bind_result($stmt2, $db_user_password);
                             
                        mysqli_stmt_fetch($stmt2);
                            
                   
                         if($db_user_password != $user_password){

                            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

                             }else
                            {
                                $hashed_password = $user_password;
                            }
                            
                           mysqli_stmt_close($stmt2);
   
                           $stmtupdate = mysqli_prepare($connection, "UPDATE users SET user_email = ? , first_name = ?, last_name = ?, user_password = ? WHERE username = ? " );

                            mysqli_stmt_bind_param($stmtupdate, "sssss", $user_email, $first_name, $last_name, $hashed_password, $username );

                            mysqli_stmt_execute($stmtupdate);
                             
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