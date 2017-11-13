<?php ob_start(); ?>
<?php session_start(); ?>


<?php

    $_SESSION['username'] = null;
    $_SESSION['user_email'] = null;
    $_SESSION['password'] = null;

    header("Location: ../login.php");
            
?>