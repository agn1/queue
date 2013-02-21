<?php
session_start();
include ("bd.php");
$result_user = $db->query("SELECT * FROM turn");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_user = $result_user->fetch();
		$user = $row_user['login'];
	if($user == $_SESSION['login']):	
$del_turn = $db->query("DELETE FROM turn WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$set_end = $db->query("UPDATE turn_archive SET end='".strtotime(now)."' WHERE login='".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
endif;
$result = $db->query("DELETE FROM turn_q WHERE login='".$_SESSION['login']."'");
unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['last_name']);
unset($_SESSION['type']);

        exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
           // отправляем пользователя на главную страницу.
?>