<?php
session_start();
if (!$_SESSION['user']) {
    header('Location:guest.php');
}
require_once 'vendor/connect.php';
$sql = "SELECT twitts.id, full_name, twitts.login, `email`, article, `text`, `date` FROM `twitts` INNER JOIN `users` ON twitts.login = users.login;";
$query = mysqli_query($connect, $sql);
$search=$_POST['poisk'];

if($search)
    $query = mysqli_query($connect,
        "SELECT twitts.id, full_name, twitts.login, `email`, article, `text`, `date` FROM `twitts` INNER JOIN `users` ON twitts.login = users.login where full_name = '$search'");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fess-Style.ru</title>
</head>
<body>
    <center>
    <h1>База данных "Статьи"</h1>
    <p>Приветствуем, <?php echo $_SESSION['user']['login']?>!</>
        <?php
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Name</th>';
        echo '<th>Login</th>';
        echo '<th>email</th>';
        echo '<th>Article</th>';
        echo '<th>Text</th>';
        echo '<th>Date</th>';
        if ($_SESSION['user']) echo '<th>Изменить</th>';
        if ($_SESSION['user']['status'] == "admin") echo '<th>Удалить</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while($data = mysqli_fetch_array($query)){
            echo '<tr>';
            echo '<td>' . $data['id'] . '</td>';
            echo '<td>' . $data['full_name'] . '</td>';
            echo '<td>' . $data['login'] . '</td>';
            echo '<td>' . $data['email'] . '</td>';
            echo '<td>' . $data['article'] . '</td>';
            echo '<td>' . $data['text'] . '</td>';
            echo '<td>' . $data['date'] . '</td>';
            if ($_SESSION['user']) echo '<td><A HREF=vendor/update.php?id=' . $data['id'] . '>Изменить</A></td>';
            if ($_SESSION['user']['status'] == "admin") echo '<td><A HREF=vendor/delete.php?id=' . $data['id'] . '>Удалить</A></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        require_once 'vendor/data.php';
        ?>
        <P> Поиск по имени:
        <FORM method="POST" action="main.php">
            <INPUT type="text" name="poisk" size=10>
            <INPUT type="submit" name="submit" value="Поиск">
        </FORM></P>
        <p><A HREF=main.php>Показать все</A></p>
        <p><A HREF="vendor/insert.php">Добавить запись</A></p>
        <a href="vendor/logout.php">Выход из учетной записи</a>
    </center>
</body>
</html>

