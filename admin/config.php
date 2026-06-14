<?php
// ── Zugangsdaten aus .env laden ──
$_envFile = __DIR__ . '/../.env';
if (!file_exists($_envFile)) {
    die('Konfigurationsfehler: .env nicht gefunden.');
}
foreach (file($_envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $_line) {
    if ($_line[0] === '#' || !str_contains($_line, '=')) continue;
    [$_k, $_v] = explode('=', $_line, 2);
    $_ENV[trim($_k)] = trim($_v);
}
unset($_envFile, $_line, $_k, $_v);

define('ADMIN_USER',     $_ENV['ADMIN_USER']     ?? 'admin');
define('ADMIN_PASSWORD', $_ENV['ADMIN_PASSWORD'] ?? '');

// ── .htpasswd automatisch synchronisieren ──
$htpasswd = __DIR__ . '/../.htpasswd';
$line     = ADMIN_USER . ':' . _apr1_hash(ADMIN_PASSWORD) . "\n";

if (!file_exists($htpasswd) || trim(file_get_contents($htpasswd)) !== trim($line)) {
    file_put_contents($htpasswd, $line);
}

function _apr1_hash(string $password): string {
    $salt = substr(str_replace('+', '.', base64_encode(random_bytes(6))), 0, 8);
    $hash = shell_exec('openssl passwd -apr1 -salt ' . escapeshellarg($salt) . ' ' . escapeshellarg($password));
    if ($hash) return trim($hash);
    return '{SHA}' . base64_encode(sha1($password, true));
}
