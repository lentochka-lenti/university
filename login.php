<?php
include("common.php");
session_start();
if (isset($_POST['login']) && !empty($_POST['password'])) {
    $isAdmin = false;
    $isClient = false;
    if($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        $isAdmin = true;
        $isUser = false;
    }
    // Check users by users table.
    $db = connect_to_mysql();
    $results = $db->query('SELECT * FROM users');
    while ($row = $results->fetch_array()) {
        if($_POST['login'] == $row['login'] && $_POST['password'] == $row['password']) {
            $isAdmin = false;
            $isUser = true;
            $_SESSION['FIO'] = $row['FIO'];
            $_SESSION['user_id']  = $row['id'];
        }
    }
                
    if($isAdmin || $isUser) {
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

