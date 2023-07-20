<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
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
    <title>Home Page</title>
</head>

<body>
    <header class="d-flex justify-content-between">
        <a href="index.php" id="logo"></a>
        <img role="button" id="hamburger" src="images/menu.png" alt="hamburger" data-bs-toggle="offcanvas"
            data-bs-target="#hamburgerNavigation" aria-expanded="false" aria-controls="hamburgerNavigation">
    </header>
    <main class="w-100 d-flex">
        <section id="wrapper" class="w-100">
            <div id="actionArea" class="d-flex flex-row">
                <a href="addBook.php" id="addBook"></a>
                <img id="deleteIcon" src="images/delete.svg" alt="deleteIcon">
                <img id="filterIcon" src="images/filter.svg" alt="filterIcon">
            </div>
            <div class="d-flex flex-wrap mt-2 gap-3">
                <a href="book.php?book_id=1" class="card justify-content-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img class="card-image-eop" src="images/uploads/angel.png" title="angel" alt="angel">
                        <p class="card-title">מלאכים</p>
                        <p class="card-subtitle">רומן רומנטי</p>                        
                    </div>
                </a>
                <a href="book.php?book_id=1" class="card justify-content-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img class="card-image-eop" src="images/uploads/angel.png" title="angel" alt="angel">
                        <p class="card-title">מלאכים</p>
                        <p class="card-subtitle">רומן רומנטי</p>                        
                    </div>
                </a>
                <a href="book.php?book_id=1" class="card justify-content-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img class="card-image-eop" src="images/uploads/angel.png" title="angel" alt="angel">
                        <p class="card-title">מלאכים</p>
                        <p class="card-subtitle">רומן רומנטי</p>                        
                    </div>
                </a>
                <a href="book.php?book_id=1" class="card justify-content-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img class="card-image-eop" src="images/uploads/angel.png" title="angel" alt="angel">
                        <p class="card-title">מלאכים</p>
                        <p class="card-subtitle">רומן רומנטי</p>                        
                    </div>
                </a>
                <a href="book.php?book_id=1" class="card justify-content-center">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img class="card-image-eop" src="images/uploads/angel.png" title="angel" alt="angel">
                        <p class="card-title">מלאכים</p>
                        <p class="card-subtitle">רומן רומנטי</p>                        
                    </div>
                </a>
            </div>

            <!-- <div class="table-responsive w-100">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">תאריך הוספת הספר</th>
                            <th scope="col">קטגוריה</th>
                            <th scope="col">מצב הספר</th>
                            <th scope="col">שם הסופר</th>
                            <th scope="col">שם הספר</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                        <tr>
                            <td>אפריל 2016</td>
                            <td>רומן רומנטי</td>
                            <td>חדש</td>
                            <td>ל.א. וות'רלי</td>
                            <td><a href="book.php?prodId=1">מלאכים</a></td>
                            <th scope="row"><input type="checkbox" class="form-check-input"></th>
                        </tr>
                    </tbody>
                </table>
            </div> -->
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

</html>
<?php
mysqli_close($connection);
?>