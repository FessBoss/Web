<?php
    require_once 'connect.php';

    function InsertRecord()
    {
        global $connect;
        $UserName = $_POST['UName'];
        $UserLogin = $_POST['ULogin'];
        $UserEmail = $_POST['UEmail'];
        $UserPass = $_POST['UPass'];
        $UserRPass = $_POST['URPass'];
        $UserStatus = $_POST['UStatus'];

        $check_login = mysqli_query($connect, "select * from users where login = '$UserLogin'");
        $check_mail = mysqli_query($connect, "select * from users where email = '$UserEmail'");

        if ($UserName == "" || $UserLogin == "" || $UserEmail =="" || $UserPass =="" || $UserRPass == "") {
            echo "Введите данные полностью!";
            exit();
        }
        else if (mysqli_num_rows($check_login) > 0) {
            echo "такой логин уже существует";
        }
        else if (mysqli_num_rows($check_mail) > 0) {
            echo "такая почта уже существует";
        }
        else if ($UserPass != $UserRPass) {
            echo "пароли не совпадают";
        } else {
            $mdPass = md5($UserPass);
            $query = "insert into users value (null, '$UserName', '$UserLogin', '$UserEmail', '$mdPass', '$UserStatus')";
            mysqli_query($connect, $query);
            echo "Пользователь успешно добавлен!";
        }
    }

    function display_record(){
        global $connect;
        $value = "";
        $value = '<table class="table table-bordered">
                    <tr>
                        <td>Id</td>
                        <td>Полное Имя</td>
                        <td>Login</td>
                        <td>Почта</td>
                        <td>Статус</td>
                        <td>Изменить</td>
                        <td>Удалить</td>
                    </tr>';

        $query = "select * from users";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result))
        {
            $value.= '<tr>
                        <td>'. $row['id'] .'</td>
                        <td>'. $row['full_name'] .'</td>
                        <td>'. $row['login'] .'</td>
                        <td>'. $row['email'] .'</td>
                        <td>'. $row['status'] .'</td>
                        <td><button class="btn btn-success" id="btn_edit" data-id='.$row['id'].'>Изменить</button></td>
                        <td><button class="btn btn-danger" id="btn_delete" data-id1='.$row['id'].'>Удалить</button></td>
                    </tr>';
        }
        $value.='</table>';
        echo json_encode($value);
    }

    function get_record()
    {
        global $connect;
        $UserID = $_POST['UserID'];
        $query = "select * from users where id = '$UserID'";
        $result = mysqli_query($connect, $query);

        while ($row=mysqli_fetch_assoc($result))
        {
            $User_data = "";
            $User_data[0] = $row['id'];
            $User_data[1] = $row['full_name'];
            $User_data[2] = $row['login'];
            $User_data[3] = $row['email'];
        }
        echo json_encode($User_data);
    }

    function update_value()
    {
        global $connect;
        $Update_ID = $_POST['U_ID'];
        $Update_User = $_POST['U_User'];
        $Update_Login = $_POST['U_Login'];
        $Update_EMail = $_POST['U_Email'];
        $Update_Status = $_POST['U_Status'];

        $query = "update users set full_name = '$Update_User', login = '$Update_Login', email = '$Update_EMail', status = '$Update_Status' where id = '$Update_ID'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo 'Пользователь бы обновален';
        } else {
            echo 'Проверьте ваш запрос';
        }
    }

    function delete_record()
    {
        global $connect;
        $Del_Id = $_POST['Del_ID'];
        $query = "delete from users where id = '$Del_Id'";
        $result = mysqli_query($connect, $query);

        if ($result)
        {
            echo 'Пользователь был удален';
        } else {
            echo 'Проверьте запрос';
        }
    }
?>


