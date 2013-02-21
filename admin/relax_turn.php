<?
session_start();
include ("../bd.php");
if($_POST['refresh']) {
    populate_shoutbox();
}

function populate_shoutbox() {
    global $db;
	////change of number

	$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
	$row_number = $result_number->fetch();
	$number = $row_number['number'];
	if ($number == '1')
	{
		$sql = "select * from turn_q order by id asc limit 10";
		foreach ($db->query($sql) as $row) {
		$date_time = date("H:i:s", strtotime($row['date_time']));
       	
		echo "<table style='width: 60%'>";
		//echo "<thead>";
		//echo "<tr><th>Фамилия</th><th>Имя</th><th class='right'>Время, когда встал в очередь</th></tr>";
		//echo "</thead>";
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td>";
		echo "<td class='right'>$row[name]</td>";
		echo "<td class='right'>$date_time</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		echo "</table>";
		
		
		
    }
	}	
	else{
			$sql_tp = "select * from turn_q WHERE type='tp' order by id asc limit 10";
			$sql_iso = "select * from turn_q WHERE type='iso' order by id asc limit 10";
			
	    
		echo "<table style='width: 60%'>";
		echo "<thead>";
		echo "<tr>Очередь экспертов</tr>";
		echo "</thead>";
		echo "</table>";
    foreach ($db->query($sql_tp) as $row) {
		$date_time = date("H:i:s", strtotime($row['date_time']));
       	
		echo "<table style='width: 60%'>";
		
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td>";
		echo "<td class='right'>$row[name]</td>";
		echo "<td class='right'>$date_time</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		echo "</table>";
		
		}
		echo "<table style='width: 60%'>";
		echo "<thead>";
		echo "<tr>Очередь ИСО</tr>";
		echo "</thead>";
		echo "</table>";
	foreach ($db->query($sql_iso) as $row) {
		$date_time = date("H:i:s", strtotime($row['date_time']));
       	
		echo "<table style='width: 60%'>";
		
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td>";
		echo "<td class='right'>$row[name]</td>";
		echo "<td class='right'>$date_time</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		echo "</table>";
		
		
		
		}
	}	
    
}

?>