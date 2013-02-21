<?php
session_start();
include ("../bd.php");

$del_turn = $db->query("DELETE FROM turn_archive");
header("location:../index.php");
?>