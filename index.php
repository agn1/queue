<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="all" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
 <link rel="shortcut icon" href="favicon.ico" />
<title>Очередь ООККМ</title>
</head>
<body>
<div class="page secondary">
	<div class="page-header">
		<div class="page-header-content">
<h2>Система очереди ООККМ</h2>
		</div>
	</div>	
        <div class="page-region">
			<div class="page-region-content">
				
<?php
include ("bd.php");
$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
$row_number = $result_number->fetch();
$number = $row_number['number'];
$start = strtotime("now");
$result_end = $db->query("SELECT * FROM turn_archive WHERE login='".$_SESSION['login']."'ORDER BY id DESC LIMIT 1");
$row_end = $result_end->fetch();
$end_relax = $row_end['end'];
$result_user = $db->query("SELECT * FROM turn");
$row_user = $result_user->fetch();
$user = $row_user['login'];
$result_user_iso = $db->query("SELECT * FROM turn_iso");
$row_user_iso = $result_user_iso->fetch();
$user_iso = $row_user_iso['login'];
$diff = $start-$end_relax;
if (empty($_SESSION['login']) or empty($_SESSION['id'])){
include('logform.php');}
elseif (($number == '0') && ($_SESSION['type'] == "iso")){
include('noone.php');}
elseif (($number == '0') && ($_SESSION['type'] == "tp")){
include('noone.php');}
elseif (($_SESSION['type'] == "ruk") OR ($_SESSION['type'] == "adm")){
	include('admin/adminpanel.php');}
elseif (($_SESSION['type'] == "tp") && ($user !== $_SESSION['login'])){
   include ('turn-table.php');}
elseif (($_SESSION['type'] == "iso") && ($user !== $_SESSION['login'])){
   include ('turn-table.php');}
elseif (!empty($user) && ($user == $_SESSION['login'])){
	echo "Здравствуйте, ".$_SESSION['login']." ".$_SESSION['name']." ".$_SESSION['last_name'].". <a class='button' href='exit.php'>Выход</a>";
	include ('7.php');}	
//elseif (($_SESSION['type'] == "iso") && ($number = 1) && (($start-$end_relax) > 3600 ) && ($user !== $_SESSION['login'])){
	//include ('turn-table.php');}
//elseif (($_SESSION['type'] == "iso") && ($number = 2) && (($start-$end_relax) > 3600 ) && ($user !== $_SESSION['login'])){
	//include ('turn-table-iso.php');}
?>
			</div>
		</div>
</div>

<div style="margin-top: 12%" class="navigation-bar">
    <div class="navigation-bar-inner bg-color-darken">
       
            <p class="no-hover">2012, Система очереди ООККМ © by agn1 / Если Вы обнаружили ошибку или есть вопросы пишите  <a class="fg-color-blueLight" href="mailto:areshetnikov@ncnet.ru">сюда</a> , также вы можете обратиться к руководителям))</p>
        
    </div>
</div>
</body>
</html>