<?php
session_start();
include ("../bd.php");
if (isset($_POST['number'])) { $number = $_POST['number']; if ($number == '') { unset($number);} } 

	$result = $db->query("INSERT INTO relax_admin (login,number,time) VALUES('".$_SESSION['login']."','$number',NOW())");
		if($db->errorCode() != 0000)
	
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$result_turn = $db->query("DELETE FROM turn_q");
header("location:../index.php");	
?>	