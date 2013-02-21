<?php
session_start();
include ("bd.php");
echo "Здравствуйте, ".$_SESSION['name']." ".$_SESSION['last_name'].". <a class='button' href='exit.php'>Выход</a>";


echo("<form action='admin-skip-tp.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Освободить место отдыха ТП<small></small></button>");
echo("</div>");
echo("</form>");
echo("<form action='admin-skip-iso.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Освободить место отдыха ИСО<small></small></button>");
echo("</div>");
echo("</form>");
echo("<form action='delq-tp.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Очистить очередь ТП<small>Удалить 1-ого из очереди</small></button>");
echo("</div>");
echo("</form>");
echo("<form action='delq-iso.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Очистить очередь ИСО<small>Удалить 1-ого из очереди</small></button>");
echo("</div>");
echo("</form>");
echo("<form action='closerelax.php' method='post'>");
echo("<div>");
echo("<button class='command-button red' type='submit' name='submit'>Закрыть отдых</button>");
echo("</div>");
echo("</form>");



?>	
<div id="page">

    <div class="block rounded">
        <h2>Очередь на отдых</h2>
    </div>
    
    <div class="block_main rounded">
           
        <div id="shout">
            
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);
		
	    $("#funcq").click(function() {
        var name    = $("<? echo $name; ?>").val();
        var last_name = $("<? echo $last_name; ?>").val();
        var data            = 'name='+ name +'last_name='+ last_name;
		

        $.ajax({
            type: "POST",
            url: "funcq.php",
            data: data,
		
            success: function(html){
				//window.location.reload();
                $("#shout").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("<? echo $last_name; ?>").val("");
					
                });
				$("#funcq").animate({ opacity: "hide" }, "slow");
				$("#getout").load('getoutbutton.php');              

				
          }
        });    
        return false;
		
    });
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "funcq.php",
            data: data,
            success: function(html){
                $("#shout").html(html);
            }
        });
	$.ajax({
            type: "POST",
            url: "tablerelax.php",
            data: data,
            success: function(html){
                $(".tile-content").html(html);
            }
        });	
}


</script>
