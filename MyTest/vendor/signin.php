<?php
    session_start();
    require_once 'connect.php';

    $captcha = $_POST['captcha'];
    $createCaptcha = strtolower($_SESSION['captcha1']);

    if ($createCaptcha != $captcha) {
        $_SESSION['message'] = 'Неверный код с картинки!';
        unset($_SESSION['captcha1']);
        header('Location: ../index.php');
    }
    else {
        $login = $_POST['login'];
        $password = md5($_POST['password']);

        $check_user = mysqli_query($connect, "SELECT users.id, `full_name`, users.login, `email`, `password`, `status` 
                                    FROM `users` inner join `access` on users.login = access.login  WHERE users.login = '$login' AND users.password = '$password'");

        $row_cnt = mysqli_num_rows($check_user);

        if ($row_cnt > 0) {

            $user = mysqli_fetch_assoc($check_user);

            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['full_name'] = $user['full_name'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['login'] = $user['login'];
            $_SESSION['user']['status'] = $user['status'];

            header('Location: ../main.php');

        } else {
            $_SESSION['message'] = 'Неверный логин или пароль!';
            header('Location: ../index.php');
        }
    }
?>