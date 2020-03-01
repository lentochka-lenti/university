<?php
session_start();
if (isset($_SESSION['login'])) {
        $db = new SQLite3('db.db');
        $db->exec("DELETE FROM lesson WHERE id = ".$_GET['lesson_id']." ");
        header("Status: 301 Moved Permanently");
        header("Location:lessons_admin.php");
        exit;
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>