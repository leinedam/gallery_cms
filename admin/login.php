
<?php
ob_start();
session_start();
?>


<?php include "../includes/db.php"; ?>

<?php include "includes/functions.php"; ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sangoi Gallery Admin</title>
    <!-- icons-->
    <link href="../vendor/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/admin.css" rel="stylesheet">
    
    
     <!-- Charts -->
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <!-- jquery -->
     <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    

   
</head>
<body>
   
<?php

        if(isset($_POST['loginuser'])){

        $username = $_POST['username'];
        $password = $_POST['user_password'];
            
        $username = escape($username);
        $password = escape($password);
        
            
        
        $stmt = mysqli_prepare($connection, "SELECT user_id,username,user_password,user_email FROM users WHERE username = ? ");
            
        mysqli_stmt_bind_param($stmt, "s", $username );
            
        mysqli_stmt_execute($stmt);
            
        mysqli_stmt_bind_result($stmt, $db_id, $db_username, $db_user_password, $db_user_email);
            
       

        while(mysqli_stmt_fetch($stmt)){
            
        
        if(password_verify($password, $db_user_password)){


                $_SESSION['username'] = $db_username;
                $_SESSION['user_email'] = $db_user_email;
           
               header("Location: index.php");
               return true;

            }else{

                $message = "<div class='alert alert-danger' role='alert'><strong>The Username or Password is incorrect</strong></div>";
//               header("Location: login.php");
//               
//               return false;
            } 
        }
     //  return true;
              
   }

    ?>

        <!-- Page Menu -->
        <div id="page-content-login">

          <div class="admin-content">

             <h1 class="text-center">Log In</h1>
             <br>

             <div class="row">
               <div class="col-md-12">
                   <?php  if(isset($_POST['loginuser'])){ echo $message; } ?>
                    <form action="" method="post" >
                      <div class="form-group ">
                       <label for="username">Username</label>
                       <input type="text" class="form-control" name="username" aria-describedby="emailHelp" id="username" placeholder="Enter username">
                      </div>
                      <div class="form-group ">
                       <label for="user_password">Password</label>
                       <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password">
                       <small id="passwordHelp" class="form-text text-muted">Forgot Password?.</small>
                      </div>
                    <button type="submit" name="loginuser" id="loginuser" class="btn btn-primary">Enter</button>
                  </form>
               </div>
             </div>
             
             <p class="text-right">
                 <a href="../index.php" >Go to Gallery Page</a>
             </p>
              
      </div>
    <!-- /#page-content-wrapper -->





<?php include "includes/footer.php"; ?>
