<!DOCTYPE html>
<html>
<?php
try {
    $server_name = "localhost";
    $server_user = "root";
    $conn_db = new PDO("mysql:host=$server_name;dbname=funbox-bg", $server_user);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e ->getMessage();
}
mb_internal_encoding("UTF-8");
$conn_db->exec("SET NAMES UTF8");
?>
<head lang="en">
    <script src="includes/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="includes/javasc.js"></script>
    <meta charset="UTF-8">
    <LINK href="style.css" rel="stylesheet" type="text/css">
    <title>funBOX - Най-големия бг сайт за забавление</title>
</head>
<body>

<header>
    <a href="index.php"><div id="logo">
            <p>Най-смешния бг сайт!</p>
        </div></a>
    <menu>
        <ol id="menu-selected">
            <li><a href="pics.php"><span class="li-items">КАРТИНКИ</span></a></li>
            <li><a href="clips.php"><span>КЛИПЧЕТА</span></a></li>
            <li><a href="vic.php"><span>ВИЦОВЕ</span></a></li>
            <li><a href="curious.php"><span>ЛЮБОПИТНО</span></a></li>
            <li><a href="story.php"><span>ИСТОРИИ</span></a></li>
        </ol>
        <span class="upload-button"><a href="upload_img.php">ДОБАВИ СМЕШКА</a></span>
        <div id="search"><form method="GET"><input type="text" name="searchField" placeholder="Търсене"/>
                <input type="submit" name="search" value="&nbsp;"> </form></div>

    </menu>
</header>

<img class="advertisement" src="imgs/advert2.jpg"/>
<aside>