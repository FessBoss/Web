<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: main.php');
        exit();
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/index.css"
</head>
<body>

<!-- Форма аторизации -->

  <form  action="vendor/signin.php" method="post">
      <label>Логин</label>
      <input type="text" name="login" placeholder="Введите свой логин">
      <label>Пароль</label>
      <input type="password" name="password" placeholder="Введите пароль">
      <label>
          <img src="<?= $captcha->inline()?>">
          <input type="text" name="captcha" placeholder="Введите код с картинки">
      </label>
      <button type="submit">Войти</button>
      <p>
          У вас нет аккаунта? - <a href="register.php" >Зарегестрируйтесь</a>
      </p>
      <p>
          Или вы можете <a href="guest.php" >Войти как гость</a>
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