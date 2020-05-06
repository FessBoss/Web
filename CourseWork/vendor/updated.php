<?php
    session_start();
    require_once 'connect.php';
    if (!$_SESSION['user']) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    $article = $_POST['list'];

    $text = $_POST['text'];
    $id = $_SESSION['id'];

    $sql = "UPDATE twitts SET twitts.text = '$text', twitts.article = '$article' WHERE twitts.id = '$id'";
    $query = mysqli_query($connect, $sql);
    header('location: ../main.php');
?>


