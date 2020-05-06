<?php
    session_start();
    require_once 'connect.php';
    if (!$_SESSION['user']) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
    $_SESSION['id'] = $_GET['id'];
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../libs/ckeditor/ckeditor.js"></script>
    <script src="../libs/jquery-1.11.2.min.js"></script>

    <title>Fess-Style</title>
</head>
    <p><h1>Редактирование записей</h1></p>
    <form action="updated.php" method="post">
        <p></p><label>Введите новый текст:</label></p>
        <textarea name="text" id="editor1" cols="45" rows="5"></textarea>
        <script type="text/javascript">
            CKEDITOR.replace( 'editor1');
        </script>
        <p><label>Выберите заголовок</label>
        <select name = "list" size="1">
            <option value="0" disabled selected>Выберите из списка</option>
            <option value="Article1">Article1</option>
            <option value="Article2">Article2</option>
            <option value="Article3">Article3</option>
        </select></p>
        <INPUT type="submit" name="submit" value="Изменить">
    </form>
    <p><a href="../main.php"><<<Вернуться</a></p>
</body>
</html>
