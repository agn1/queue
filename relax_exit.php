<?php
session_start();
include ("bd.php");

$del_turn = $db->query("DELETE FROM turn WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$set_end = $db->query("UPDATE turn_archive SET end='".strtotime(now)."' WHERE login='".$_SESSION['login']."' ORDER BY id desc LIMIT 1");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';

exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
?>