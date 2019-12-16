<?php
$id = 0;
$name = "";
$author = "";
$date = "";
$collection = "";
$category ="";
$color = "#b4dfe5";
$plot = "";
$update = false;
$range = 0;


$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
if($mysqli->connect_error) {
    die("Impossible to look on your shelf: " . $mysqli->connect_error);
}

if(isset($_POST['save'])){
    $name= $_POST['name'];
    $author= $_POST['author'];
    $date= $_POST['date'];
    $collection= $_POST['collection'];
    $plot= $_POST['plot'];
    $category = $_POST['category'];
    $color= $_POST['color'];
    $range = $_POST['range'];

    $mysqli->query("INSERT INTO shelf (name, author, date, collection, plot, category, color, progress)
                    VALUES ('$name', '$author', '$date', '$collection', '$plot', '$category', '$color', '$range')") or
                    die($mysqli->error);
    
    

    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM shelf WHERE id=$id") or die($mysqli->error);
}

if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    
    $bookInHand = $mysqli->query("SELECT * FROM shelf WHERE id=$id") or die($mysqli->error);
    $record = $bookInHand->fetch_array();

    $name = $record['name'];
    $author= $record['author'];
    $date= $record['date'];
    $collection= $record['collection'];
    $plot= $record['plot'];
    $category= $record['category'];
    $color = $record['color'];
    $range = $record['progress'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $date = $_POST['date'];
    $collection = $_POST['collection'];
    $plot = $_POST['plot'];
    $category = $_POST['category'];
    $color = $_POST['color'];
    $range = $_POST['range'];

    $mysqli->query("UPDATE shelf
    SET name='$name', author='$author', date='$date', collection='$collection', plot='$plot', category='$category', color='$color', progress='$range'
    WHERE id=$id") or die($mysqli->error);

    header("location: index.php");

}