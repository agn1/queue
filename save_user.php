<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css"/>
<title>Регистрация</title>
</head>
<body>
<?php
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
if (isset($_POST['name'])) { $name = $_POST['name']; if ($name == '') { unset($name);} }
if (isset($_POST['last_name'])) { $last_name = $_POST['last_name']; if ($last_name == '') { unset($last_name);} }
if (isset($_POST['type'])) { $type = $_POST['type']; if ($type == '') { unset($type);} }

if (empty($login) or empty($password) or empty($name) or empty($last_name) or empty($type)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>Вы заполнили не все поля, все ячейки обязательны к заполнению.<p class='place-right'><a href='reg.php'>Регистрация</a></p></div>";
echo "</div>";
exit;
}

//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

$name = stripslashes($name);
$name = htmlspecialchars($name);

$last_name = stripslashes($last_name);
$last_name = htmlspecialchars($last_name);

$type = stripslashes($type);
$type = htmlspecialchars($type);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
$name = trim($name);
$last_name = trim($last_name);

// подключаемся к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 

// проверка на существование пользователя с таким же логином
$result = $db->query("SELECT id FROM users WHERE login='$login'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row = $result->fetch();	
if (!empty($row['id'])) {
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>Данный логин уже зарегистрирован, выберете другой.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";
exit;
}

// если такого нет, то сохраняем данные
$save_user = $db->exec("INSERT INTO users (login,password,name,last_name,id_date,type) VALUES('$login','$password','$name','$last_name', NOW(),'$type')");

// Проверяем, есть ли ошибки
if ($save_user)
{
echo "<div class='message-dialog bg-color-green fg-color-white'>";
echo "<div style='margin-left: 20%;'>Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";
}

else {
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>Ошибка в регистрации, обратитесь к руководителю.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";

     }
?>
</body>
</html>