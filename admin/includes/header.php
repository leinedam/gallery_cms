
<?php
ob_start();
session_start();
?>
<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<?php
    if(!isset($_SESSION['username'])){
       
           header("Location: login.php");
        
    }
?>



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
