
<?php
$title = "index";
include_once('includes/header_check.php');

$select_categories = "SELECT cat_id,cat_name FROM categories";
$execute_sql = $conn_db->query($select_categories);
$conn_db->exec("SET NAMES UTF8");

$get_pics = "SELECT * FROM pics ORDER BY pic_id DESC";
$get_pics_cat = "";
$get_pics_sql = $conn_db->query($get_pics);
$comment_error[] ="";
include_once('php/getPics.php');
?>

        <ol id="categories"><h4>Изберете категория</h4>

            <?php foreach ($execute_sql as $categories) {
                echo '<li id=' . $categories['cat_id'] . '>'. $categories['cat_name'] . '</li>';
            } ?>

        </ol>
        <img src="imgs/advert-aside.png" alt="add" />
    </aside>
    <section>

    <?php
    foreach ($get_pics_sql as $pic) {
        $get_user = $conn_db->query("SELECT user_name,user_id
                                FROM users
                                WHERE user_id=" . $pic['user_id'] . "");
        $user_info = $get_user->fetch();
        ?>

        <div class="pic">
            <div class="left_pic_content">
                <h3><?php echo $pic['pic_title']; ?></h3>

                <p class="small"><?php echo $pic['date_added'] . ' от <a href="#">' . $user_info['user_name'] . '</a>'; ?></p>
                <img src="upl-imgs/<?php echo $pic['pic_name']; ?>"/>
                <!-- vote buttons -->
                <div class="pic-votes-count">124 т.</div>
                <form class="votes-form">
                    <ul class="pic-votes-buttons">
                        <li><input type="submit" name="add_vote" value=""/></li>
                        <li><input type="submit" name="remove_vote" value=""/></li>
                    </ul>
                </form>

            </div>
            <div class="right_pic_content">
            <!--display comments-->
            <form method="post" class="comment_pics">
                <textarea cols="25" rows="2" name="comment" onclick="show_send_button(this.parentNode)" placeholder="Добави коментар"></textarea>
                <input type="hidden" name="pic_id" value="<?php echo $pic['pic_id']; ?>"/>
                <input type="submit" name="sub_comment" class="sub_comment"/>
            </form>
            <?php
            $comments_sql = "SELECT pic_comments.pic_comm_id,pic_comments.pic_comment,pic_comments.pic_comm_date,
pic_comments.pic_id,users.user_name,users.user_img
                                    FROM pic_comments
                                    INNER JOIN users
                                    ON users.user_id=pic_comments.user_id
                                    WHERE pic_id = ".$pic['pic_id']."";
            $select_comments = $conn_db->query($comments_sql);
            echo '<ul class="shown_comments">';
            foreach ($select_comments as $display_comments) {
                    ?> <li><img class="user_comments_img" src="imgs/<?php echo $display_comments['user_img']; ?>"/>
                        <span class="comm_date"> <?php echo $display_comments['pic_comm_date'].'</span>';?>
                            <a href="#" class="user_name_comments"><?php echo $display_comments['user_name'] . ':'; ?></a>
                                <span class="the_comment"><?php echo trim($display_comments['pic_comment']) . '</span>'; ?>
                                    <!-- vote buttons -->
                                        <ul class="comment-votes-buttons" id="<?php echo $display_comments['pic_comm_id']; ?>">
                                            <li class="point_up"></li>
                                            <li class="point_down"></li>
                                            <li  id="<?php echo $display_comments['pic_comm_id']; ?>" class="show_points"><p></p></li>
                                        </ul>
                        </li><?php
            }
            echo '</ul></div></div>';
    }

    if($_SESSION['logged'] === true){
        if(isset($_POST['sub_comment'])){
            $comment = trim(addslashes(htmlentities($_POST['comment'])));
            $pic_id_for_comm = $_POST['pic_id'];
            $add_comment = $conn_db->prepare("INSERT INTO pic_comments(pic_comment,user_id,pic_id)
                                                  VALUES(:pic_comment,:user_id,:pic_id)");
            $add_comment->bindParam(':pic_comment',$comment);
            $add_comment->bindParam(':user_id',$_SESSION['user_id']);
            $add_comment->bindParam(':pic_id',$pic_id_for_comm);
            if (strlen($comment) < 4) {
                echo 'trqbva da ima komentar ve kalif';
            }else{
                if ($add_comment->execute() == false) {
                    echo "грешкаа";
                }
            }

        }else{
            echo "Трябва да сте влезли за да коментирате";
        }
    }
    ?>

    </section>
<script src="Js/pics_common_js.js"></script>
<script src="Js/comment_votes.js"></script>


<?php
    include_once('includes/footer.php');
    ?>