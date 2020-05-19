<?php
global $dbconn;
require 'connect_Db.php';
$sql = "SELECT * FROM law";
$result = $dbconn->prepare($sql);
$result->execute();
$Row_data = $result->fetchAll();
echo 'Законы';
echo '</br>';
foreach ($Row_data as $row){
    $link=$row['scr_law'];
    echo $row['id'];
    echo ".   <a href='$link'>$link</a>";
    echo '</br>';
}
    $NameEntity="id";
    sqlInjSelect($NameEntity,"1; DROP TABLE law",$dbconn);
    sqlInjSelect($NameEntity,"-1 OR 1=1",$dbconn);
    $NameEntity="scr_law";
    sqlInjSelect($NameEntity,"'http://sozd.parlament.gov.ru/bill/31990-6'; DROP TABLE law",$dbconn);
    function sqlInjSelect(string $NameEntity,string $Value,$dbconn)
    {
        $sql = "SELECT * FROM law WHERE " . $NameEntity . " = :Value";
        $result = $dbconn->prepare($sql);
        $result->bindParam(':Value', $Value);
        $result->execute();
        $Row_data = $result->fetchAll();
        if($Row_data){
            echo 'Законы';
            echo '</br>';
            foreach ($Row_data as $row) {
                $link = $row['scr_law'];
                echo $row['id'];
                echo ".   <a href='$link'>$link</a>";
                echo '</br>';
            }
        } else {
            echo 'SQL-инъекция не прошла';
        }
        echo '</br>';
    }

