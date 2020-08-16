<?php
include("common.php");
session_start();

if (isset($_SESSION['login'])) {
    if(isset($_SESSION['user_id']) && isset($_GET['lesson_id'])) {
        $db = connect_to_mysql();
        $sql="INSERT INTO records(user_id, lessons_id) VALUES(".$_SESSION['user_id']." ,".$_GET['lesson_id'].")";
        echo $sql;
        $db->query($sql);
        header("Status: 301 Moved Permanently");
        header("Location:lessons_client.php");
    }
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>