<?php
    session_start();
    require_once 'connect.php';

    if (!$_SESSION['user']) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
    else if ($_SESSION['user']['status'] != "admin") {
        header('Location: ../main.php');
        exit();
    }

    $qr_result = mysqli_query($connect, "delete from twitts where id=". $_GET['id']);
    header("location:../main.php");
?>