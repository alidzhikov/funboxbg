<?php

try {
    $server_name = "localhost";
    $server_user = "root";
    $conn_db = new PDO("mysql:host=$server_name;dbname=funbox-bg", $server_user);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e ->getMessage();
}
if($_SESSION['logged'] !== true){
    header('Location:index.php');
    exit;
}
mb_internal_encoding("UTF-8");
$conn_db->exec("SET NAMES UTF8");


if($_SESSION['logged'] === true){
    if(isset($_POST['sub_comment'])){
        $comment = trim(addslashes(htmlentities($_POST['comment'])));
        $add_comment = $conn_db->prepare("INSERT INTO pic_comments(pic_comment,user_id,pic_id)
                                                  VALUES(:pic_comment,:user_id,:pic_id)");
        $add_comment->bindParam(':pic_comment',$comment);
        $add_comment->bindParam(':user_id',$_SESSION['user_id']);
        $add_comment->bindParam(':pic_id',$pic['pic_id']);
        if ($add_comment->execute()) {
            echo 'Komentarit e kachen';

        }else{
            echo "грешкаа";
        }
        header('Location: pics.php');
    }
}else{
    echo "Трябва да сте влезли за да коментирате";
}
?>