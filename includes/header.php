
<?php include "includes/db.php"; ?>

<?php include "admin/includes/functions.php"; ?>


<?php
 
  $year = date("Y");
  $month = date("m");
  $day = date("d");

  // gets the user IP Address
  $user_ip=$_SERVER['REMOTE_ADDR'];

  $check_ip = mysqli_query($connection, "select userip from pageview where page='gallerypage' and userip='$user_ip'");
  if(mysqli_num_rows($check_ip)>=1)
  {
  }
  else
  {
    $insertview = mysqli_query($connection, "insert into pageview values('','gallerypage','$user_ip','$year','$month','$day')");
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