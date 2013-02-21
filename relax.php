<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css"/>
<title>Отдых</title>
</head>
<body>
<?php
session_start();
include ("bd.php");

$result_archive = $db->query("SELECT * FROM turn_archive WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_archive = $result_archive->fetch();
$end = $row_archive['end'];

////change of number

$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
$row_number = $result_number->fetch();
$number = $row_number['number'];
if ($number == '1')
{
	$result_user = $db->query("SELECT * FROM turn");
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	
	$row_user = $result_user->fetch();
	$user = $row_user['login'];
	$name_user = $row_user['name'];
	$last_name_user = $row_user['last_name'];
}
else{
	$result_user_tp = $db->query("SELECT * FROM turn WHERE type='tp'");
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_user_tp = $result_user_tp->fetch();
	$user_tp = $row_user_tp['login'];
	$name_user_tp = $row_user_tp['name'];
	$last_name_user_tp = $row_user_tp['last_name'];
	$result_user_iso = $db->query("SELECT * FROM turn WHERE type='iso'");
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_user_iso = $result_user_iso->fetch();
	$user_iso = $row_user_iso['login'];
	$name_user_iso = $row_user_iso['name'];
	$last_name_user_iso = $row_user_iso['last_name'];
	if ($_SESSION['type'] == "tp")
	{
		$user = $user_tp;
		$name_user = $name_user_tp;
		$last_name_user = $last_name_user_tp;
	}
	else{
		$user = $user_iso;}
		$name_user = $name_user_iso['name'];
		$last_name_user = $last_name_user_iso;
	}
$start = strtotime("now");
if (($start-$end) < 3600 ):
echo ("Увы, но час не прошел<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
echo "$user $number $_SESSION[type]";
elseif (!empty($user)):
echo "<div class='message-dialog bg-color-red fg-color-white'>";
echo "<div style='margin-left: 20%;'>На отдыхе уже $last_name_user $name_user.<p class='place-right'><a href='index.php'>На главную</a></p></div>";
echo "</div>";
else:
$relax = $db->query("INSERT INTO turn (login,name,last_name,start,type) VALUES('".$_SESSION['login']."','".$_SESSION['name']."','".$_SESSION['last_name']."','$start','".$_SESSION['type']."')");
if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$relax_logs = $db->query ("INSERT INTO turn_archive (login,name,last_name,start,type) VALUES('".$_SESSION['login']."','".$_SESSION['name']."','".$_SESSION['last_name']."','$start','".$_SESSION['type']."')");
if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$delete_turn = $db->query("DELETE FROM turn_q WHERE login='".$_SESSION['login']."'");
if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';

header("location:index.php");
endif;
?>
</body>
</html>