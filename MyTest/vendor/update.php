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
    <title>Fess-Style</title>
    <link href="../assets/css/summernote.css">
    <link href="fontawesome.min.css">
    <script src="../assets/js/summernote.min.js"></script>
</head>
    <p><h1>Редактирование записей</h1></p>
    <form action="updated.php" method="post">
        <p></p><label>Введите новый текст:</label></p>
        <input type="text" name="text" size="40" required>
        <p><label>Выберите заголовок</label>
        <select name = "list" size="1">
            <option value="0">Выберите из списка</option>
            <?php
            $sql = 'SELECT article FROM twitts GROUP BY article';
            $query = mysqli_query($connect, $sql);

            while($data = mysqli_fetch_array($query)){
                echo '<option value="'.$data['article'].'">'.$data[ 'article' ] . '</option>';
            }
            ?>
        </select></p>
        <INPUT type="submit" name="submit" value="Изменить">
    </form>
    <p><a href="../main.php"><<<Вернуться</a></p>
</body>
</html>
