<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fess-Style</title>
    <link rel="stylesheet" href="assets/css/profile.css">

    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<div class="p-3 mb-2 bg-success text-white">Пользователь: <text class="text-danger"><?= $_SESSION['user']['full_name'] ?></text>
    <div class="p-3 mb-2 text-white">Login: <?= $_SESSION['user']['login'] ?></div>
    <div class="p-3 mb-2 text-white">Email: <?= $_SESSION['user']['email'] ?></div>
    <div class="p-3 mb-2 text-white">Статус: <text class="text-danger"><?= $_SESSION['user']['status'] ?></text></div>
    <div class="p-3 mb-2 text-white">Login: <?= $_SESSION['user']['login'] ?></div>
</div>
<?php if ($_SESSION['user']['status'] == 'admin') echo '<p class="cart-title ml-5 my-2"><a href="vendor/admin.php">Панель админа</a></p>';?>
    <a href="main.php" class="cart-title ml-5 my-2">Перейти на главную</a><br />
    <a href="vendor/logout.php" class="logout" >Выход</a>
</body>
</html>