<?php
require_once 'connect.php';
$a = 0;
$b = 0;
$c = 0;

$query = "SELECT article FROM twitts";
$res = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($res)) {
    if ($row['article'] === "Article1") $a++;
    else if ($row['article'] === "Article2") $b++;
    else if ($row['article'] === "Article3") $c++;
}

$array = array($a, $b, $c);
sort($array);

foreach ($array as $key => $value) {
    if ($array[$key] == $a && $array[$key + 1] != $array[$key]) $arr[] = "Article1";
    else if ($array[$key] == $b && $array[$key + 1] != $array[$key]) $arr[] = "Article2";
    else if ($array[$key] == $c) $arr[] = "Article3";
}

$arr = array(
    $arr[2] => $array[2],
    $arr[1] => $array[1],
    $arr[0] => $array[0]
); //Массив с парами данных "подпись"=>"значение"
require_once('SimplePlot.php'); //Подключить скрипт
$plot = new SimplePlot($arr); //Создать диаграмму
$plot->show(); //И показать её
?>