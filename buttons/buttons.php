
<?
session_start();
include ("../bd.php");
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
		$start = strtotime("now");

		$result_archive = $db->query("SELECT * FROM turn_archive WHERE login='".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_archive = $result_archive->fetch();
		$end = $row_archive['end'];

		$result_minid = $db->query("SELECT login FROM turn_q ORDER BY id LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_minid = $result_minid->fetch();
		$minid = $row_minid['login'];
		$result_maxid = $db->query("SELECT * FROM turn_q ORDER BY id DESC LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_maxid = $result_maxid->fetch();
		$maxid = $row_maxid['login'];

		if (!minid){
			echo ("Возникла ошибка соединения с базой данных");
		exit();
		}
		$result_turn_enter = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."'");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_turn_enter = $result_turn_enter->fetch();	
		$turn_enter_login = $row_turn_enter['login'];
	}
else{
	
	$login = $_SESSION['login'];
	$name = $_SESSION['name'];
	$last_name = $_SESSION['last_name'];
	$type = $_SESSION['type'];
	$result_user_tp = $db->query("SELECT * FROM turn WHERE type='tp'");///////////////////////USER TP
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_user_tp = $result_user_tp->fetch();
	$user_tp = $row_user_tp['login'];
	$result_user_iso = $db->query("SELECT * FROM turn WHERE type='iso'");/////////////////USER ISO
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_user_iso = $result_user_iso->fetch();
	$user_iso = $row_user_iso['login'];
		if ($_SESSION['type'] == "tp"){
			$user = $user_tp;
			}
		else{
			$user = $user_iso;
			}
	$start = strtotime("now");

	$result_archive = $db->query("SELECT * FROM turn_archive WHERE login='".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_archive = $result_archive->fetch();
	$end = $row_archive['end'];

	$result_minid_tp = $db->query("SELECT login FROM turn_q WHERE type='tp' ORDER BY id LIMIT 1");/////////////MIN ID TP
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_minid_tp = $result_minid_tp->fetch();
	$minid_tp = $row_minid_tp['login'];

	$result_minid_iso = $db->query("SELECT login FROM turn_q WHERE type='iso' ORDER BY id LIMIT 1");//////////////MIN ID ISO
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_minid_iso = $result_minid_iso->fetch();
	$minid_iso = $row_minid_iso['login'];
		if ($_SESSION['type'] == "tp")
		{
			$minid = $minid_tp;
		}
		else{
			$minid = $minid_iso;
			}

	$result_maxid_tp = $db->query("SELECT * FROM turn_q WHERE type='tp' ORDER BY id DESC LIMIT 1");/////////////MAX ID TP
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_maxid_tp = $result_maxid_tp->fetch();
	$maxid_tp = $row_maxid_tp['login'];

	$result_maxid_iso = $db->query("SELECT * FROM turn_q WHERE type='iso' ORDER BY id DESC LIMIT 1");/////////////MAX ID ISO
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_maxid_iso = $result_maxid_iso->fetch();
	$maxid_iso = $row_maxid_iso['login'];
		if ($_SESSION['type'] == "tp")
		{
			$maxid = $maxid_tp;
		}
		else{
		$maxid = $maxid_iso;
		}
	if (!minid)
	{
	echo ("Возникла ошибка соединения с базой данных");
	exit();
	}
	$result_turn_enter_tp = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."' AND type='tp'");////////////////tp in turn
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_turn_enter_tp = $result_turn_enter_tp->fetch();	
	$turn_enter_tp_login = $row_turn_enter_tp['login'];

	$result_turn_enter_iso = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."' AND type='iso'");////////////////iso in turn
	$error_array = $db->errorInfo();
 
		if($db->errorCode() != 0000)
 
		echo "SQL ошибка: " . $error_array[2] . '<br />';
	$row_turn_enter_iso = $result_turn_enter_iso->fetch();	
	$turn_enter_iso_login = $row_turn_enter_iso['login'];
		if ($_SESSION['type'] == "tp")
		{
			$turn_enter_login = $turn_enter_tp_login;
		}
		else{
			$turn_enter_login = $turn_enter_iso_login;
			}
	}
if (!empty($end)):	
$diff = $start-$end;
$lefttime = date("H:i:s", $diff-10800);	

echo("Прошло с прошлого отдыха $lefttime");
endif;
if ((empty($user)) && (($start-$end) > 3000 ) &&  (($minid == $_SESSION['login']) OR (empty($minid)))) :
echo("<form action='relax.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Уйти на отдых<small>только 1 раз в час</small></button>");
echo("</div>");
echo("</form>");
endif;
if (!empty($user) && ($user == $_SESSION['login'])):
echo("<form action='relax_exit.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Выйти с отдыха<small>мало, но пора работать</small></button>");
echo("</div>");
echo("</form>");
endif;
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 2700) && ($turn_enter_login !== $_SESSION['login'])): 
echo("<form action='turn_enter.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit' id='turn_enter'>Встать в очередь<small>Придет и твоя</small></button>");
echo("</div>");
echo("</form>");
endif;
echo("<div id='turn_exitbutton'>");
echo("</div>");
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 2700) && ($turn_enter_login == $_SESSION['login'])): 
echo("<form action='turn_exit.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Выйти из очереди<small>Решил поработать?</small></button>");
echo("</div>");
echo("</form>");
endif;
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 2700) && ($turn_enter_login == $_SESSION['login']) && ($maxid !== $_SESSION['login'])): //&& ($userq !== $user)):
echo("<form action='skip_turn.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Пропустить вперед<small>Заработался?</small></button>");
echo("</div>");
echo("</form>");
endif;
?>