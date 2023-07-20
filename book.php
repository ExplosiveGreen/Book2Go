<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
}
if (!empty($_GET["book_id"])) {
    $query = "SELECT * FROM tbl_218_books where book_id = '" . $_GET['book_id'] . "'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $row = mysqli_fetch_array($result);
    $query = "SELECT DISTINCT st.station_name 
    from tbl_218_station_books stb inner join tbl_218_stations st
    where stb.quantity > 0 and stb.book_id=".$_GET['book_id'].";";
    $result = mysqli_query($connection, $query);
    $availability = "";
    if(mysqli_fetch_assoc($result)){
        $availability = implode(',', mysqli_fetch_assoc($result));
    }
} else {
    header('Location: index.php');
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
    <title>Book Detail</title>
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
                <a href="#">פרטי ספר</a>&#60;
                <a href="index.php" class="noLink">עמוד הבית</a>
            </nav>
            <section id="wrapper" class="align-items-center d-flex">
                <h1>פרטי הספר</h1>
                <section id="bookDetails" class="d-flex">
                    <section id="imageAreaMobile" class="align-items-center">
                        <?php
                        if($_SESSION["user_type"] == 'reader'){
                            echo '<a id="reserveIcon" href="#"></a>';
                        } 
                        ?>
                        <?php echo '<img src="' . $row['img'] . '" alt="angel">'; ?>
                        <?php echo '<a id="editIcon" href="addBook.php?book_id='.$row['book_id'].'"></a>';?>
                    </section>
                    <section id="abstractAreaDesktop" class="d-flex flex-column align-items-end">
                        <h3>:תקציר</h3>
                        <?php echo '<p class="textRight">' . $row['abstract'] . '</p>'; ?>
                    </section>
                    <section id="nameAreaMobile" class="flex-column d-flex align-items-center justify-content-center pr-2">
                        <?php
                        echo '<h3>' . $row['book_name'] . '</h3>';
                        echo '<h4>' . $row['author'] . '</h4>';
                        ?>
                        <!-- <h3>מלאכים</h3>
                        <h4>ל. א. וות'רלי</h4>
                        <section class="d-flex flex-row gap-2">
                            <span>
                                (27
                                דירוגים)
                                5 &nbsp;
                                ספרים
                            </span>
                            <div>
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                            </div>
                        </section> -->
                    </section>
                    <section id="imageAreaDesktop">
                        <?php echo '<img src="' . $row['img'] . '" alt="angel">'; ?>
                        <?php 
                            echo '<div class="d-flex flex-column gap-2">';
                            echo '<a id="editIcon" href="addBook.php?book_id='.$row['book_id'].'"></a>';
                            if($_SESSION["user_type"] == 'reader'){
                                echo '<a id="reserveIcon" href="#"></a>';
                            } 
                            if($_SESSION["user_type"] == 'librarian'){
                                echo '<a id="deleteIcon" href="deleteBook.php?book_id="'.$row['book_id'].'"></a>';
                            }
                            echo '</div>';
                        ?>
                    </section>
                </section>
                <section id="tabsSection">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#bookInfo" role="tab"
                                aria-controls="bookInfo" aria-selected="false">עוד על הספר</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#abstractAreaMobile" role="tab"
                                aria-controls="abstractAreaMobile" aria-selected="true">תקציר</a>
                        </li>
                    </ul>
                    <section class="tab-content">
                        <section id="bookInfo" role="tabpanel" aria-labelledby="bookInfoTab" class="tab-pane fade">
                            <section class="d-flex flex-column alignHebrewEnd">
                                <?php
                                echo '<span>' . $row['translate'] . ':תרגום</span>';
                                echo '<span>' . $row['publisher'] . ':הוצאה</span>';
                                echo '<span>' . $row['publish_date'] . ':תאריך הוצאה</span>';
                                echo '<span bs-category="' . $row['category_id'] . '"> :קטגוריה</span>';
                                echo '<span>' . $availability . ':זמינות</span>';
                                echo '<span bs-condition="' . $row['condition_id'] . '"> :מצב</span>';
                                ?>
                            </section>
                        </section>
                        <section role="tabpanel" aria-labelledby="abstractTab" id="abstractAreaMobile"
                            class="tab-pane fade show active">
                            <section class="d-flex flex-column align-items-end">
                                <?php echo '<p class="textRight">' . $row['abstract'] . '</p>'; ?>
                            </section>
                        </section>
                    </section>
                </section>
                <section id="bookMeta" class="w-100 d-flex flex-row justify-content-between">
                    <section class="w30 p-3 d-flex flex-column align-items-end alignHebrewEnd">
                        <?php
                        echo '<span>תרגום: ' . $row['translate'] . '</span>';
                        echo '<span>הוצאה: ' . $row['publisher'] . '</span>';
                        echo '<span>תאריך הוצאה: ' . $row['publish_date'] . '</span>';
                        echo '<span bs-category="' . $row['category_id'] . '">קטגוריה: </span>';
                        echo '<span>זמינות: ' . $availability . '</span>';
                        echo '<span bs-condition="' . $row['condition_id'] . '">מצב: </span>';
                        ?>
                    </section>
                    <section class="flex-column d-flex align-items-center justify-content-center pr-4">
                        <?php
                        echo '<h3>' . $row['book_name'] . '</h3>';
                        echo '<h4>' . $row['author'] . '</h4>';
                        ?>
                        <!-- <section class="d-flex flex-row gap-2">
                            <span>
                                (27
                                דירוגים)
                                5 &nbsp;
                                ספרים
                            </span>
                            <div>
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                                <img src="images/rating.svg">
                            </div>
                        </section> -->
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