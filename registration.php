<?php
$title = "registration";
include_once('includes/header_check.php');?>
    </aside>
<?php
if($_SESSION['logged'] === true){
    header('Location: index.php');
}else{
    if(isset($_POST['submit'])){
        $error[]="";
        $user_name = htmlentities(trim($_POST['user_name']));
        if(strlen($user_name) > 50 || strlen($user_name) < 3){
            $error[] = "Името е твърде дълго или твърде късо";
        }
        if (trim($_POST['pass']) === trim($_POST['pass_again'])) {
            $password = trim($_POST['pass']);
            if (strlen($password) > 50 || strlen($password) <= 5) {
                $error[] = "Паролата трябва да съдържа поне 6 символа";
            }
        }else{
            $error[] = "Паролите не съвпадат";
        }
        $email = htmlentities(trim($_POST['email']));
        $register = $conn_db ->prepare("INSERT INTO users(user_name,password,email)
                                        VALUES(:user_name,:password,:email)");
        $register->bindParam(':user_name',$user_name);
        $register->bindParam(':password',$password);
        $register->bindParam(':email',$email);
        $register->execute();
        if(empty($error)){

        }else{
            foreach ($error as $msg) {
                echo $msg . '<br />';
            }
        }
    }

    ?>
    <section>
        <form id="registration-form" method="post">
            <label>Име</label>
            <input type="text" name="user_name"/>
            <label>Парола</label>
            <input type="password" name="pass"/>
            <label>Повтори паролата</label>
            <input type="password" name="pass_again"/>
            <label>Имейл адрес</label>
            <input type="text" name="email"/>
            <input type="submit" name="submit"/>
        </form>
    </section>
<?php }
include_once('includes/footer.php'); ?>