<?php

    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $captcha = $_POST['captcha'];
    $createCaptcha = strtolower($_SESSION['captcha1']);

    if ($createCaptcha != $captcha) {
        $_SESSION['message'] = 'Неверный код с картинки!';
        unset($_SESSION['captcha1']);
        header('Location: ../register.php');

    }

    else if ($password === $password_confirm) {

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `status`) VALUES (NULL, '$full_name', '$login', '$email', '$password', 'user')");

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }

?>
