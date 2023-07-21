<?php
include "db.php";
session_start();
if($_SESSION["user_type"] == 'reader'){
$query = "INSERT INTO tbl_218_user_books (user_id,book_id,station_id,order_type) values ('".$_SESSION["user_id"]."',
'".$_GET['book_id']."',1,'borrow')";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}
}
header('Location: index.php');
?>