<?php ob_start(); ?>
<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'gallery';


foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

//$query = "SET NAME utf8";

$connection = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);


?>