﻿<?php 
$connection = mysqli_connect($host, $username, $password, $dbName);
$connection->query("SET NAMES 'utf8'");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//testing connection success
if(mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}