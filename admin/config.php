<?php
// ── .env laden ──
$_envPath = __DIR__ . '/../.env';
if (!file_exists($_envPath)) {
    http_response_code(503);
    die('<h2 style="font-family:sans-serif;padding:2rem">
        Konfiguration fehlt.<br>
        <small>Bitte <code>.env</code> auf dem Server anlegen.<br>
        Vorlage: <code>ADMIN_USER=admin</code> und <code>ADMIN_PASSWORD=IhrPasswort</code></small>
    </h2>');
}

foreach (file($_envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $_l) {
    if ($_l[0] === '#' || !str_contains($_l, '=')) continue;
    [$_k, $_v] = explode('=', $_l, 2);
    $_ENV[trim($_k)] = trim($_v);
}
unset($_envPath, $_l, $_k, $_v);

define('ADMIN_USER',     $_ENV['ADMIN_USER']     ?? 'admin');
define('ADMIN_PASSWORD', $_ENV['ADMIN_PASSWORD'] ?? '');
