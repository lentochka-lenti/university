<?php
session_start();
if (isset($_SESSION['login'])) {
    if(isset($_POST['subject']) && isset($_POST['time'])  && isset($_POST['room'])) {
        $db = new SQLite3('db.db');
        if((int)$_POST['lesson_id'] == 0) {
            $db->exec("INSERT INTO lesson(subject, `time`, room) VALUES('".$_POST['subject']."', '".$_POST['time']."', '".$_POST['room']."')");
            header("Status: 301 Moved Permanently");
            header("Location:lessons_admin.php");
            exit;
        } else {
            $db->exec("UPDATE lesson SET subject = '".$_POST['subject']."',  `time` = '".$_POST['time']."', room = '".$_POST['room']."' WHERE id = ".$_POST['lesson_id']." ");
            header("Status: 301 Moved Permanently");
            header("Location:lessons_admin.php");
            exit;
        }
    }
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>