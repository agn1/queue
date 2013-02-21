<?php
session_start();
include ("../bd.php");
$result_user = $db->query("SELECT * FROM turn_q ORDER by id ASC LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_user = $result_user->fetch();
$user = $row_user['login'];
$del_turn = $db->query("DELETE FROM turn_q WHERE login='$user'");
header("location:../index.php");
?>