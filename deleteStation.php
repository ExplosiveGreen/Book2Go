<?php
include "db.php";
$query = "DELETE FROM tbl_218_stations WHERE station_id='" . $_GET['station_id'] . "'";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}
header('Location: stations.php');
?>