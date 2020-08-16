<?php
// Подключаем файл с функциями
include("common.php");
// Функция для создания новой сессии или открытия предыдущей сессии.
session_start();

// Проверяем авторизированы ли мы
if (isset($_SESSION['login'])) {
    // Проверяем пришли ли вместе с запросом необходимые данные.
    if(isset($_SESSION['user_id']) && isset($_GET['lesson_id'])) {
        // Если все что нам нужно у нас есть. Сначала подключаемся к базе данных.
        $db = connect_to_mysql();
        // Формирум запрос с участием данных сессии ($_SESSION['user_id']) и данных пришедших в запросе ($_GET['lesson_id'])
        $sql="INSERT INTO records(user_id, lessons_id) VALUES(".$_SESSION['user_id']." ,".$_GET['lesson_id'].")";
        // Выполняем запрос
        $db->query($sql);
        // После выполнения зароса формируем перенаправление на ту же страницу от куда пршли.
        header("Status: 301 Moved Permanently");
        header("Location:lessons_client.php");
    }
} else {
    // В случае если пользоваетель не авторизирован => перенаправляем на страницу входа с ошибокй "Вы не авторизованы!"
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>