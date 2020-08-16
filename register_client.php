<?php
include("common.php");
session_start();

if(isset($_POST['FIO']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password'])) {
    $db = connect_to_mysql();
    $db->query("INSERT INTO users(FIO, email, login, password) VALUES('".$_POST['FIO']."', '".$_POST['email']."', '".$_POST['login']."', '".$_POST['password']."')");
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы зарегистрированны! Теперь пройдите авторизацию.");
    exit;
}
?>