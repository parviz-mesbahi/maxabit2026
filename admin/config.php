<?php
// ── .env laden ──
$_envPath = __DIR__ . '/../.env';
if (!file_exists($_envPath)) {
    // .env fehlt → sicherer Abbruch mit Hinweis
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

// ── .htpasswd schreiben ──
$_htpasswd = realpath(__DIR__ . '/..') . '/.htpasswd';
$_hash     = _apr1_hash(ADMIN_PASSWORD);
$_line     = ADMIN_USER . ':' . $_hash . "\n";

if (!file_exists($_htpasswd) || trim(file_get_contents($_htpasswd)) !== trim($_line)) {
    file_put_contents($_htpasswd, $_line);
}

// ── admin/.htaccess mit korrektem absoluten Pfad schreiben ──
$_htaccess = __DIR__ . '/.htaccess';
$_authBlock = 'Options -Indexes' . "\n\n"
    . 'AuthType Basic' . "\n"
    . 'AuthName "MaxaBit Admin"' . "\n"
    . 'AuthUserFile ' . $_htpasswd . "\n"
    . 'Require valid-user' . "\n";

if (file_get_contents($_htaccess) !== $_authBlock) {
    file_put_contents($_htaccess, $_authBlock);
}

unset($_htpasswd, $_hash, $_line, $_htaccess, $_authBlock);

// ── APR-MD5 in reinem PHP (kein shell_exec) ──
function _apr1_hash(string $password, ?string $salt = null): string {
    if ($salt === null) {
        $chars = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $salt  = '';
        for ($i = 0; $i < 8; $i++) $salt .= $chars[random_int(0, 63)];
    }
    $salt = substr($salt, 0, 8);
    $len  = strlen($password);

    $a = md5($password . '$apr1$' . $salt, true);
    $b = md5($password . $salt . $password, true);

    for ($i = $len; $i > 0; $i -= 16) $a .= substr($b, 0, min(16, $i));
    for ($i = $len; $i > 0; $i >>= 1) $a .= ($i & 1) ? "\0" : $password[0];

    $a = md5($a, true);

    for ($i = 0; $i < 1000; $i++) {
        $c  = ($i & 1) ? $password : $a;
        if ($i % 3) $c .= $salt;
        if ($i % 7) $c .= $password;
        $c .= ($i & 1) ? $a : $password;
        $a  = md5($c, true);
    }

    $t64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $to64 = function(int $v, int $n) use ($t64): string {
        $s = '';
        while ($n-- > 0) { $s .= $t64[$v & 0x3f]; $v >>= 6; }
        return $s;
    };

    return '$apr1$' . $salt . '$'
        . $to64((ord($a[0])  << 16) | (ord($a[6])  << 8) | ord($a[12]), 4)
        . $to64((ord($a[1])  << 16) | (ord($a[7])  << 8) | ord($a[13]), 4)
        . $to64((ord($a[2])  << 16) | (ord($a[8])  << 8) | ord($a[14]), 4)
        . $to64((ord($a[3])  << 16) | (ord($a[9])  << 8) | ord($a[15]), 4)
        . $to64((ord($a[4])  << 16) | (ord($a[10]) << 8) | ord($a[5]),  4)
        . $to64(ord($a[11]), 2);
}
