<?php
session_start();
include ("bd.php");
////change of number

	$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
	$row_number = $result_number->fetch();
	$number = $row_number['number'];
	if ($number == '1')
	{

		$result_minid = $db->query("SELECT * FROM turn_q ORDER BY id DESC LIMIT 1");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_minid = $result_minid->fetch();
		$minid = $row_minid['login'];

		
		$res1 = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."'");
		$row_id1 = $res1->fetch();
		$id1 = $row_id1['id']; 
		$login1 = $row_id1['login']; 
		$name1 = $row_id1['name']; 
		$last_name1 = $row_id1['last_name']; 
		$type1 = $row_id1['type'];
		$time1 = $row_id1['date_time'];
		
		$res2 = $db->query("SELECT * FROM turn_q WHERE id>'".$id1."'");
		$row_id2 = $res2->fetch();
		$id2 = $row_id2['id'];	
		$login2 = $row_id2['login']; 
		$name2 = $row_id2['name']; 
		$last_name2 = $row_id2['last_name'];
		$type2 = $row_id2['type'];
		$time2 = $row_id2['date_time']; 
	}
		else{
		$result_minid_tp = $db->query("SELECT * FROM turn_q WHERE type='tp' ORDER BY id DESC LIMIT 1");/////min id tp
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_minid_tp = $result_minid_tp->fetch();
		$minid_tp = $row_minid_tp['login'];
		
		$result_minid_iso = $db->query("SELECT * FROM turn_q WHERE type='iso' ORDER BY id DESC LIMIT 1");/////min id iso
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_minid_iso = $result_minid_iso->fetch();
		$minid_iso = $row_minid_iso['login'];
		
		$res1_tp = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."' AND type='tp'");/////////////id1 tp
		$row_id1_tp = $res1_tp->fetch();
		$id1_tp = $row_id1_tp['id']; 
		$login1_tp = $row_id1_tp['login']; 
		$name1_tp = $row_id1_tp['name']; 
		$last_name1_tp = $row_id1_tp['last_name']; 
		$type1_tp = $row_id1_tp['type'];
		$time1_tp = $row_id1_tp['date_time'];
		
		$res1_iso = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."' AND type='iso'");/////////////id1 iso
		$row_id1_iso = $res1_iso->fetch();
		$id1_iso = $row_id1_iso['id']; 
		$login1_iso = $row_id1_iso['login']; 
		$name1_iso = $row_id1_iso['name']; 
		$last_name1_iso = $row_id1_iso['last_name']; 
		$type1_iso = $row_id1_iso['type'];
		$time1_iso = $row_id1_iso['date_time'];
		
		$res2_tp = $db->query("SELECT * FROM turn_q WHERE id>'".$id1_tp."' AND type='tp' ORDER BY id ASC LIMIT 1");/////////////id2 tp
		$row_id2_tp = $res2_tp->fetch();
		$id2_tp = $row_id2_tp['id'];	
		$login2_tp = $row_id2_tp['login']; 
		$name2_tp = $row_id2_tp['name']; 
		$last_name2_tp = $row_id2_tp['last_name'];
		$type2_tp = $row_id2_tp['type'];
		$time2_tp = $row_id2_tp['date_time']; 
		
		$res2_iso = $db->query("SELECT * FROM turn_q WHERE id>'".$id1_iso."' AND type='iso' ORDER BY id ASC LIMIT 1");/////////////id2 iso
		$row_id2_iso = $res2_iso->fetch();
		$id2_iso = $row_id2_iso['id'];	
		$login2_iso = $row_id2_iso['login']; 
		$name2_iso = $row_id2_iso['name']; 
		$last_name2_iso = $row_id2_iso['last_name'];
		$type2_iso = $row_id2_iso['type'];
		$time2_iso = $row_id2_iso['date_time']; 
		
		if ($_SESSION['type'] == "tp"){
			$minid = $minid_tp;
			$id1 = $id1_tp; 
			$login1 = $login1_tp; 
			$name1 = $name1_tp; 
			$last_name1 = $last_name1_tp; 
			$type1 = $type1_tp;
			$time1 = $time1_tp;
			
			$id2 = $id2_tp;
			$login2 = $login2_tp; 
			$name2 = $name2_tp;  
			$last_name2 = $last_name2_tp;
			$type2 = $type2_tp;
			$time2 = $time2_tp;
			}
		else{
			$minid = $minid_iso;
			$id1 = $id1_iso; 
			$login1 = $login1_iso; 
			$name1 = $name1_iso; 
			$last_name1 = $last_name1_iso; 
			$type1 = $type1_iso;
			$time1 = $time1_iso;
			
			$id2 = $id2_iso;
			$login2 = $login2_iso; 
			$name2 = $name2_iso;  
			$last_name2 = $last_name2_iso;
			$type2 = $type2_iso;
			$time2 = $time2_iso;
			}	
		}
	if ($minid !== $_SESSION['login']){
$db->query("UPDATE turn_q SET login='$login2',name='$name2',last_name='$last_name2',type='$type2',date_time='$time2' WHERE id='$id1'");
// обновляем значения полей таблицы для того, кому уступили, заменяя значения данными того, кто уступил
$db->query("UPDATE turn_q SET login='$login1',name='$name1',last_name='$last_name1',type='$type1',date_time='$time1' WHERE id='$id2'");
header("location:index.php");
}
else {
echo ("Ошибка 111, вернутся на главную страницу");
header("location:index.php");
}
?>