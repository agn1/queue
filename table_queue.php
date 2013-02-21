<?php
session_start();
include ("bd.php");


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
	}	
	else{
			$sql_tp = "select * from turn_q WHERE type='tp' order by id asc limit 10";
			$sql_iso = "select * from turn_q WHERE type='iso' order by id asc limit 10";
			if ($_SESSION['type'] == "tp")
			{
				$sql = $sql_tp;
			}
			else{
				$sql = $sql_iso;}
	    }
		echo "<table class='striped' style='width: 40%'>";
    foreach ($db->query($sql) as $row) {
		$date_time = date("H:i:s", strtotime($row['date_time']));
       //	echo "<div class='page fill'>";
		
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td><td>$row[name]</td><td>$date_time</td>";
		//echo "<td class='right'>$row[name]</td>";
		//echo "<td class='right'>$date_time</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		
	///	echo "</div>";
		
		
    }
    echo "</table>";
}

?>

