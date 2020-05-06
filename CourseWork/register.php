<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile.php');
    }

require_once __DIR__.'/captcha/vendor/autoload.php';
$captcha = new \Gregwar\Captcha\CaptchaBuilder();
$captcha->build();
$_SESSION['captcha1'] = $captcha->getPhrase();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="libs/jquery-1.11.2.min.js"></script>
</head>
<body>

    <!-- Форма регистрации -->

    <form action="vendor/signup.php" method="post" enctype="multipart/form-data" id="myForm">
        <label>ФИО</label>
        <input type="text" name="full_name" placeholder="Введите свое полное имя">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите адрес своей почты">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <label>Код с картинки</label>
        <input type="text" name="captcha" placeholder="Введите код с картинки">
        <p><img src="<?= $captcha->inline()?>"></p>
        <button type="submit">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="index.php">авторизируйтесь</a>!
        </p>
        <?php
            if ($_SESSION['message']) {
                echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
    </form>

</body>
</html>