<?php
if (isset($_POST['login']) && !empty($_POST['password'])) {
    $isAdmin = false;
    $isClient = false;
    if($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        $isAdmin = true;
        $isUser = false;
    }
    if($_POST['login'] == 'user' && $_POST['password'] == 'user') {
        $isAdmin = false;
        $isUser = true;
    }
    if($isAdmin || $isUser) {
        session_start();
        $_SESSION['login'] = 1;
        if($isUser) {
            header("Status: 301 Moved Permanently");
            header("Location:lessons_client.php");
            exit;
        }
        if($isAdmin) {
            header("Status: 301 Moved Permanently");
            header("Location:lessons_admin.php");
            exit;
        }
    } else {
        header("Status: 301 Moved Permanently");
        header("Location:index.php?error=Данный пользователь не сущствует!");
        exit;
    }
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Заполните поля!");
    exit;
}

