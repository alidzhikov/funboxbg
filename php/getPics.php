<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 9.4.2015 г.
 * Time: 17:18 ч.
 */

if($_POST){
    $cat_id = $_POST['cat_id'];
    //$selectCat = "SELECT * FROM pics WHERE cat_id = $cat_id ORDER BY pic_id DESC";
    //$get_pics_sql = $conn_db->query($selectCat);
    echo $cat_id;
}