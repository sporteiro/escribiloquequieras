<?php
$server = $_SERVER['SERVER_NAME'] ?? '';
$es_local = ($server === 'localhost' || $server === '127.0.0.1' || $server === '');

// $es_local = false;

if ($es_local) {
    $host = 'mysql-server';
    $user = 'root';
    $pass = 'rootpassword123';
    $db   = 'escribiloquequieras';
} else {
    require __DIR__ . '/conexion_remota.php';
    if (is_object($pass) && $pass instanceof SensitiveParameterValue) {
        $pass = (new ReflectionProperty($pass, 'value'))->getValue($pass);
    }
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = mysqli_connect($host, $user, $pass, $db);
} catch (mysqli_sql_exception $e) {
    if ($es_local) {
        die('Error DB local: ' . $e->getMessage());
    }
    header('Location: 404.html');
    exit;
}

$database_conexion = $db;

if (file_exists(__DIR__ . '/mysql_compat.php')) {
    require __DIR__ . '/mysql_compat.php';
}
