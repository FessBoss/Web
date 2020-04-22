<?php
 $connect = mysqli_connect('localhost', 'root', 'qwe', 'MyTest');

 if (!$connect) {
     die('Error connect to DataBase'); //die выведет сообщение и при этом остановит весь код
 }
?>