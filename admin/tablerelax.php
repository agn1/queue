<?php
session_start();
include ("../bd.php");

////change of number

	$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
	$row_number = $result_number->fetch();
	$number = $row_number['number'];
	if ($number == '1')
	{
		$result = $db->query("SELECT * FROM turn",$db);
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row = $result->fetch();
		$name = $row['name'];
		$last_name = $row['last_name'];
		$result_turn = $db->query("SELECT * FROM turn");
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_turn = $result_turn->fetch();
		$start = $row_turn['start'];
		$now = strtotime('now');
		$time_relax = $now-$start;
		$time = date("i:s", $time_relax);
		if (empty($name)){
			echo ("<h3>  На отдыхе: </h3>");
			echo ("<h3>");
			echo ("Никого нет");                              
			echo ("</h3>");
			}
		else{
			echo ("<h3>  На отдыхе: </h3>");
			echo ("<h3>");
			echo ("$name $last_name, прошло: $time");                              
			echo ("</h3>");
			}
	}	
	else
	{
		$result_tp = $db->query("SELECT * FROM turn WHERE type='tp'");///////////name last_name tp
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_tp = $result_tp->fetch();
		$name_tp = $row_tp['name'];
		$last_name_tp = $row_tp['last_name'];
		
		$result_iso = $db->query("SELECT * FROM turn WHERE type='iso'");////////////name last_name iso
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_iso = $result_iso->fetch();
		$name_iso = $row_iso['name'];
		$last_name_iso = $row_iso['last_name'];
		
				
		$result_turn_tp = $db->query("SELECT * FROM turn WHERE type='tp'");///////////////start time of relax TP
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_turn_tp = $result_turn_tp->fetch();
		$start_tp = $row_turn_tp['start'];
		
		$result_turn_iso = $db->query("SELECT * FROM turn WHERE type='iso'");///////////////start time of relax ISO
		$error_array = $db->errorInfo();
 
			if($db->errorCode() != 0000)
 
			echo "SQL ошибка: " . $error_array[2] . '<br />';
		$row_turn_iso = $result_turn_iso->fetch();
		$start_iso = $row_turn_iso['start'];
		
		
		$now = strtotime('now');
		$time_relax_tp = $now-$start_tp;
		$time_tp = date("i:s", $time_relax_tp);
		$time_relax_iso = $now-$start_iso;
		$time_iso = date("i:s", $time_relax_iso);
		if (empty($name_tp)){
			echo ("<h4>  На отдыхе ТП: Никого нет</h4>");
			}
		else{
			echo ("<h4>  На отдыхе ТП: $name_tp $last_name_tp, прошло: $time_tp</h4>");
			}
		if (empty($name_iso)){
			echo ("<h4>  На отдыхе ИСО: Никого нет</h4>");
			}
		else{
			echo ("<h4>  На отдыхе ИСО: $name_iso $last_name_iso, прошло: $time_iso</h4>");
			}	
		
	}


?>