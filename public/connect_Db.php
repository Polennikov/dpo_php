<?php
try {
    $path = "../config/parameters.ini";
    if (!is_file($path)) {
        $path = "../" . $path;
    }
    $arrayConnect = parse_ini_file($path, true);
    $dsn = "pgsql:host={$arrayConnect['db']['host']};port={$arrayConnect['db']['port']};dbname={$arrayConnect['db']['dbname']}";
    $dbconn = new PDO($dsn, $arrayConnect['db']['login'], $arrayConnect['db']['password']);
} catch (PDOException $e) {
    echo '<script type="text/javascript">alert("Неполадки с подключением к базе!")</script>';
}
?>