<?php
session_start();
include ("../bd.php");
if($_POST['message']) {
    $name       = $_SESSION['name'];
    $message    = $_POST['message'];
    /*** set all errors to execptions ***/
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO chat (date_time, name, message)
            VALUES (NOW(), :name, :message)";
    /*** prepare the statement ***/
    $stmt = $dbh->prepare($sql);

    /*** bind the params ***/
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    /*** run the sql statement ***/
    if ($stmt->execute()) {
        populate_shoutbox();
    }
} 


if($_POST['refresh']) {
    populate_shoutbox();
}


function populate_shoutbox() {
    global $dbh;
    $sql = "select * from chat order by date_time desc limit 10";
    echo '<ul>';
    foreach ($dbh->query($sql) as $row) {
        echo '<li>';
        echo '<span class="date">'.date("d.m.Y H:i", strtotime($row['date_time'])).'</span>';
        echo '<span class="name">'.$row['name'].'</span>';
        echo '<span class="message">'.$row['message'].'</span>';
        echo '</li>';
    }
    echo '</ul>';
}
?>