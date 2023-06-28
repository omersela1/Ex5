<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Coda&family=Moirai+One&display=swap" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="getcategories.js"></script>
        <script src="getbooks.js"></script>
</head>
<body>
    <div id="display"></div>
</body>
</html>




<?php
include 'config.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
    die("Could not connect to database.");
}

$bookId = $_GET['id'];
$query = 'SELECT * from tbl_62_books WHERE book_id="' . $bookId . '";';
$result = mysqli_query($connection, $query);

if (!($result))
echo json_encode(['error' => 'Database error. Table does not exist.']);

else {
$booksHtml = ''; 
$row = mysqli_fetch_assoc($result);  
$booksHtml .= '<div class="displayObject"><img src="' . $row['imageUrl1'] . '"><img src="' . $row['imageUrl2'] . '"></div><a href="https://www.google.com/search?q=' . $row['name'] . '%20book">' . $row['name'] . '</a><br><a href="https://www.google.com/search?q=' . $row['author'] . '">' .$row['author'] . '</a><p>' . $row['description'] . '</p><ul><li>Price: ' . $row['price'] . '</li><li>Rating: ' . $row['rating'] . '</li></ul></div>';
    
echo '<script>document.getElementById("display").innerHTML = \'' . $booksHtml . '\';</script>';
}

mysqli_close($connection);
?>


