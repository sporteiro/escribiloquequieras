<?php
/**
 * reCAPTCHA v2 — verificación y widget.
 * Claves: si existe php/recaptcha_config.php, siempre se usa (local y producción).
 * Solo si no existe y el entorno es local, se usan las claves de prueba de Google.
 */

function recaptcha_is_local(): bool
{
    $flag = getenv('ESCRIBILO_LOCAL');
    if ($flag === '1' || strtolower((string) $flag) === 'true') {
        return true;
    }

    $raw = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
    if (strpos($raw, '[::1]') !== false) {
        return true;
    }
    $host = strtolower(trim(explode(':', $raw, 2)[0]));
    if ($host === '' || $host === 'localhost' || $host === '127.0.0.1' || $host === '[::1]') {
        return true;
    }

    $suffixes = ['.localhost', '.local', '.test', '.lan', '.dev'];
    foreach ($suffixes as $suf) {
        if (strlen($host) > strlen($suf) && substr($host, -strlen($suf)) === $suf) {
            return true;
        }
    }

    if (filter_var($host, FILTER_VALIDATE_IP)) {
        if (!filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return true;
        }
    }

    return false;
}

function recaptcha_get_keys(): array
{
    static $keys = null;
    if ($keys !== null) {
        return $keys;
    }

    $configFile = __DIR__ . '/recaptcha_config.php';
    if (file_exists($configFile)) {
        require $configFile;
        $keys = [
            'site_key'   => trim($recaptcha_site_key),
            'secret_key' => trim($recaptcha_secret_key),
        ];
        return $keys;
    }

    if (recaptcha_is_local()) {
        $keys = [
            'site_key'   => '6LeIxAcTAAAAAJcZVRqyHh7UM_IUXBK1aa6G_WX',
            'secret_key' => '6LeIxAcTAAAAAGG-vFI1TnRWxMUGLXKVZznWPada',
        ];
        return $keys;
    }

    throw new \RuntimeException(
        'Falta recaptcha_config.php. Copiá recaptcha_config.php.example y completá las claves.'
    );
}

function recaptcha_verify(): bool
{
    $token = $_POST['g-recaptcha-response'] ?? '';
    if ($token === '') {
        return false;
    }

    $keys = recaptcha_get_keys();
    $payload = http_build_query([
        'secret'   => $keys['secret_key'],
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
    ]);

    $opts = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $payload,
            'timeout' => 10,
        ],
    ];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $raw = false;

    if (ini_get('allow_url_fopen')) {
        $ctx = stream_context_create($opts);
        $raw = @file_get_contents($url, false, $ctx);
    }

    if ($raw === false && function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
        ]);
        $raw = curl_exec($ch);
        curl_close($ch);
    }

    if ($raw === false || $raw === '') {
        return false;
    }

    $json = json_decode($raw, true);
    return !empty($json['success']);
}

function recaptcha_require_valid(): void
{
    if (!recaptcha_verify()) {
        header('Location: ../html/malcaptcha.html');
        exit;
    }
}

function recaptcha_render_widget(): void
{
    static $script_loaded = false;
    $siteKey = recaptcha_get_keys()['site_key'];
    echo '<div class="g-recaptcha" data-sitekey="'
        . htmlspecialchars($siteKey, ENT_QUOTES, 'UTF-8')
        . '"></div>';
    if (!$script_loaded) {
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        $script_loaded = true;
    }
}
