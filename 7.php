<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/jquery.countup.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	 <!-- JavaScript includes -->
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="js/jquery.countup.js"></script>
		<script src="js/script-up.js"></script>
	<title>Время отдыха:</title>
</head>

<body>

<?
session_start();
echo("<form action='relax_exit.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Выйти с отдыха<small>мало, но пора работать</small></button>");
echo("</div>");
echo("</form>");
?>
		
<div id="countdown">
<header>Время отдыха:</header>
</div>

              
       
</body>

</html>
