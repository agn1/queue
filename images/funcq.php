<?php
session_start();
//include ("bd.php");
//$login = $_SESSION['login'];
//$tmp_turn_q = mysql_query("SELECT * FROM users WHERE login='$login'",$db);
//$tmp_turn_id_q = mysql_fetch_array($tmp_turn_q);
//$name = "$tmp_turn_id_q[name]";
//$last_name = "$tmp_turn_id_q[last_name]";
//$start_q = strtotime("now");
//$turnq = mysql_query ("INSERT INTO turn_q (login,name,last_name,start,type) VALUES('$login','$name','$last_name','$start_q','".$_SESSION['type']."')");
//header("location:index.php");
$hostname = 'localhost';

/*** mysql username ***/
$username = 'agn1';

/*** mysql password ***/
$password = 'ixti1582';

$dbname = 'agn1_turn';

$encoding = 'UTF-8';

try {
     $dbh = new PDO("mysql:host=$hostname;dbname=$dbname;charset=$encoding", $username, $password);
	 $dbh->exec('SET NAMES utf8');
if($_POST['name']) {
	$login       = $_SESSION['login'];
    $name       = $_SESSION['name'];
    $last_name    = $_SESSION['last_name'];
	$type    = $_SESSION['type'];
	while(list ($key, $val) = each ($_SESSION)){$_SESSION[$key] = iconv("UTF-8","CP1251", $_SESSION[$key]);};
    /*** set all errors to execptions ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
	//if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	//if (isset($_POST['pass'])) { $password=$_POST['pass']; if ($password =='') { unset($password);} }  //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 
//	$fp = fopen("counter.txt", "w+"); // Открываем файл в режиме записи 
	//$mytext = " логин: $name пароль: $last_name\r\n"; // Исходная строка
	//$test = fwrite($fp, $mytext); // Запись в файл
//	if ($test) echo 'Данные в файл успешно занесены.';
//	else echo 'Ошибка при записи в файл.';
//	fclose($fp); //Закрытие файла
    $sql = "INSERT INTO turn_q (date_time, login, name, last_name, type)
            VALUES (NOW(), :login, :name, :last_name, :type)";
    /*** prepare the statement ***/
    $stmt = $dbh->prepare($sql);

    /*** bind the params ***/
	$stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
	$stmt->bindParam(':type', $type, PDO::PARAM_STR);

    /*** run the sql statement ***/
    if ($stmt->execute()) {
        populate_shoutbox();
    }
} 
}
catch(PDOException $e) {
    echo $e->getMessage();
}

if($_POST['refresh']) {
    populate_shoutbox();
}


function populate_shoutbox() {
    global $dbh;
    $sql = "select * from turn_q order by date_time asc limit 10";
    $date_time = date("H:i", strtotime($row['date_time']));
    foreach ($dbh->query($sql) as $row) {
       	echo "<div class='page fill'>";
		echo "<table style='width: 60%'>";
		//echo "<thead>";
		//echo "<tr><th>Фамилия</th><th>Имя</th><th class='right'>Время, когда встал в очередь</th></tr>";
		//echo "</thead>";
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td>";
		echo "<td class='right'>$row[name]</td>";
		echo "<td class='right'>$row[date_time]</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		echo "</table>";
		echo "</div>";
		
		
    }
    
}

?>

