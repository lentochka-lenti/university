<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="login-wrap">
        <form action="login.php" method="post">
            <p class="error-message"><?php echo $_GET['error'];?></p>
            <input class="site-control" type="text" name="login" value="" placeholder="Логин">
            <input class="site-control" type="password" name="password" value="" placeholder="Пароль">
            <div class="form-btn-wrap">
                <button class="site-btn" type="submit">Войти</button>
            </div>
        <form>
    </div>
</body>
</html>