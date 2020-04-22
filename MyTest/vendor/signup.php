<?php
    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];


    if ($password === $password_confirm) {
        /*$path = 'uploads/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке картинки!';
            header('Location: ../register.php');
            exit();
        }*/

        $check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
        $row_cnt = mysqli_num_rows($check_login);
        if ($row_cnt > 0) {
            $_SESSION['message'] = 'Такой логин уже существует.';
            header('Location: ../register.php');
            exit();
        }

        $check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
        $row_cnt = mysqli_num_rows($check_email);
        if ($row_cnt > 0) {
            $_SESSION['message'] = 'Этот email уже занят.';
            header('Location: ../register.php');
            exit();
        }

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '')");
        if ($login == 'admin') {
            mysqli_query($connect, "INSERT INTO `access` (`id`, `login`, `status`) VALUES (NULL, '$login', 'admin')");
        } else if ($login == 'moderator') mysqli_query($connect, "INSERT INTO `access` (`id`, `login`, `status`) VALUES (NULL, '$login', 'moderator')");
            else mysqli_query($connect, "INSERT INTO `access` (`id`, `login`, `status`) VALUES (NULL, '$login', 'user')");

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');

    } else {
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: ../register.php');
    }
?>