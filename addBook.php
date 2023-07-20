<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
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
        <img role="button" id="hamburger" src="images/menu.png" alt="hamburger" data-bs-toggle="offcanvas"
            data-bs-target="#hamburgerNavigation" aria-expanded="false" aria-controls="hamburgerNavigation">
    </header>
    <div id="wrapper" class="d-flex flex-row">
        <section class="addBookForm  container p-0">
            <nav id="breadcrumps" class="d-flex flex-row justify-content-end">
                <a href="#">הוספת ספר</a>&#60;
                <a href="index.php" class="noLink ">עמוד הבית</a>
            </nav>
            <h1 class="text-center mb-5">הוספת ספר</h1>
            <main>
                <form id="bookForm" action="addedBook.php" method="get" autocomplete="on">
                    <div id='upperAddSection' class="d-flex flex-column justify-content-center gap-4">
                        <div id="abstractArea">
                            <textarea class="form-control" id="abstract" name="abstract" placeholder="הכנס תקציר כאן"
                                required></textarea>
                            &nbsp;
                            <label for="abstract" id="abstractLable" class="form-label">:תקציר</label>
                        </div>
                        <!-- <img id="bookPlaceholder" src="images/image-placeholder-1.png" alt="bookPlaceholder"> -->
                        <div class="d-flex flex-column">
                            <input type="file" id="bookImage" name="bookImage" accept="image/*" required>
                            <label for="bookImage" class="justify-content-center d-flex h-100 w-100">
                                <img id="bookPlaceholder" src="images/image-placeholder-1.png" alt="bookPlaceholder">
                            </label>
                        </div>
                    </div>
                    <h2>פרטי הספר</h2>
                    <div class="container">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="row-auto">
                                        <lable for="publishName" id="publishNameLable" class="form-label">:הוצאה</lable>
                                        <input type="text" class="form-control" id="publishName" name="publishName"
                                            value="" placeholder="שם הוצאה" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label for="bookName" id="nameBookLable" class="form-label">:שם הספר</label>
                                        <input type="text" class="form-control" id="bookName" name="bookName" value=""
                                            placeholder="שם הספר" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class='row'>
                                <div class="col">
                                    <div class="row-auto">
                                        <lable for="publicationDate" id="publicationDateLable" class="form-label">:תאריך
                                            הוצאה</lable>
                                        <input type="text" class="form-control" id="publicationDate"
                                            name="publicationDate" value="" placeholder="הכנס חודש ושנת הוצאה" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label for="authorName" id="authorNameLable" class="form-label">:שם
                                            הסופר</label>
                                        <input type="text" class="form-control" id="authorName" name="authorName"
                                            value="" placeholder="שם הסופר" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                            <div class="col">
                                    <div class="row-auto">
                                        <label for="translatorName" id="translatorNameLabel" class="form-label">:שם
                                            המתרגם</label>
                                        <input type="text" class="form-control" id="translatorName"
                                            name="translatorName" value="" placeholder="שם המתרגם">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label id="categoryLable">:קטגוריה</label>
                                        <select class="form-select" aria-label="Default select example" name="category">
                                            <option selected value="-1">בחר קטגוריה</option>
                                            <option value="פנטזיה">פנטזיה</option>
                                            <option value="מדע בדיוני">מדע בדיוני</option>
                                            <option value="רומן רומנטי">רומן רומנטי</option>
                                            <option value="ריאליסטי">ריאליסטי</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class='row'>
                            <div class="col">
                                <div class="row-auto">
                                    <label id="stateLable">:מצב</label>
                                    <select class="form-select" aria-label="Default select example" name="state">
                                        <option selected value="-1">בחר מצב</option>
                                        <option value="חדש">חדש</option>
                                        <option value="קריא">קריא</option>
                                        <option value="פגום">פגום</option>
                                        <option value="בלוי">בלוי</option>
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
                        <input type="submit" class="btn btn-primary" id="save" value="שמירה">
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