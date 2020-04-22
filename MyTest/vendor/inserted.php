<?php
    session_start();
    require_once 'connect.php';
    if (!$_SESSION['user']) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    $text = $_POST['text'];
    $article = $_POST['list'];
    $login = $_SESSION['user']['login'];
    $today = date('y-m-j');

    $sql = "INSERT INTO `twitts`(`id`, `article`, `text`, `date`, `login`) VALUES (null, '$article', '$text', '$today', '$login')";

    $query = mysqli_query($connect, $sql);

    header("location:../main.php");
?>