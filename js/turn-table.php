<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    refresh_shoutbox();
    setInterval("refresh_shoutbox()", 15000);
		
	    $("#turn_enter").click(function() {
        var name    = $("<? echo $name; ?>").val();
        var last_name = $("<? echo $last_name; ?>").val();
        var data            = 'name='+ name +'last_name='+ last_name;
		
        $.ajax({
            type: "POST",
            url: "turn_enter.php",
            data: data,
		
            success: function(html){
				//window.location.reload();
                $("#shout").slideToggle(500, function(){
                    $(this).html(html).slideToggle(500);
                    $("<? echo $last_name; ?>").val("");
					
                });
				$("#turn_enter").animate({ opacity: "hide" }, "slow");
				$("#turn_exitbutton").load('buttons/turn_exitbutton.php');   
          }
        });    
        return false;
		
    });
	
		
	
});

function refresh_shoutbox() {
    var data = 'refresh=1';
    
    $.ajax({
            type: "POST",
            url: "turn_enter.php",
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
	$.ajax({
            type: "POST",
            url: "skip_auto.php",
           
        });			
}
</script>
<?php
session_start();
include ("bd.php");
echo $_SESSION['type'];
$login = $_SESSION['login'];
$name = $_SESSION['name'];
$last_name = $_SESSION['last_name'];
$type = $_SESSION['type'];
$result_user_tp = $db->query("SELECT * FROM turn WHERE type='tp'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_user_tp = $result_user_tp->fetch();
$user_tp = $row_user_tp['login'];
$result_user_iso = $db->query("SELECT * FROM turn WHERE type='iso'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_user_iso = $result_user_iso->fetch();
$user_iso = $row_user_iso['login'];
if ($_SESSION['type'] == "tp"){
$user = $user_tp;}
else{
$user = $user_iso;}
$start = strtotime("now");

$result_archive = $db->query("SELECT * FROM turn_archive WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_archive = $result_archive->fetch();
$end = $row_archive['end'];

$result_minid = $db->query("SELECT login FROM turn_q ORDER BY id LIMIT 1");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_minid = $result_minid->fetch();
$minid = $row_minid['login'];
$result_maxid = $db->query("SELECT * FROM turn_q ORDER BY id DESC LIMIT 1");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_maxid = $result_maxid->fetch();
$maxid = $row_maxid['login'];

if (!minid){
echo ("Возникла ошибка соединения с базой данных");
exit();
}
$result_turn_exit = $db->query("SELECT * FROM turn_q WHERE login='".$_SESSION['login']."'");
$error_array = $db->errorInfo();
 
	if($db->errorCode() != 0000)
 
	echo "SQL ошибка: " . $error_array[2] . '<br />';
$row_turn_exit = $result_turn_exit->fetch();	
$turn_exit_login = $row_turn_exit['login'];
echo "<div class='page snapped'>";
echo "Здравствуйте, ".$_SESSION['login']." ".$_SESSION['name']." ".$_SESSION['last_name'].". <a class='button' href='exit.php'>Выход</a>";

if ((empty($user)) && (($start-$end) > 3600 ) &&  (($minid == $login) OR (empty($minid)))) :
echo("<form action='relax.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Уйти на отдых<small>только 1 раз в час</small></button>");
echo("</div>");
echo("</form>");
endif;
if (!empty($user) && ($user == $_SESSION['login'])):
echo("<form action='relax_exit.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Выйти с отдыха<small>мало, но пора работать</small></button>");
echo("</div>");
echo("</form>");
endif;
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 3600) && ($turn_exit_login !== $_SESSION['login'])): //&& ($userq !== $user)):
echo("<form action='turn_enter.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit' id='turn_enter'>Встать в очередь<small>Придет и твоя</small></button>");
echo("</div>");
echo("</form>");
endif;
echo("<div id='turn_exitbutton'>");
echo("</div>");
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 3600) && ($turn_exit_login == $_SESSION['login'])): //&& ($userq !== $user)):
echo("<form action='turn_exit.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Выйти из очереди<small>Решил поработать?</small></button>");
echo("</div>");
echo("</form>");
endif;
if ((!empty($user) OR (!empty($minid))) && ($user !== $_SESSION['login']) && (($start-$end) > 3600) && ($turn_exit_login == $_SESSION['login']) && ($maxid !== $_SESSION['login'])): //&& ($userq !== $user)):
echo("<form action='skip_turn.php' method='post'>");
echo("<div>");
echo("<button class='command-button default' type='submit' name='submit'>Пропустить вперед<small>Заработался?</small></button>");
echo("</div>");
echo("</form>");
endif;

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
           
        <div id="shout">
            
        </div>
    </div>
</div>

