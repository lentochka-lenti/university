<?php
function connect_to_mysql(){
    $servername = 'localhost';
    $username = 'root';
    $password = '/hGj6$Q3';

    $db = new mysqli($servername, $username, $password, 'university');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $db->set_charset("utf8");
    return $db;
}
?>

