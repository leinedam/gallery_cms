
<?php include "includes/db.php"; ?>

<?php include "admin/includes/functions.php"; ?>


<?php
 
  $year = date("Y");
  $month = date("m");
  $day = date("d");
  $page = 'gallerypage';

  // gets the user IP Address
  $user_ip=$_SERVER['REMOTE_ADDR'];



$check_ip = mysqli_prepare($connection, "SELECT userip FROM pageview where page= ?  and userip= ? ");

     mysqli_stmt_bind_param($check_ip,"ss", $page,$user_ip  );
     mysqli_stmt_execute($check_ip);
     mysqli_stmt_bind_result($check_ip, $ip);
     mysqli_stmt_store_result($check_ip);


if(mysqli_stmt_num_rows($check_ip)>=1)
  {
  }
  else
  {
    $insertview = mysqli_prepare($connection, "insert INTO pageview(page,userip,year,month,day) VALUES(?,?,?,?,?)");
      
    mysqli_stmt_bind_param($insertview, 'sssss', $page, $user_ip, $year, $month, $day );
                
    mysqli_stmt_execute($insertview);
      
    mysqli_stmt_close($insertview);
      
  }      

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sangoi Gallery</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link href="vendor/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sidebar.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/gallery.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/popup.css" rel="stylesheet">
</head>

<body>