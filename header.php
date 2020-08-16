<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Университет</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<header>
    Университет
</header>
<p> Пользователь: <b><?php session_start(); echo $_SESSION['FIO']; ?></b></p>
