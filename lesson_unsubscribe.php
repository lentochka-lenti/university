<?php
include("common.php");
session_start();
if (isset($_SESSION['login'])) {
        $db = connect_to_mysql();
        $db->query("DELETE FROM records WHERE user_id=".$_SESSION['user_id']." and lessons_id=".$_GET['lesson_id']." " );
        header("Status: 301 Moved Permanently");
        header("Location:lessons_client.php");
        exit;
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>