<?php
$title = "index";
include_once('includes/header_check.php');
$select_categories = "SELECT cat_id,cat_name FROM categories";
$execute_sql = $conn_db->query($select_categories);
$conn_db->exec("SET NAMES UTF8");

$get_pics = "SELECT * FROM pics ORDER BY pic_id DESC";
$get_pics_sql = $conn_db->query($get_pics);
$comment_error[] ="";
?>
<ul id="categories"><h4>Изберете категория</h4>
    <?php foreach ($execute_sql as $categories) {
        echo '<li>' . $categories['cat_name'] . '</li>';
    } ?>
</ul>
<img src="imgs/advert-aside.png" alt="add" />
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam faucibus
sit amet massa a consequat. Aenean ullamcorper mauris eu felis tincidunt congue.
Pellentesque ut egestas massa. Pellentesque gravida dui rutrum, luctus massa ac, u\
llamcorper sapien. Nunc auctor ut est eget sagittis. Pellentesque magna tellus, pharetra
in porttitor at, eleifend vulputate ex. Pellentesque nec sapien lorem. In molestie leo in risus imperdiet,
vel rhoncus mi cursus. Donec nec magna pellentesque orci facilisis aliquet id sed lacus. Etiam dignissim,
neque ut placerat vestibulum, nunc urna imperdiet purus, id blandit orci nisi vel tellus. Fusce ipsum nibh,
mattis vitae bibendum sit amet, sollicitudin a nulla. Integer elementum dui eget nunc consequat, sit amet viverra
iam vulputate. Nunc interdum ultrices arcu ac dapibus.</p>
</aside>

<section>
</section>
<?php include_once('includes/footer.php'); ?>