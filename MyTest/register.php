<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/index.css"
</head>
<body>
<!-- Форма регистрации -->

<form  action="vendor/signup.php" method="post" enctype="multipart/form-data">
    <label>ФИО</label>
    <input type="text" name="full_name" placeholder="Введите свое полное имя">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите логин">
    <label>Email</label>
    <input type="email" name="email" placeholder="Введите адресс своей почты">
    <!--<label>Изображение профиля</label>
    <input type="file" name="avatar">-->
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Повторите пароль">
    <button type="submit">Зарегестрироваться</button>
    <p>
        Уже есть аккаунт? - <a href="index.php" > Авторизируйтесь!</a>
    </p>
    <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> '  . $_SESSION['message'] .  ' </p>';
        }
        unset($_SESSION['message']);
    ?>
</form>
</body>
</html>