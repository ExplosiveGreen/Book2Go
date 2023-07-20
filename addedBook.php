<!DOCTYPE html>
    <head>
        <title>added book</title>
    </head>
    <body>
        <h1>The Book Has Added!</h1>
        <br>
        <br>
        <h3>
            The abstract is: <?php echo $_GET["abstract"]; ?> <br>
            The name of the book is: <?php echo $_GET["bookName"]; ?> <br>
            The author name is: <?php echo $_GET["authorName"]; ?> <br>
            The translator name is: <?php echo $_GET["translatorName"]; ?> <br>
            The publish name is: <?php echo $_GET["publishName"]; ?> <br>
            The publication date is: <?php echo $_GET["publicationDate"]; ?> <br>
            The book category is: <?php echo $_GET["category"]; ?> <br>
            The state of the book is: <?php echo $_GET["state"]; ?>
        </h3>
    </body>
</html>