<?php
global $dbconn;
require 'connect_Db.php';
$sql = "SELECT * FROM law";
$result = $dbconn->prepare($sql);
$result->execute();
$Row_data = $result->fetchAll();
foreach ($Row_data as $row){
    echo $row['scr_law'];
    echo '</br>';
    $row_tmp = preg_replace('/asozd.duma/', 'sozd.parlament', $row['scr_law']);
    $row_tmp = preg_replace('/main.nsf\/\(Spravka\)\?OpenAgent&RN=/', 'bill/', $row_tmp);
    $row_tmp = preg_replace('/\&.*/', '', $row_tmp);
    echo $row_tmp;
    echo '</br>';
    $sql = "UPDATE law SET scr_law=:scr_law WHERE id=:id";
    $result = $dbconn->prepare($sql);
    $result->bindParam(':scr_law', $row_tmp);
    $result->bindParam(':id', $row['id']);
    $result->execute();
}

