<?php
include_once('conn_db.php');
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 5.4.2015 г.
 * Time: 17:39 ч.
 */
if($_POST){
    $user_vote_type= $_POST["vote"];

    $unique_content_id = filter_var(trim($_POST["unique_id"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

    //check if its an ajax request
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die("not ajaj");
    }

    switch($user_vote_type){
        ##### user liked the comment ####
        case 'up';

            $update_points_row = $conn_db ->prepare("UPDATE pic_comments SET points = points+1
                                                  WHERE pic_comm_id='$unique_content_id' ");
            $update_points_row->execute();
            $get_points_to_show = $conn_db -> query("SELECT points FROM pic_comments WHERE pic_comm_id = '$unique_content_id'");
            $points_var = $get_points_to_show->fetch();
            echo($points_var['points']);
            break;


        #### user disliked comment ####
        case 'down';
            $update_points_row = $conn_db ->prepare("UPDATE pic_comments SET points = points-1
                                                  WHERE pic_comm_id = '$unique_content_id'");
            $update_points_row->execute();
            $get_points_to_show = $conn_db -> query("SELECT points FROM pic_comments WHERE pic_comm_id = '$unique_content_id'");
            $points_var = $get_points_to_show->fetch();
            echo($points_var['points']);
            break;

        ##### user wants to fetch points #####
        case 'fetch';
            $get_points = $conn_db->query("SELECT points FROM pic_comments WHERE pic_comm_id = $unique_content_id LIMIT 1");
            $point_row = $get_points->fetch();
            //build array for php json
            $send_response = array('point'=>$point_row['points']);
            echo json_encode($send_response); //display json encoded values

            break;

    }
}