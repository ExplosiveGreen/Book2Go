<?php
include "db.php";
session_start();

if (empty($_SESSION["user_id"])) {
    header('Location: login.php');
}
$data = [
    "book_id" => -1,
    "book_name" => "",
    "author" => "",
    "abstract" => "",
    "translate" => "",
    "publisher" => "",
    "publish_date" => "",
    "category_id" => 1,
    "condition_id" => 1,
    "img" => "images/image-placeholder-1.png"
];
if(!empty($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
    $query = "SELECT * FROM tbl_218_books WHERE book_id='$book_id'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("DB query failed.");
    }
    $data = mysqli_fetch_array($result);
    mysqli_free_result($result);
}
if(isset($_POST["condition"]) && !empty($_POST["condition"] > 0)) {
    echo var_dump($_POST);
    $book_id = $_POST["book_id"] || $data['book_id'];
    $book_name = $_POST["bookName"] || $data['book_name'];
    $author = $_POST["authorName"] || $data['author'];
    $abstract = $_POST["abstract"] || $data['abstract'];
    $translate = $_POST["translatorName"] || $data['translate'];
    $publisher = $_POST["publishName"] || $data['publisher'];
    $publish_date = $_POST["publicationDate"] || $data['publish_date'];
    $category_id = $_POST["category"] || $data['category_id'];
    $condition_id = $_POST["condition"] || $data['condition_id'];
    $img = $_POST["bookImage"] || $data['img'];
    if($book_id > 0){
        $query = "UPDATE TABLE tbl_218_books SET book_name='$book_name', author='$author', abstract='$abstract', translate='$translate', publisher='$publisher', publish_date='$publish_date', category_id='$category_id', condition_id='$condition_id',img='$img' WHERE book_id='$book_id'";
    }else{
        $query = "INSERT INTO tbl_218_books (book_name, author, abstract, translate, publisher, publish_date, category_id, condition_id,img) VALUES ('$book_name','$author','$abstract','$translate','$publisher', '$publish_date', '$category_id', '$condition_id','$img')";
    }
    echo $query;
    $result = mysqli_query($connection, $query);
    if($result) {
      header("Location: index.php");
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
                <a href="#">הוספת ספר</a>&#60;
                <a href="index.php" class="noLink ">עמוד הבית</a>
            </nav>
            <h1 class="text-center mb-5">הוספת ספר</h1>
            <main>
                <form id="bookForm" action="#" method="POST" autocomplete="on">
                    <input type="hidden" name="book_id" value="<?php echo $data["book_id"] ?>">
                    <div id='upperAddSection' class="d-flex flex-column justify-content-center gap-4">
                        <div id="abstractArea">
                            <textarea class="form-control textRight" name="abstract" placeholder="הכנס תקציר כאן"
                                <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                ><?php echo $data["abstract"]?></textarea>
                            &nbsp;
                            <label for="abstract" class="form-label">:תקציר</label>
                        </div>
                        <!-- <img id="bookPlaceholder" src="images/image-placeholder-1.png" alt="bookPlaceholder"> -->
                        <div class="d-flex flex-column">
                            <input type="file" id="bookImage" name="bookImage" accept="image/*" value="<?php echo $data['img']?>" 
                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                            >
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
                                        <lable for="publishName" class="form-label">:הוצאה</lable>
                                        <input type="text" class="form-control textRight" name="publishName"
                                            value="<?php echo $data["publisher"]?>" placeholder="שם הוצאה" 
                                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                            >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label for="bookName" class="form-label">:שם הספר</label>
                                        <input type="text" class="form-control textRight" name="bookName" value="<?php echo $data["book_name"]?>"
                                            placeholder="שם הספר" 
                                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class='row'>
                                <div class="col">
                                    <div class="row-auto">
                                        <lable for="publicationDate" class="form-label">:תאריך
                                            הוצאה</lable>
                                        <input type="text" class="form-control textRight"
                                            name="publicationDate" value="<?php echo $data["publish_date"]?>" placeholder="הכנס חודש ושנת הוצאה" 
                                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label for="authorName" class="form-label">:שם
                                            הסופר</label>
                                        <input type="text" class="form-control textRight" name="authorName"
                                            value="<?php echo $data["author"]?>" placeholder="שם הסופר" 
                                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                            <div class="col">
                                    <div class="row-auto">
                                        <label for="translatorName" class="form-label">:שם
                                            המתרגם</label>
                                        <input type="text" class="form-control textRight"
                                            name="translatorName" value="<?php echo $data["translate"]?>" placeholder="שם המתרגם"
                                            <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row-auto">
                                        <label class="form-label mt-1">:קטגוריה</label>
                                        <select class="form-select" aria-label="Default select example" name="category"
                                        <?php if($_SESSION['user_type']=='reader') echo 'disabled'; else echo 'required';?>
                                        >
                                            <option selected value="-1">בחר קטגוריה</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class='row'>
                            <div class="col">
                                <div class="row-auto">
                                    <label class="form-label mt-1">:מצב</label>
                                    <select class="form-select" aria-label="Default select example" bs-role="<?php echo $_SESSION['user_type']?>" name="condition"
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