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
    // Подключение к базе данных
    $db = connect_to_mysql();
    // Выполнение запроса на получение данных о пользователях
    $results = $db->query('SELECT * FROM users');
    // Проходим по списку зарегистррированных пользователй
    while ($row = $results->fetch_array()) {
        // Проверяем правильно ли введены данные для авторизации
        if($_POST['login'] == $row['login'] && $_POST['password'] == $row['password']) {
            // Если пользователь ввел правильные данные для авторизации то:
            // 1 Запомниаем ФИО пользователя в сессии для вывода на каждой странице.
            // 2 Запоминаем id пользователя для выполнения запросов связаннных с текущим пользователем
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

