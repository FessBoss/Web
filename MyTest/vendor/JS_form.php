<?php
session_start();
require_once 'connect.php';
if (!$_SESSION['user']) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../libs/ckeditor/ckeditor.js"></script>
    <script src="../libs/jquery-1.11.2.min.js"></script>

    <title>Обработка в JavaScript</title>
</head>
<body>
<h1>Добавление записей</h1>
<form name = "form1" method="post" action="inserted.php" onsubmit="return validate()">
    <p></p><label>Введите текст:</label></p>
    <textarea name="text" id="editor1" cols="45" rows="5"></textarea>
    <p><label>Выберите заголовок</label>
        <select name = "list" id = "one" size="1">
            <option value="0">Выберите из списка</option>
            <?php
            $sql = 'SELECT article FROM twitts GROUP BY article';
            $query = mysqli_query($connect, $sql);

            while($data = mysqli_fetch_array($query)){
                echo '<option value="'.$data['article'].'">'.$data[ 'article' ] . '</option>';
            }
            ?>
        </select></p>
    <INPUT type="submit" name="submit" value="Добавить">
</form>

<script>
    function validate() {
        var text = document.getElementById("editor1");
        var list = document.getElementById("one");

        if (!text.value) {
            text.style.border = "2px solid red";
            alert("Введите текст");
            return false;
        }

        if (list.value == 0) {
            list.style.border = "2px solid red";
            alert("Выберите заголовок");
            return false;
        }

        return true;
    }
</script>

<p><a href="../main.php"><<<Вернуться</a></p>
</body>
</html>
