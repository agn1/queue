<?php
session_start();

if (empty($_SESSION['login']) or empty($_SESSION['id'])):
echo("Зарегистрируйтесь <a href='../index.php'>На главную</a>");
header("location:../index.php");
endif;

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Чат</title>

<link rel="stylesheet" type="text/css" href="default.css" />
<link rel="stylesheet" type="text/css" media="all" href="../css/style.css"/>

</head>

<body>

<div id="page">

    <div class="block rounded">
        <h1>Чат, по вопросам работы программы очереди</h1>
    </div>
    
    <div class="block_main rounded">
        <h2>Флуд запрещен</h2>
        
        <form method="post" action="shout.php">
            
            Сообщение: <input type="text" id="message" name="message" class="message" /><input type="submit" id="submit" value="Отправить" />
        </form>
        
        <div id="shout">
            
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);

    $("#submit").click(function() {
        var message = $("#message").val();
        var data            = '&message='+ message;

        $.ajax({
            type: "POST",
            url: "shout.php",
            data: data,
            success: function(html){
                $("#shout").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("#message").val("");
                });
          }
        });    
        return false;
    });
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "shout.php",
            data: data,
            success: function(html){
                $("#shout").html(html);
            }
        });
}


</script>
</body>
</html>