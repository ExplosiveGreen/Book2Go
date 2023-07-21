<?php
include "db.php";
$query = "DELETE FROM tbl_218_books WHERE book_id='" . $_GET['book_id'] . "'";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}
header('Location: index.php');
?>