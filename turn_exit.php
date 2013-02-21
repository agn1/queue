
<?
session_start();
include ("bd.php");
$result = $db->query("DELETE FROM turn_q WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
header("location:index.php");
?>