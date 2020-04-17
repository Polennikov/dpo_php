<?php
try {
    $path = "parameters.ini";
    $arrayConnect = parse_ini_file($path,true);
    $dsn = "pgsql:host={$arrayConnect['db']['host']};port={$arrayConnect['db']['port']};dbname={$arrayConnect['db']['dbname']}";
    $dbconn = new PDO($dsn,$arrayConnect['db']['login'], $arrayConnect['db']['password']);
} catch (PDOException $e) {
    echo 'Не удалось подключиться к бд';
}
?>