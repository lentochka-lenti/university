<?php
include("common.php");
session_start();
if (isset($_SESSION['login'])) {
        $db = connect_to_mysql();
        $db->query("DELETE FROM lessons WHERE id = ".$_GET['lesson_id']." ");
        header("Status: 301 Moved Permanently");
        header("Location:lessons_admin.php");
        exit;
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>