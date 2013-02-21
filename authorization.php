<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css"/>
<title>Автотризация</title>
</head>
<body>
<?php
session_start();// вся процедура работает на сессиях. Именно в ней хранятся данные пользователя, пока он находится на сайте. Очень важно запустить их в самом начале странички!!!

if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>Введены не все данные.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";
exit;
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);

$password = stripslashes($password);
$password = htmlspecialchars($password);

//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);


// подключаемся к базе
include ("bd.php");
$result = $db->query("SELECT * FROM users WHERE login='$login'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$myrow = $result->fetch();

//$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
//$myrow = mysql_fetch_array($result);
if (empty($myrow['login']))
{
//если пользователя с введенным логином не существует
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>Пользователя с таким логином не существует.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";
}
else {
//если существует, то сверяем пароли
          if ($myrow['password']==$password) {
          //если пароли совпадают, то запускаем пользователю сессию
          $_SESSION['login']=$myrow['login']; 
          $_SESSION['id']=$myrow['id'];
		  $_SESSION['name']=$myrow['name'];
		  $_SESSION['last_name']=$myrow['last_name'];
		  $_SESSION['type']=$myrow['type'];
          echo ("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
          }

       else {
       //если пароли не сошлись
	   echo "<div class='message-dialog bg-color-red fg-color-white'>";
		echo "<div style='margin-left: 20%;'>Неверный пароль.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
		echo "</div>";
       exit;
	   }
}
?>
</body>
</html>