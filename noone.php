
<?php
session_start();
echo "Здравствуйте, ".$_SESSION['name']." ".$_SESSION['last_name']." . <a class='button' href='exit.php'>Выход</a>";
?>
<header>Очередь закрыта, ведутся работы, при любом действии аккаунт удаляется автоматически.</header>
<img src="images/work.png"  alt="Очередь закрыта">
