<?php
$file_xml='fileXml.xml';
require 'connect_Db.php';
//Читает содержимое файла в строку
$xml = file_get_contents($file_xml);
str_to_sql($xml);

function str_to_sql($xml){
    global $dbconn;
    // Проверяем что xml соответствует стандарту
    if(@simplexml_load_string($xml)) {
        // Преобразует в SimpleXMLElement
        $xmls = simplexml_load_string($xml);
        $sql = "INSERT INTO users (email_users,name_users,adres_users,password_users,number_phone,role_users)
                VALUES (:email_users,:name_users,:adres_users,:password_users,:number_phone,:role_users)";
        $result = $dbconn->prepare($sql);
        foreach($xmls as $row){
        $result->bindValue(':email_users', $row->email_users);
        $result->bindValue(':number_phone', $row->number_phone);
        $result->bindValue(':name_users', $row->name_users);
        $result->bindValue(':adres_users', $row->adres_users);
        $result->bindValue(':role_users', $row->role_users);
        $result->bindValue(':password_users',md5($row->password_users));
        $result->execute();
        }
        echo "Всё прошло ОК!".PHP_EOL;
    } else {
        echo "Файл не соответствует стандарту xml".PHP_EOL;
    }
}
?>