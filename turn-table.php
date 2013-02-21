<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);
		
	
	
		
	
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "table_queue.php",
            data: data,
            success: function(html){
                $("#table_queue").html(html);
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
	$.ajax({
            type: "POST",
            url: "skip_auto.php",
           
        });	
	$.ajax({
            type: "POST",
            url: "buttons/buttons.php",
            data: data,
            success: function(html){
                $("#buttons").html(html);
            }
        });			
}
</script>
<?php
session_start();
include ("bd.php");

echo "<div class='page snapped'>";
echo "Здравствуйте, ".$_SESSION['name']." ".$_SESSION['last_name']." . <a class='button' href='exit.php'>Выход</a>";
echo ("<div id='buttons'>");
echo "</div>";
echo ("<div class='tile double bg-color-blue-green'>");
echo ("<div class='tile-content'>");                             
echo ("</div>");
echo "</div>";
echo "</div>";
	
//header('refresh: 5; url=index.php');
?>
<div id="page">

    <div class="block rounded">
        <h2>Очередь на отдых</h2>
    </div>
    
    <div class="block_main rounded">
           
        <div id="table_queue">
            
        </div>
    </div>

</div>

