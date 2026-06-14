<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Content-Type: application/json');
    http_response_code(401);
    echo json_encode(['error' => 'Nicht angemeldet', 'login' => true]);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$section = $_GET['section'] ?? 'index';
$validSections = ['index', 'hero', 'menu', 'footer'];
if (!in_array($section, $validSections)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid section']);
    exit;
}

$jsonFile = __DIR__ . "/../content/{$section}.json";
$current = json_decode(file_get_contents($jsonFile), true);
if (!$current) {
    http_response_code(500);
    echo json_encode(['error' => "Could not read {$section}.json"]);
    exit;
}

// ─────────────────────────────────────────────
if ($section === 'index') {

    // ── META ──
    $current['meta']['title'] = trim($_POST['meta_title'] ?? '');

    // ── LOGOS ──
    $current['logos']['label'] = trim($_POST['logos_label'] ?? '');
    $logoItems = [];
    foreach (explode("\n", $_POST['logos_items'] ?? '') as $line) {
        $line = trim($line);
        if ($line !== '') $logoItems[] = $line;
    }
    $current['logos']['items'] = $logoItems;

    // ── HOW IT WORKS ──
    $current['how']['section_label'] = trim($_POST['how_section_label'] ?? '');
    $current['how']['headline']      = trim($_POST['how_headline'] ?? '');
    $current['how']['sub']           = trim($_POST['how_sub'] ?? '');
    foreach ($current['how']['steps'] as $i => &$step) {
        $step['title'] = trim($_POST["how_step_{$i}_title"] ?? '');
        $step['text']  = trim($_POST["how_step_{$i}_text"]  ?? '');
    }
    unset($step);

    // ── SERVICES ──
    $current['services']['section_label'] = trim($_POST['srv_section_label'] ?? '');
    $current['services']['headline']      = trim($_POST['srv_headline'] ?? '');
    $current['services']['sub']           = trim($_POST['srv_sub'] ?? '');
    foreach ($current['services']['items'] as $i => &$srv) {
        $srv['badge'] = trim($_POST["srv_{$i}_badge"] ?? '');
        $srv['title'] = trim($_POST["srv_{$i}_title"] ?? '');
        $srv['text']  = trim($_POST["srv_{$i}_text"]  ?? '');
        $features = [];
        foreach (explode("\n", $_POST["srv_{$i}_features"] ?? '') as $line) {
            $line = trim($line);
            if ($line !== '') $features[] = $line;
        }
        $srv['features'] = $features;
    }
    unset($srv);

    // ── AI ──
    $current['ai']['card_label']    = trim($_POST['ai_card_label']    ?? '');
    $current['ai']['card_title']    = trim($_POST['ai_card_title']    ?? '');
    $current['ai']['card_image']    = trim($_POST['ai_card_image']    ?? '');
    $current['ai']['section_label'] = trim($_POST['ai_section_label'] ?? '');
    $current['ai']['headline']      = trim($_POST['ai_headline'] ?? '');
    $current['ai']['sub']           = trim($_POST['ai_sub'] ?? '');
    foreach ($current['ai']['progress'] as $i => &$p) {
        $p['label'] = trim($_POST["ai_prog_{$i}_label"] ?? '');
        $p['value'] = trim($_POST["ai_prog_{$i}_value"] ?? '');
    }
    unset($p);
    foreach ($current['ai']['floaters'] as $i => &$f) {
        $f['text'] = trim($_POST["ai_float_{$i}_text"] ?? '');
        $f['val']  = trim($_POST["ai_float_{$i}_val"]  ?? '');
    }
    unset($f);
    foreach ($current['ai']['side_cards'] as $i => &$sc) {
        $sc['label'] = trim($_POST["ai_sc_{$i}_label"] ?? '');
        $sc['sub']   = trim($_POST["ai_sc_{$i}_sub"]   ?? '');
    }
    unset($sc);
    $pills = [];
    foreach (explode("\n", $_POST['ai_pills'] ?? '') as $line) {
        $line = trim($line);
        if ($line !== '') $pills[] = $line;
    }
    $current['ai']['pills']        = $pills;
    $current['ai']['cta']['label'] = trim($_POST['ai_cta_label'] ?? '');
    $current['ai']['cta']['href']  = trim($_POST['ai_cta_href']  ?? '');

    // ── PRICING ──
    $current['pricing']['section_label'] = trim($_POST['price_section_label'] ?? '');
    $current['pricing']['headline']      = trim($_POST['price_headline'] ?? '');
    $current['pricing']['sub']           = trim($_POST['price_sub'] ?? '');
    foreach ($current['pricing']['plans'] as $i => &$plan) {
        $plan['tag']    = trim($_POST["plan_{$i}_tag"]    ?? '');
        $plan['name']   = trim($_POST["plan_{$i}_name"]   ?? '');
        $plan['desc']   = trim($_POST["plan_{$i}_desc"]   ?? '');
        $plan['price']  = trim($_POST["plan_{$i}_price"]  ?? '');
        $plan['period'] = trim($_POST["plan_{$i}_period"] ?? '');
        $plan['cta']    = trim($_POST["plan_{$i}_cta"]    ?? '');
        $features = [];
        foreach (explode("\n", $_POST["plan_{$i}_features"] ?? '') as $line) {
            $line = trim($line);
            if ($line !== '') $features[] = $line;
        }
        $plan['features'] = $features;
    }
    unset($plan);

    // ── TESTIMONIALS ──
    $current['testimonials']['section_label'] = trim($_POST['testi_section_label'] ?? '');
    $current['testimonials']['headline']      = trim($_POST['testi_headline'] ?? '');
    $current['testimonials']['sub']           = trim($_POST['testi_sub'] ?? '');
    foreach ($current['testimonials']['items'] as $i => &$t) {
        $t['name'] = trim($_POST["testi_{$i}_name"] ?? '');
        $t['role'] = trim($_POST["testi_{$i}_role"] ?? '');
        $t['text'] = trim($_POST["testi_{$i}_text"] ?? '');
    }
    unset($t);

    // ── CTA ──
    $current['cta']['section_label']    = trim($_POST['cta_section_label'] ?? '');
    $current['cta']['headline']         = trim($_POST['cta_headline'] ?? '');
    $current['cta']['sub']              = trim($_POST['cta_sub'] ?? '');
    $current['cta']['primary']['label'] = trim($_POST['cta_primary_label'] ?? '');
    $current['cta']['primary']['href']  = trim($_POST['cta_primary_href']  ?? '');
    $current['cta']['ghost']['label']   = trim($_POST['cta_ghost_label'] ?? '');
    $current['cta']['ghost']['href']    = trim($_POST['cta_ghost_href']  ?? '');

// ─────────────────────────────────────────────
} elseif ($section === 'hero') {

    $current['image']    = trim($_POST['image'] ?? '');
    $current['tag']      = trim($_POST['tag'] ?? '');
    $current['headline'] = trim($_POST['headline'] ?? '');
    $current['sub']      = trim($_POST['sub'] ?? '');

    $current['cta_primary']['label']   = trim($_POST['cta_primary_label']   ?? '');
    $current['cta_primary']['href']    = trim($_POST['cta_primary_href']    ?? '');
    $current['cta_secondary']['label'] = trim($_POST['cta_secondary_label'] ?? '');
    $current['cta_secondary']['href']  = trim($_POST['cta_secondary_href']  ?? '');

    $avatars = [];
    foreach (explode("\n", $_POST['trust_avatars'] ?? '') as $line) {
        $line = trim($line);
        if ($line !== '') $avatars[] = $line;
    }
    $current['trust']['avatars'] = $avatars;
    $current['trust']['count']   = trim($_POST['trust_count']  ?? '');
    $current['trust']['rating']  = trim($_POST['trust_rating'] ?? '');

    $current['screen_url'] = trim($_POST['screen_url'] ?? '');

    foreach ($current['chips'] as $i => &$chip) {
        $chip['label'] = trim($_POST["chip_{$i}_label"] ?? '');
        $chip['sub']   = trim($_POST["chip_{$i}_sub"]   ?? '');
    }
    unset($chip);

// ─────────────────────────────────────────────
} elseif ($section === 'menu') {

    $current['logo']['name']   = trim($_POST['logo_name']   ?? '');
    $current['logo']['suffix'] = trim($_POST['logo_suffix'] ?? '');
    $current['logo']['href']   = trim($_POST['logo_href']   ?? '');

    foreach ($current['links'] as $i => &$link) {
        $link['label'] = trim($_POST["link_{$i}_label"] ?? '');
        $link['href']  = trim($_POST["link_{$i}_href"]  ?? '');
    }
    unset($link);

    $current['cta_ghost']['label']   = trim($_POST['cta_ghost_label']   ?? '');
    $current['cta_ghost']['href']    = trim($_POST['cta_ghost_href']    ?? '');
    $current['cta_primary']['label'] = trim($_POST['cta_primary_label'] ?? '');
    $current['cta_primary']['href']  = trim($_POST['cta_primary_href']  ?? '');

// ─────────────────────────────────────────────
} elseif ($section === 'footer') {

    $current['logo']['name']   = trim($_POST['logo_name']   ?? '');
    $current['logo']['suffix'] = trim($_POST['logo_suffix'] ?? '');
    $current['logo']['href']   = trim($_POST['logo_href']   ?? '');
    $current['brand_text']     = trim($_POST['brand_text']  ?? '');
    $current['badge']          = trim($_POST['badge']       ?? '');

    foreach ($current['cols'] as $i => &$col) {
        $col['title'] = trim($_POST["col_{$i}_title"] ?? '');
        foreach ($col['links'] as $j => &$link) {
            $link['label'] = trim($_POST["col_{$i}_link_{$j}_label"] ?? '');
            $link['href']  = trim($_POST["col_{$i}_link_{$j}_href"]  ?? '');
        }
        unset($link);
    }
    unset($col);

    $current['copy'] = trim($_POST['copy'] ?? '');

    foreach ($current['bottom_links'] as $i => &$link) {
        $link['label'] = trim($_POST["bottom_link_{$i}_label"] ?? '');
        $link['href']  = trim($_POST["bottom_link_{$i}_href"]  ?? '');
    }
    unset($link);
}

// ── WRITE ──
$result = file_put_contents(
    $jsonFile,
    json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => "Could not write {$section}.json"]);
    exit;
}

echo json_encode(['success' => true]);
