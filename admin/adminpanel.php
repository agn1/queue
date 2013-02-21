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
				            

				
          }
        });    
        return false;
		
    });
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "admin/relax_turn.php",
            data: data,
            success: function(html){
                $("#shout").html(html);
            }
        });
	$.ajax({
            type: "POST",
            url: "admin/tablerelax.php",
            data: data,
            success: function(html){
                $(".tile-content").html(html);
            }
        });	
}
</script>
	<link rel="stylesheet" type="text/css" href="admin/css/style.css" />

<?php
session_start();
include ("bd.php");
echo "<div class='page snapped'>";
echo "Здравствуйте, ".$_SESSION['name']." ".$_SESSION['last_name'].". <a class='button' href='exit.php'>Выход</a>";
echo "<h3>Управление очередью</h3>";
$result_number = $db->query("SELECT * FROM relax_admin ORDER BY id DESC LIMIT 1");
$row_number = $result_number->fetch();
$number = $row_number['number'];
if ($number == '1'){

echo("<form action='admin/clear_relax.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Освободить место отдыха <small></small></button>");
echo("</div>");
echo("</form>");
echo("<form action='admin/clear_turn.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Очистить очередь <small>Удалить 1-ого из очереди</small></button>");
echo("</div>");
echo("</form>");

}
else {

echo("<form action='admin/clear_relax_tp.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Освободить место отдыха ТП<small></small></button>");
echo("</div>");
echo("</form>");
echo("<form action='admin/clear_relax_iso.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Освободить место отдыха ИСО<small></small></button>");
echo("</div>");
echo("</form>");
echo("<form action='admin/clear_turn_tp.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Очистить очередь ТП<small>Удалить 1-ого из очереди</small></button>");
echo("</div>");
echo("</form>");
echo("<form action='admin/clear_turn_iso.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Очистить очередь ИСО<small>Удалить 1-ого из очереди</small></button>");
echo("</div>");
echo("</form>");


}
echo("<form action='admin/clear_archive.php' method='post'>");
echo("<div>");
echo("<button class='command-button red' type='submit' name='submit'>Очистить историю<small>Раз в день</small></button>");
echo("</div>");
echo("</form>");
echo ("<form action='admin/set_number.php' method='post'>");
echo ("<div style='width: 80%' class='input-control select'>");
echo	("<label>Количество отдыхающих:<br></label>");
echo        ("<select name='number'>");
echo			("<option value=''></option>");
echo			("<option value='0'>Закрыть отдых</option>");
echo            ("<option value='1'>Один</option>");
echo		("<option value='2'>Двое</option>");
echo ("</select>");
echo ("</div>");
echo ("<p>");
echo ("<input type='submit' name='submit' value='Установить'>");
echo ("</p>");
echo ("</form>");
echo "</div>";
?>	






    
	<?
    echo ("<div class='tile double bg-color-blue-green'>");
	echo ("<div class='tile-content'>");                             
	echo ("</div>");
	echo "</div>";
	?>
	<a href="#example" class="openModal">История</a>
	<aside id="example" class="modal">
		<div>
			<h2>История(последние 10)</h2>
			<?	

$sql = "select * from turn_archive order by id desc limit 10";
	echo "<table class='striped' style='width: 50%'>";
	echo "<thead>";
	echo "<td>Фамилия</td><td>Имя</td><td>Длительность</td><td>Время возвращения</td>";
	echo "</thead>";
    foreach ($db->query($sql) as $row) {
		$date_time = date("H:i:s", strtotime($row['date_time']));
		$start = $row['start'];
		$end = $row['end'];
		$end1 = date("H:i:s",$end);
		$time = date("i:s",$end-$start);
       //	echo "<div class='page fill'>";
		
		echo "<tbody>";
		
		echo "<tr>";
		echo "<td>$row[last_name]</td><td>$row[name]</td><td>$time</td><td>$end1</td>";
		//echo "<td class='right'>$row[name]</td>";
		//echo "<td class='right'>$date_time</td>";
		echo "</tr>";
		
		echo "</tbody>";	
		
	///	echo "</div>";
		
		
    }
    echo "</table>";
?>
			<a href="#close" title="Закрыть">Закрыть</a>
		</div>
	</aside>
	<div class="page fill">
	<div class="block rounded">
        <h2>Очередь на отдых</h2>
    </div>
    <div class="block_main rounded">
           
        <div id="shout"></div>
            
     </div>   
    </div>