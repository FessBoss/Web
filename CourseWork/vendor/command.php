<?php

require_once 'connect.php';
$value = $_POST['value'];

if ($value == '0') echo "";

if ($value == 'select') {
    $query = mysqli_query($connect, "select id, full_name, login, status from users") ;
    echo '<p>';
    while ($row = mysqli_fetch_array($query)) {
        echo 'id: '. $row['id']. '; Имя: '. $row['full_name']. '; Логин: '. $row['login']. '; Статус: '. $row['status']. "<br />";
    }
    echo '</p>';
}
else if ($value == 'update') {
    $query = mysqli_query($connect, "select id, login from users where login not in ('admin');");
    echo '<p>Изменить статус пользователя <select name="user" id="user">';

    while ($row = mysqli_fetch_array($query)) {
        echo '<option value="'. $row['id']. '">'.$row["login"].'</option>';
    }
    echo '</select> на <select name="status" id="status">
            <option value="admin">admin</option>
            <option value="moderator">moderator</option>
            <option value="user">user</option>
          </select></p> 
          <button id="update">Изменить статус</button>';
}
else if ($value == 'delete') {
    $query = mysqli_query($connect, "select id, login from users where login not in ('admin');");

    echo '<p>Удалить пользователя <select name="user" id="user">';

    while ($row = mysqli_fetch_array($query)) {
        echo '<option value="'. $row['id']. '">'.$row["login"].'</option>';
    }
    echo '</select></p>
          <button>"Удалить пользователя"</button>';
}
else if ($value == 'insert') {
    echo '<p><label>ФИО</label>
        <input type="text" name="full_name" placeholder="Введите свое полное имя"></p>
        <p><label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин"></p>
        <p><label>Почта</label>
        <input type="email" name="email" placeholder="Введите адрес своей почты"></p>
        <p><label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль"></p>
        <p><label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль"></p>
        <button>Зарегистрировать</button>';
}
?>