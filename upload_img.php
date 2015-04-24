<?php include_once('includes/header_check.php');?>


    </aside>
<section>
    <?php if($_SESSION['logged'] === true) {
        $select_categories = "SELECT cat_id,cat_name FROM categories";
        $execute_sql = $conn_db->query($select_categories);
        $conn_db->exec("SET NAMES UTF8");
        if(isset($_POST['imgSubmit'])){
            //set some vars
            $target_dir = "upl-imgs/";
            $target_name = basename($_FILES["image"]['name']);
            $target_file = $target_dir . $target_name;
            $imgFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $uploadOk = 0;
            $imgCheck = getimagesize($_FILES['image']['tmp_name']);
            $imgName = trim(htmlentities($_POST['imgName']));
            $user_id = $_SESSION['user_id'];
            if($imgCheck !== false){
                echo "File is an image - " . $imgCheck["mime"] . ".";
                $uploadOk= 1;
            }else{
                $error[] = 'Моля изберете валидна картинка.';
                $uploadOk = 0;
            }
            if(file_exists($target_file)){
                $error[] =  'Файлът вече съществува!';
                $uploadOk =0;
            }
            if($_FILES['image']['size'] > 3000000){
                echo 'Файлът трябва да бъде не по-голям от 3MB';
                $uploadOk =0;
            }
            if($imgFileType != 'jpg' && $imgFileType != 'png' && $imgFileType != 'gif' && $imgFileType != 'jpeg'){
                echo 'Моля изберете валидна картинка.';
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if($uploadOk == 0){
                echo 'Качването неуспешно';
            }else{
                if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                    echo 'Снимката ' . basename($_FILES['image']['name']) . ' е успешно качен!';
                    $cat_id = $_POST['category'];
                    $dateVal = date("Y/m/d H:i:s");
                    $insert_pic_data = "INSERT INTO pics (pic_name,pic_title,date_added,user_id,cat_id)
                                        VALUES (:target_name,:imgName,:date_added,:user_id,:cat_id)";
                    $prepare_insert = $conn_db->prepare($insert_pic_data);
                    $prepare_insert->bindParam(':target_name',$target_name);
                    $prepare_insert->bindParam(':imgName',$imgName);
                    $prepare_insert->bindParam(':user_id',$user_id);
                    $prepare_insert->bindParam(':cat_id',$cat_id);
                    $prepare_insert->bindParam(':date_added',$dateVal);
                    $prepare_insert->execute();
                }else{
                    echo 'Качването неуспешно2';
                }
            }
        }

        ?><div id="upload" class="uploadImg">
            <h2>Качи смешна картинка:</h2>

            <p class="small">Картинката трябва да е не по-голяма от 3МБ.Позволените формати са JPG/PNG/GIF.</p>

            <form action="" method="POST" enctype="multipart/form-data">
                <input class="browse-upl" type="file" name="image">
                <label for="name">Заглавие: </label>
                <input id="name" type="text" name="imgName">
                <label><p>Изберете категория:</p></label>
                <?php foreach($execute_sql as $category){
                    echo trim($category['cat_name']); ?>
                    <input type="radio" name="category" value="<?php echo trim($category['cat_id']); ?>"/>
                <?php }?>
                <input class="browse-upl" type="submit" name="imgSubmit" value="Добави Смешка"/>
            </form>
        </div>
    <?php }else{?>
        <div id="login-form">
            <p>Трябва да сте влезли за да добавяте смешки.</p>
        <h3>Вход във funbox</h3>
        <form method="POST" action="login.php">
            <label for="user">Потребител: </label>
            <input type="text" name="username" id="user"/>
            <label for="pass">Парола: </label>
            <input type="password" name="pass" id="pass"/>
            <input type="submit" name="login" value="Вход"/>
        </form>
        <a href="#">(Забравена парола)</a>
        <a href="registration.php">(Нова Регистрация)</a>
    </div>
    <?php
    }
    ?>
</section>


<div style="clear:both;"></div>
    <img class="advertisement-right" src="imgs/adver2.jpg"/>
<?php include_once('includes/footer.php'); ?>