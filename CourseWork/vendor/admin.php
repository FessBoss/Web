<?php
session_start();
if ($_SESSION['user']['status'] != 'admin') {
    header('Location:../profile.php');
}
else if (!$_SESSION['user']) {
    header('Location:../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fess-Style</title>
    <script type="text/javascript" src="../libs/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../libs/bootstrap.js"></script>
    <script src="../libs/myjs.js"></script>
    <script src="../libs/Chart.js"></script>
    <script src="../libs/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>

<body class="badge-dark">
<h1 class="cart-title ml-5 my-2">Панель админа</h1>
<p class="cart-title ml-5 my-2"><a href="../main.php">Перейти на главную</a></p>
<p class="cart-title ml-5 my-2"><a href="../profile.php" >Вернуться в профиль</a></p>
<p class="cart-title ml-5 my-2"><a href="logout.php" class="logout" >Выход</a></p>


<div class="row">
 <div class="col">
     <div class="card mt-5">
         <div class="cart-title ml-5 my-2">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target ="#Registration">Добавить пользователя</button>
         </div>
         <div class="card-body">
             <p id="delete-message" class="text-dark"></p>
             <div id="table"></div>
         </div>
     </div>
 </div>
</div>

<div class="modal" id="Registration">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-dark">Форма регистрации</h3>
            </div>
            <div class="modal-body">
                <p id="message" class="text-dark"></p>
                <form id="myForm">
                    <input type="text" class="form-control my-2" name="full_name" placeholder="ФИО" id="UserName">
                    <input type="text" class="form-control my-2" name="login" placeholder="Логин" id="UserLogin">
                    <input type="text" class="form-control my-2" name="email" placeholder="Почта" id="UserEmail">
                    <input type="password" class="form-control my-2" name="password" placeholder="Пароль" id="UserPass">
                    <input type="password" class="form-control my-2" name="password_confirm"placeholder="Подтверждение пароля" id="UserRPass">
                    <label class="text-dark">Статус</label>
                    <select class="selectpicker" name="status" id="UserStatus">
                        <option value="user">user</option>
                        <option value="moderator">moderator</option>
                        <option value="admin">admin</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_register">Добавить</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-dark">Редактирование пользователя</h3>
            </div>
            <div class="modal-body">
                <p id="up-message" class="text-dark"></p>
                <form>
                    <input type="hidden" class="form-control my-2" placeholder="ФИО" id="Up_UserID">
                    <input type="text" class="form-control my-2" name="full_name" placeholder="ФИО" id="Up_UserName">
                    <input type="text" class="form-control my-2" name="login" placeholder="Логин" id="Up_UserLogin">
                    <input type="text" class="form-control my-2" name="email" placeholder="Почта" id="Up_UserEmail">
                    <label class="text-dark">Статус</label>
                    <select class="selectpicker" name="status" id="Up_UserStatus">
                        <option value="user">user</option>
                        <option value="moderator">moderator</option>
                        <option value="admin">admin</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_update">Изменить</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-dark">Удаление пользователя</h3>
            </div>
            <div class="modal-body">
                <p> Хотите удалить этого пользователя?</p>
                <button type="button" class="btn btn-success" id="btn_delete_record">Удалить</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<h1 class="cart-title ml-5 my-2">Статистика за сегодня</h1>
<?require_once 'connect.php';
$date = date("Y-m-d");

// Извлекаем статистику по текущей дате (переменная date попадает сюда из файла count.php, который, в свою очередь, подключается в каждом из 4 обычных файлов)
$res = mysqli_query($connect, "SELECT `views`, `hosts` FROM `visits` WHERE `date`='$date'");
$row = mysqli_fetch_assoc($res);
$countUsers = $row['hosts'];
$count = $row['views'];

echo '<p class="cart-title ml-5 my-2"> Уникальных посетителей: ' . $countUsers. '</p>';
echo '<p class="cart-title ml-5 my-2">Просмотров: ' . $count . '</p>';?>

<canvas id="popChart" width="300" height="100"></canvas>
<script type="text/javascript">
    var countUsers = <?php echo $countUsers?>;
    var count = <?php echo $count?>;
    var popCanvas = document.getElementById("popChart");
    var barChart = new Chart(popCanvas, {
        type: 'bar',
        data: {
            labels: ["уникальных", "всего"],
            datasets: [{
                label: 'Посещений',
                data: [countUsers, count],
                backgroundColor: [
                    'rgba(250, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)'
                ]
            }]
        }
    });
</script>
</body>
</html>

