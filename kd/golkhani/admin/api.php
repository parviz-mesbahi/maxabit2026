<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode(['error' => 'Nicht angemeldet', 'login' => true]);
    exit;
}

header('Content-Type: application/json');

$imagesDir  = __DIR__ . '/../images/';
$allowedExt  = ['jpg','jpeg','png','webp','gif','svg'];
$allowedMime = ['image/jpeg','image/png','image/webp','image/gif','image/svg+xml'];
$action = $_GET['action'] ?? '';

// ── LIST ──
if ($action === 'list') {
    $images = [];
    foreach (scandir($imagesDir) as $f) {
        if ($f[0] === '.') continue;
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) continue;
        $full = $imagesDir . $f;
        $images[] = [
            'name'     => $f,
            'path'     => 'images/' . $f,
            'size'     => filesize($full),
            'modified' => filemtime($full),
        ];
    }
    usort($images, fn($a,$b) => $b['modified'] - $a['modified']);
    echo json_encode($images);
    exit;
}

// ── UPLOAD ──
if ($action === 'upload' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(['error' => 'Upload fehlgeschlagen (Code: ' . ($_FILES['file']['error'] ?? '?') . ')']);
        exit;
    }
    $file = $_FILES['file'];

    // Check size (max 10 MB)
    if ($file['size'] > 10 * 1024 * 1024) {
        echo json_encode(['error' => 'Datei zu groß (max. 10 MB)']);
        exit;
    }

    // Validate mime
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowedMime)) {
        echo json_encode(['error' => 'Ungültiger Dateityp: ' . $mime]);
        exit;
    }

    // Sanitize filename
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        echo json_encode(['error' => 'Ungültige Dateiendung']);
        exit;
    }
    $base = preg_replace('/[^a-z0-9_-]/i', '-', pathinfo($file['name'], PATHINFO_FILENAME));
    $base = strtolower(trim($base, '-')) ?: 'image';
    $name = $base . '.' . $ext;
    $dest = $imagesDir . $name;

    // Avoid overwrite
    if (file_exists($dest)) {
        $name = $base . '-' . time() . '.' . $ext;
        $dest = $imagesDir . $name;
    }

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        echo json_encode(['error' => 'Speichern fehlgeschlagen']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'name'    => $name,
        'path'    => 'images/' . $name,
        'size'    => filesize($dest),
    ]);
    exit;
}

// ── DELETE ──
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = basename($_POST['name'] ?? '');
    if (!$name) {
        echo json_encode(['error' => 'Kein Dateiname angegeben']);
        exit;
    }
    $path = $imagesDir . $name;
    if (!file_exists($path)) {
        echo json_encode(['error' => 'Datei nicht gefunden']);
        exit;
    }
    unlink($path);
    echo json_encode(['success' => true]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Ungültige Aktion']);
