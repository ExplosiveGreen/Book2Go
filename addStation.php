<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
}
$data = [
    "station_id" => -1,
    "station_name" => "",
    "station_status_id" => 1,
    "location" => "",
    "station_img" => "images/train-station.png"
];
if(!empty($_GET["station_id"])) {
    $station_id = $_GET["station_id"];
    $query = "SELECT * FROM tbl_218_stations WHERE station_id='$station_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $data = mysqli_fetch_array($result);
    mysqli_free_result($result);
}
if(isset($_POST["stationName"])) {
    $station_id = $_POST["station_id"] ? $_POST["station_id"] : $data['station_id'];
    $station_name = $_POST["stationName"] ? $_POST["stationName"] : $data['station_name'];
    $station_status_id = $_POST["stationStatus"] ? $_POST["stationStatus"] : $data['station_status_id'];
    $location = $_POST["locationName"] ? $_POST["locationName"] : $data['location'];
    $station_img = $_POST["stationImage"] ? $_POST["stationImage"] : $data['station_img'];
    if($station_id > 0){
        $query = "UPDATE tbl_218_stations SET station_name='".$station_name."', station_status_id='".$station_status_id."', location='".$location."', station_img='".$station_img."' WHERE station_id='".$station_id."'";
    }else{
        $query = "INSERT INTO tbl_218_stations (station_name, station_status_id, location, station_img) VALUES ('".$station_name."','".$station_status_id."','".$location."','".$station_img."')";
    }
    $result = mysqli_query($connection, $query);
    if($result) {
      header("Location: stations.php");
    } else {
      $message = "Failed to insert data information!";
    }
    mysqli_free_result($result);
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>add book</title>
</head>

<body>
    <header class="d-flex justify-content-between">
        <a href="index.php" id="logo"></a>
        <img role="button" src="images/menu.png" alt="hamburger" data-bs-toggle="offcanvas"
            data-bs-target="#hamburgerNavigation" aria-expanded="false" aria-controls="hamburgerNavigation">
    </header>
    <div id="wrapper" class="d-flex flex-row">
        <section class="addBookForm  container p-0">
            <nav class="d-flex flex-row justify-content-end">
                <a href="#">הוסף תחנה </a>&#60;
                <a href="index.php" class="noLink ">עמוד הבית</a>
            </nav>
            <h1 class="text-center mb-5">הוסף תחנה </h1>
            <main>
                <form id="stationForm" action="#" method="POST" autocomplete="on">
                    <input type="hidden" name="station_id" value="<?php echo $data["station_id"] ?>">
                    <div id='upperAddSection' class="d-flex flex-column justify-content-center gap-4">
                        <div class="d-flex flex-column">
                            <input type="hidden" id="stationImage" name="stationImage" value="<?php echo $data['station_img']?>" readonly>
                            <label for="stationImage" class="justify-content-center d-flex h-100 w-100">
                                <img id="previewImage" onclick="openImagePickerStations()" src="<?php echo $data['station_img']?>" alt="bookPlaceholder">
                            </label>
                        </div>
                    </div>
                    <h2>פרטי תחנה</h2>
                    <div class="container">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="row-auto textRight">
                                        <lable for="locationName" class="form-label">מיקום</lable>
                                        <input type="text" class="form-control textRight" name="locationName"
                                            value="<?php echo $data["location"]?>" placeholder="שם המיקום"
                                            >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto textRight">
                                        <label for="stationName" class="form-label">שם התחנה</label>
                                        <input type="text" class="form-control textRight" name="stationName" value="<?php echo $data["station_name"]?>"
                                            placeholder="שם התחנה" 
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class='row'>
                            <div class="col">
                                <div class="row-auto textRight">
                                    <label class="form-label mt-1">סטטוס התחנה</label>
                                    <select class="form-select" aria-label="Default select example" name="stationStatus"
                                    >
                                        <option selected value="-1">בחר מצב</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col"></div>
                            </div>
                        </div>
                    </div>
                    <div id="publicationDateError"
                        class="error-message text-danger d-flex flex-column align-items-center"></div>
                    <div class="buttons">
                        <input type="submit" class="btn btn-primary" value="שמירה">
                    </div>
                </form>
                <script src="js/script.js"></script>
            </main>
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
    </div>
</body>

</html>
<?php
mysqli_close($connection);
?>