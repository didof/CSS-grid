<?php
$id= 0;
$name= "";
$author= "";
$date= "";
$collection= "";
$plot= "";
$update = false;

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

    $mysqli->query("INSERT INTO shelf (name, author, date, collection, plot)
                    VALUES ('$name', '$author', '$date', '$collection', '$plot')") or
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
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $author= $_POST['author'];
    $date= $_POST['date'];
    $collection= $_POST['collection'];
    $plot= $_POST['plot'];

    $mysqli->query("UPDATE shelf
    SET name='$name', author='$author', date='$date', collection='$collection', plot='$plot'
    WHERE id=$id") or die($mysqli->error);

    header("location: index.php");

}