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

    <script src="../libs/jquery-1.11.2.min.js"></script>
    <script src="../libs/jquery.validate.min.js"></script>

    <title>Обработка JQuery</title>
</head>
<body>
<h1>Добавление записей</h1>
<form name = "form1" id="myForm" method="post" action="inserted.php">
    <p></p><label>Введите текст:</label></p>
    <textarea name="text" id="editor1" cols="45" rows="5"></textarea>

    <p><label>(Этот пункт просто для проверки работы JQuery, он ничего не делает) Введите пароль:</label>
    <input type="password" name="pswd" /></p>

    <p><label>Выберите заголовок</label>
        <select name = "list" id = "one" size="0">
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
    $(document).ready(function(){
        $("#myForm").validate({
            rules:{
                text:{
                    required: true,
                    minlength: 1,
                },
                pswd:{
                    required: true,
                    minlength: 6,
                    maxlength: 16,
                },
            },
            messages:{
                text:{
                    required: "Это поле обязательно для заполнения",
                    minlength: "Введите текст",
                },
                pswd:{
                    required: "Это поле обязательно для заполнения",
                    minlength: "Пароль должен быть минимум 6 символа",
                    maxlength: "Пароль должен быть максимум 16 символов",
                },
            }
        });

    });
</script>

<p><a href="../main.php"><<<Вернуться</a></p>
</body>
</html>
