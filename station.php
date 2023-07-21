<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
}
if ($_SESSION["user_type"]!="librarian"){
    header('location: index.php');
}
if (!empty($_GET["station_id"])) {
    $query = "SELECT * FROM tbl_218_stations where station_id = '" . $_GET['station_id'] . "'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $row = mysqli_fetch_array($result);
} else {
    header('Location: stations.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>station Details</title>
</head>

<body>
    <header class="d-flex justify-content-between">
        <a href="index.php" id="logo"></a>
        <img role="button" src="images/menu.png" alt="hamburger" data-bs-toggle="offcanvas"
            data-bs-target="#hamburgerNavigation" aria-expanded="false" aria-controls="hamburgerNavigation">
    </header>
    <main class="d-flex">
        <section class="flex-column d-flex w-100">
            <nav class="d-flex justify-content-end flex-row">
                <a href="#">פרטי תחנה</a>&#60;
                <a href="index.php" class="noLink">עמוד הבית</a>
            </nav>
            <section id="wrapper" class="align-items-center d-flex">
                <h1>פרטי התחנה</h1>
                <section id="stationDetails" class="d-flex">
                    <section class="flex-column d-flex align-items-center justify-content-center pr-2">
                        <?php
                        echo '<h3>' . $row['station_name'] . '</h3>';
                        echo '<h4>' . $row['location'] . '</h4>';
                        echo '<h5 bs-station="' . $row['station_status_id'] . '"></h5>';
                        ?>
                    </section>
                    <section class="d-flex gap-2">
                    <?php echo '<img src="' . $row['station_img'] . '" alt="'.$row['station_img'].'">'; ?>
                    <?php echo '<a id="editIcon" href="addStation.php?station_id='.$row['station_id'].'"></a>';?>
                    <?php echo '<a id="deleteIcon" href="deleteStation.php?station_id='.$row['station_id'].'"></a>';?>
                    </section>
                </section>
            </section>
        </section>
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
    </main>

</body>

</html>
<?php
mysqli_free_result($result);
mysqli_close($connection);
?>