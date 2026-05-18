<?php
$raw = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
$es_local = false;
if (getenv('ESCRIBILO_LOCAL') === '1' || strtolower((string) getenv('ESCRIBILO_LOCAL')) === 'true') {
    $es_local = true;
} elseif (strpos($raw, '[::1]') !== false) {
    $es_local = true;
} else {
    $host = strtolower(trim(explode(':', $raw, 2)[0]));
    if ($host === '' || $host === 'localhost' || $host === '127.0.0.1') {
        $es_local = true;
    } else {
        foreach (['.localhost', '.local', '.test', '.lan', '.dev'] as $suf) {
            if (strlen($host) > strlen($suf) && substr($host, -strlen($suf)) === $suf) {
                $es_local = true;
                break;
            }
        }
        if (!$es_local && filter_var($host, FILTER_VALIDATE_IP)) {
            if (!filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                $es_local = true;
            }
        }
    }
}

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
    // Misma collation que tablas antiguas (latin1); evita "Illegal mix of collations" con PHP 8 / utf8mb4 por defecto.
    mysqli_set_charset($conexion, 'latin1');
} catch (mysqli_sql_exception $e) {
    if ($es_local) {
        die('Error DB local: ' . $e->getMessage());
    }
    header('Location: ../html/404.html');
    exit;
}

$database_conexion = $db;

if (file_exists(__DIR__ . '/mysql_compat.php')) {
    require __DIR__ . '/mysql_compat.php';
}
