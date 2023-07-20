<?php 
include "config.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//testing connection success
if(mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}