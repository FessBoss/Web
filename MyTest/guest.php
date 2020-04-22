<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location:main.php');
    }
    require_once 'vendor/connect.php';
    $sql = "SELECT twitts.id, full_name, twitts.login, `email`, article, `text`, `date` FROM `twitts` INNER JOIN `users` ON twitts.login = users.login;";
    $query = mysqli_query($connect, $sql);
    $search=$_POST['poisk'];

    if($search)
        $query = mysqli_query($connect,
            "SELECT twitts.id, full_name, twitts.login, `email`,  article, `text`, `date` FROM `twitts` INNER JOIN `users` ON twitts.login = users.login where full_name = '$search'");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fess-Style.ru</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="scripts.js"></script>
</head>
<body>
    <center>
    <h1>База данных "Статьи"</h1>
    <p>К сожалению, вы сейчас гость. Вам доступен только просмотр таблицы.</p>
    <p>Для редактирования таблицы вам нужно <a href="vendor/logout.php" class="logout">авторизоваться</a> на сайте.</p>
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
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    ?>
    <P> Поиск по имени:
    <FORM method="POST" action="guest.php">
        <INPUT type="text" name="poisk" size=10>
        <INPUT type="submit" name="submit" value="Поиск">
    </FORM></P>
        <A HREF=guest.php>Показать все</A>
        <div id = "chart_div"></div>
    </center>
</body>
</html>
