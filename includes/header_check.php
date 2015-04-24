
<?php
session_start();
if(isset($_SESSION['logged'])){
    if($_SESSION['logged'] === true){
        include_once('header_logged.php');
    }else{
        include_once('header.php');
    }
}else{
    $_SESSION['logged'] = false;
    include_once('header.php');
}
?>