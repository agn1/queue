<?php
session_start();
include ("bd.php");
$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
	$row_number = $result_number->fetch();
	$number = $row_number['number'];
	if ($number == '0')
	exit ("Не нужно этого делать!");
	
    
	//if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	//if (isset($_POST['pass'])) { $password=$_POST['pass']; if ($password =='') { unset($password);} }  //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 
//	$fp = fopen("counter.txt", "w+"); // Открываем файл в режиме записи 
	//$mytext = " логин: $name пароль: $last_name\r\n"; // Исходная строка
	//$test = fwrite($fp, $mytext); // Запись в файл
//	if ($test) echo 'Данные в файл успешно занесены.';
//	else echo 'Ошибка при записи в файл.';
//	fclose($fp); //Закрытие файла
	$result_turn_exit = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."'");
	$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_turn_exit = $result_turn_exit->fetch();	
	$turn_exit_login = $row_turn_exit['login'];
	if ($turn_exit_login !== $_SESSION['login']){
    $sql = $db->query ("INSERT INTO turn_q (date_time, login, name, last_name, type)
            VALUES (NOW(),'".$_SESSION['login']."','".$_SESSION['name']."','".$_SESSION['last_name']."','".$_SESSION['type']."')");
   	
	}
	else {
	echo "Не нужно тыкать 10 раз по одной кнопке ^_-";}
exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");	
?>