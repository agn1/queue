<?php
$hostname = '';
$username = '';
$password_db = '';
$dbname = '';
$encoding = 'UTF-8';

try {
     $db = new PDO("mysql:host=$hostname;dbname=$dbname;charset=$encoding", $username, $password_db);
	 $db->exec('SET NAMES utf8');
	 }
catch(PDOException $e)
{
	die("Error: ".$e->getMessage());
}
?>