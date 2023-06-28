<!DOCTYPE html>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Coda&family=Moirai+One&display=swap" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="getcategories.js"></script>
    </head>

    <body>
        <h1>Books & Pooks</h1>
        <div id="wrapper">
            <div id="categoryList">
            </div>
            <div id="bookList">
            </div>
        </div>
    </body>
</html>





<?php
include 'config.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
    die("Could not connect to database.");
}




if((!(isset($_GET['categoryId']))))
    $categoryId = "All%20Books";
    else
    $categoryId = $_GET['categoryId'];

if ($categoryId == "All%20Books")
    $query = 'SELECT * from tbl_62_books;';
    else {
        $categoryId = mysqli_real_escape_string($connection, $categoryId);
         $query = 'SELECT * from tbl_62_books WHERE category="' . $categoryId . '";';
    }
    $result = mysqli_query($connection, $query);

    if (!($result))
        echo json_encode(['error' => 'Database error. Table does not exist.']);

        else {
        $booksHtml = ''; 
            
        while ($row = mysqli_fetch_assoc($result)) {
            $booksHtml .= '<div class="bookObject"><img src="' . $row['imageUrl1'] . '"><a href="book.php?id=' . $row['book_id'] . '">' . $row['name'] . '</a></div>';
            }
            
        echo '<script>document.getElementById("bookList").innerHTML = \'' . $booksHtml . '\';</script>';
        }

mysqli_close($connection);
?>




