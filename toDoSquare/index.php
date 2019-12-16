<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: #8590aa ;
        }
        ::placeholder{
            color: white;
        }
        .container{
            display: grid;
            grid-template-columns: 2fr 4fr 2fr;
            grid-gap: 1em;
        }
        .container > div {
            background-color: #c4dbf6;
            border-radius: 4px;
        }
        input {
            width: 100%;
            padding: 1em 20px;
            margin: 4px 3px;
            box-sizing: border-box;
            border-bottom: 2px solid blue; border-radius: 4px;
            background-color: #e7e3d4;
        }
        input[type=text]:hover {
            background-color: #b4dfe5;
            color: white;
        }
        input[type=text]:focus {
            background-color: #d2fdff;
            border-bottom: white;
            color: white;
        }
        .shelf {
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
            grid-template-rows: 220px;
            grid-gap: 1em;
        }
        .book {
            height: 100%;
            border-radius: 5px;
            background-color: #b4dfe5;
            margin: 0.5em;
            padding: 3px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr 2fr 1fr 3fr 1fr 1fr 1fr;
        }
        .book:nth-child(odd){
            background-color: #d2fdff;
        }
        .book > .collection {
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 2px;
            word-spacing: 5px;
            font-family: 'Arial black';
            font-weight: bold;
            font-size: 20px;
            color: black;
            grid-column: 1 / 4;
            grid-row: 1 / 2;
        }
        .book > .name {
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            word-spacing: 3px;
            font-family: 'Arial';
            font-weight: normal;
            font-size: 16px;
            color: black;
            grid-column: 1 / 4;
            grid-row: 2 / 3;
        }
        .book > .author {
            text-align: left;
            text-transform: capitalize;
            text-decoration: underline;
            letter-spacing: 1px;
            word-spacing: 3px;
            font-family: 'Verdana';
            font-weight: italic;
            font-size: 10px;
            color: black;
            grid-column: 1 / 3;
            grid-row: 3 / 4;
        }
        .book > .plot {
            text-align: justify;
            letter-spacing: 1px;
            word-spacing: 2px;
            font-family: 'Arial';
            font-size: 8px;
            color: black;
            grid-column: 1 / 4;
            grid-row: 4 / 5;
        }
        .book > .date {
            text-align: center;
            font-family: 'Times New Romans';
            font-size: 10px;
            color: black;
            grid-column: 1 / 2;
            grid-row: 5 / 6;
        }
        .book > .delete {
            grid-column : 3 / 4;
            grid-row: 6 / 7;
            justify-self: end;
        }
        .book > .read {
            grid-column : 1 / 2;
            grid-row: 6 / 7;
            justify-self: start;
        }
        .book > .edit {
            grid-column : 2 / 3;
            grid-row: 6 / 7;
            justify-self: center;
        }
        .book > .category {
            text-align: right;
            font-family: 'Verdana';
            font-size: 6px;
            color: black;
            grid-column: 3 / 4;
            grid-row: 3 / 4;
        }
        .book > .progress {
            grid-column: 1 / 4;
            grid-row: 7 / 8;
        }
        progress{
            width: 100%;
            height: 20px;
            border-radius: 3px;
            box-shadow: 0 2px 3px 0;
        }
        .showBook {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 3fr;
        }
        .showBook > #showTitle {
            grid-column: 1 / 4;
            grid-row: 1 / 2;
        }
        .showBook > #showPlot {
            grid-column: 1 / 4;
            grid-row: 3 / 4;
        }
    </style>
</head>
<body>
<?php require_once "process.php" ?>
<?php
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM shelf");
?>

<?php 
    // function bookCounter() {
    //     $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    //     $result = $mysqli->query("SELECT id FROM shelf");
    //     $array = $result->fetch_array();
    //     $quantity = count($array);
    //     return $quantity;
    // }
?>
    
    <div class="container">
        <div class="form">
        <form action="process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="text" name="name" placeholder="Book's name" value="<?php echo $name ?>">
            <input type="text" name="author" placeholder="Author" value="<?php echo $author ?>">
            <input type="date" name="date" placeholder="Publication date" value="<?php echo $date ?>">
            <input type="text" name="collection" placeholder="Collection" value="<?php echo $collection ?>">
            <input type="textarea" name="plot" placeholder="Plot" value="<?php echo $plot ?>">
            <input type="text" name="category" placeholder="Category" value="<?php echo $category ?>">
            <select name="color">
                <option value="#fff" autofocus>White</option>
                <option value="#ffd700">Gold</option>
                <option value="#c0c0c0">Silver</option>
                <option value="#f78888">Pink</option>
                <option value="#f3d250">Yellow</option>
                <option value="#ececec">Grigio</option>
                <option value="#90ccf4">Azzurro</option>
                <option value="#5da2d5">Blu</option>
                <option value="#f78888">Pink</option>
                <option value="#000">Black</option>
            </select>
            <input type="range" name="range" min="0" max="100" value="1">
            <hr>
            
            <?php if(!$update): ?>
            <button type="submit" name="save">Put on the shelf.</button>
            <?php else: ?>
            <button type="submit" name="update">Update.</button>
            <?php endif; ?>

        </form>
        </div>
        <div class="shelf">
            <?php while($book = $result->fetch_assoc()): ?>
                <div class="book" style="background-color:<?php echo $book['color'] ?>">
                    <div class="collection"><?php echo $book['collection']; ?></div>
                    <div class="name"><?php echo $book['name']; ?></div>
                    <div class="author"><?php echo $book['author']; ?></div>
                    <div class="category"><?php echo $book['category']; ?></div>
                    <div class="plot"><?php echo $book['plot']; ?></div>
                    <div class="date"><?php echo $book['date']; ?></div>
                    <div class="delete"><a href="index.php?delete=<?=$book['id']?>">Delete</a></div>
                    <div class="edit"><a href="index.php?edit=<?=$book['id']?>">Edit</a></div>
                    <div class="read"><a href="index.php?read=<?=$book['id']?>">Read</a></div>
                    <div class="progress"><progress max="100" value="<?php echo $book['progress'] ?>"></progress></div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <div class="showBook">
        <?php
        if(isset($_GET['read'])){
            $id = $_GET['read'];
            $onSpot = $mysqli->query("SELECT * FROM shelf WHERE id=$id") or die($mysqli->error);
        while($show = $onSpot->fetch_assoc()): ?>
        <p id="showTitle">Title: <?php echo $show['name']; ?></p>
        <p>Author: <?php echo $show['author']; ?></p>
        <p>Collection: <?php echo $show['collection']; ?></p>
        <p>Publication date: <?php echo $show['date']; ?></p>
        <p class="showPlot">Plot: <?php echo $show['plot']; ?></p>
        <?php endwhile; }?>
        </div>
    </div>
</body>
<!--
da implementare:
-contatore libri
-svuota shelf
-grafica decente
-messaggistica
-sort
-no collection -> titolo
-fix book size

-->
</html>