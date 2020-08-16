<?php
session_start();
$_SESSION['FIO'] = "Новый";
include("common.php");

?>

<?php include("header.php"); ?>

<div class="lesson-wrap">
    <a href="index.php">Назад</a>
        <h2>Зарегистрировать нового пользователя</h2>
    <form action="register_client.php" method="post">
        <div class="form-group">
            <input type="text" name="FIO" class="site-control"  placeholder="Фаммилия Имя Отчество">
        </div>
        <div class="form-group">
            <input type="text" name="email" class="site-control" placeholder="Электронная почта">
        </div>
        <div class="form-group">
            <input type="text" name="login" class="site-control" placeholder="Логин">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="site-control" placeholder="Пароль">
        </div>
        <div class="form-btn-wrap">
            <button class="site-btn" type="submit">Сохранить</button>
        </div>
    </form>
</div>
<?php include("footer.php") ?>


