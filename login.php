<?php
session_start();
try {
    $server_name = "localhost";
    $server_user = "root";
    $conn_db = new PDO("mysql:host=$server_name;dbname=funbox-bg", $server_user);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e ->getMessage();
}

$error = "Влязохте успешно!";
if($_SESSION['logged'] !== true){
    if(isset($_POST['login'])){
        $username= trim(htmlentities($_POST['username']));
        $password= trim(htmlentities($_POST['pass']));
        if(strlen($username)<3 && strlen($password)<3){
            $error = "Грешно име или парола";
            exit;
        }
        $selectUsers = "SELECT user_id,user_name,password FROM users WHERE user_name='$username' AND password = '$password'";
        $login_check = $conn_db->query($selectUsers);
        $matches = $login_check->fetch();
        if($matches['user_name'] == $username && $matches['password'] == $password){
            $session_state = true;
            $_SESSION['logged'] = $session_state;
            $_SESSION['user_name'] = $username;
            $_SESSION['user_id'] = $matches['user_id'];
            echo $error;
        }else{
            $error = "Грешно име или парола";
            echo $error;
        }
    }
}
header('Location: index.php');
?>