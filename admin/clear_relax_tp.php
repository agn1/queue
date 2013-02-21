<?php
session_start();
include ("../bd.php");
$result_user = $db->query("SELECT * FROM turn WHERE type='tp' ORDER by id ASC LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_user = $result_user->fetch();
$user = $row_user['login'];
$del_turn = $db->query("DELETE FROM turn WHERE login='$user'");
$set_end = $db->query("UPDATE turn_archive SET end='".strtotime(now)."' WHERE login='$user' ORDER BY id ASC LIMIT 1");
header("location:../index.php");
?>