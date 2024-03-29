<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
}

$query = "SELECT * FROM tbl_218_stations";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("DB query failed.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>station</title>
</head>

<body>
    <header class="d-flex justify-content-between">
        <a href="index.php" id="logo"></a>
        <img role="button" id="hamburger" src="images/menu.png" alt="hamburger" data-bs-toggle="offcanvas"
            data-bs-target="#hamburgerNavigation" aria-expanded="false" aria-controls="hamburgerNavigation">
    </header>
    <main class="w-100 d-flex">
        <section id="wrapper" class="w-100">
            <div id="actionArea" class="d-flex flex-row gap-2">
                <a href="addStation.php" id="addStation" class="icon"></a>
                <select class="form-select w-50" aria-label="Default select example" name="stationStatus" id='statusFilter'>
                    <option selected value="-1">בחר סטטוס</option>
                </select>
                <section id="searchArea">
            <img id="searchIcon" src="images/search.png" alt="searchIcon">
            <input type="search" class="form-control roundInput" id="search" placeholder="חפש תחנה">
            </div>
            <h1 class="d-flex justify-content-center">stations list</h1>
            <div class="d-flex flex-wrap mt-2 gap-3">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a href='station.php?station_id=" . $row["station_id"] . "'class='card justify-content-center'>";
                    echo "<div class='card-body d-flex flex-column align-items-center'>";
                    echo "<p class='card-subtitle'>" . $row["station_name"] . "</p>";
                    echo "<img class='card-image-eop' src='" . $row["station_img"] . "' title='" . $row["station_name"] . "' alt='" . $row["station_name"] . "'>";
                    echo "<p class='card-subtitle' bs-station=" . $row["station_status_id"] . "></p>";
                    echo "<p class='card-title'>" . $row["location"] . "</p>";
                    echo "</div>";
                    echo "</a>";
                }
                ?>
            </div>

        </main>
        <div id="hamburgerNavigation" class="offcanvas-end offcanvas">
            <aside class="d-flex flex-column">
                <section>
                    <section class="align-items-end">
                        <img role="button" id="innerHamburger" alt="innerHamburger" src="images/menu.png"
                            data-bs-dismiss="offcanvas">
                    </section>
                    <section class="d-flex align-items-center pad-35 justify-content-center">
                        <img src="images/coral.png" class="profilePic" alt="coral">
                        <span>קורל</span>
                    </section>
                    <section class="d-flex align-items-center pt-3 justify-content-center">
                        <span>יעיעיחיעח</span>
                        <span>יהחכעיחיעח</span>
                    </section>
                </section>
                <section>
                    <a href="#" class="btn d-flex flex-row justify-content-between">
                        <span>&#60;</span>
                        <section class="d-flex flex-row gap-1">
                            <span>הפרופיל שלי</span>
                            <img src="images/profile.svg" alt="profile">
                        </section>
                    </a>
                    <a href="#" class="btn d-flex flex-row justify-content-between">
                        <span>&#60;</span>
                        <section class="d-flex flex-row gap-1">
                            <span>דוחות</span>
                            <img src="images/report.svg" alt="report">
                        </section>
                    </a>
                    <a href="index.php" class="btn d-flex flex-row justify-content-between">
                        <span>&#60;</span>
                        <section class="d-flex flex-row gap-1">
                            <span>רשימת ספרים</span>
                            <img src="images/rating-gray.svg" alt="ratingGray">
                        </section>
                    </a>
                </section>
                <section>
                    <a href="#" class="btn d-flex flex-row justify-content-between">
                        <span>&#60;</span>
                        <section class="d-flex flex-row gap-1">
                            <span>הגדרות</span>
                            <img src="images/setting.svg" alt="setting">
                        </section>
                    </a>
                    <a href="logout.php" class="btn d-flex flex-row justify-content-end gap-1">
                        <span>התנתקות</span>
                        <img src="images/logout.svg" alt="logout">
                    </a>
                </section>
            </aside>
        </div>
    </section>
</body>
<script src="js/script.js"></script>
</html>
<?php
mysqli_close($connection);
?>