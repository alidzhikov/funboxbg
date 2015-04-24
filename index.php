<?php
$title = "index";
include_once('includes/header_check.php'); ?>


    <div id="login-form">
        <h3>Вход във fun<span class="box-green"">box</span></h3>
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
</aside>
<section>

</section>

<?php include_once('includes/footer.php'); ?>
