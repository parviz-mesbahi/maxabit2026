<?php
require __DIR__ . '/auth.php';

header('Content-Type: application/json');

$section = $_GET['section'] ?? '';
$valid   = ['home', 'about', 'services', 'contact', 'impressum', 'datenschutz'];

if (!in_array($section, $valid)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid section']);
    exit;
}

$file = __DIR__ . "/../content/{$section}.json";
if (!file_exists($file)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Content file not found']);
    exit;
}

$c = json_decode(file_get_contents($file), true) ?? [];

function p(string $key): string {
    return trim($_POST[$key] ?? '');
}
function pLines(string $key): array {
    return array_values(array_filter(array_map('trim', explode("\n", $_POST[$key] ?? '')), 'strlen'));
}

// ── HOME ──────────────────────────────────────────────────────────────────────
if ($section === 'home') {
    $c['meta']['title']       = p('meta_title');
    $c['meta']['description'] = p('meta_desc');

    $c['hero']['heading']          = p('hero_heading');
    $c['hero']['text']             = p('hero_text');
    $c['hero']['cta']['label']     = p('hero_cta_label');
    $c['hero']['cta']['href']      = p('hero_cta_href');

    $c['about_preview']['heading'] = p('about_heading');
    $c['about_preview']['text']    = p('about_text');

    $c['services']['heading']    = p('svc_heading');
    $c['services']['subheading'] = p('svc_subheading');
    foreach ($c['services']['items'] as $i => &$item) {
        $item['title'] = p("svc_{$i}_title");
        $item['image'] = p("svc_{$i}_image");
        $item['text']  = p("svc_{$i}_text");
    }
    unset($item);

    $c['appointment_cta']['heading'] = p('appt_heading');
    $c['appointment_cta']['text']    = p('appt_text');

    $c['team_preview']['heading'] = p('team_heading');
    $c['team_preview']['text']    = p('team_text');

    $c['why_us']['heading']           = p('why_heading');
    $c['why_us']['subheading']        = p('why_subheading');
    $c['why_us']['doctor']['text']    = p('why_doctor_text');
    $c['why_us']['doctor']['bullets'] = pLines('why_bullets');

    $c['testimonials']['heading'] = p('testi_heading');
    foreach ($c['testimonials']['items'] as $i => &$t) {
        $t['name'] = p("testi_{$i}_name");
        $t['text'] = p("testi_{$i}_text");
    }
    unset($t);

// ── ABOUT ─────────────────────────────────────────────────────────────────────
} elseif ($section === 'about') {
    $c['meta']['title'] = p('meta_title');

    $c['hero']['heading'] = p('hero_heading');
    $c['hero']['text']    = p('hero_text');

    foreach ($c['history']['paragraphs'] as $i => &$para) {
        $para = [
            'text' => p("history_p_{$i}_text"),
            'bold' => p("history_p_{$i}_bold") === '1',
        ];
    }
    unset($para);

    $c['doctor']['name'] = p('doctor_name');
    $c['doctor']['role'] = p('doctor_role');
    foreach ($c['doctor']['paragraphs'] as $i => &$dp) {
        $dp = p("doctor_p_{$i}");
    }
    unset($dp);
    $c['doctor']['qualifications'] = pLines('doctor_qualifications');

    $c['team']['text'] = p('team_text');
    foreach ($c['team']['members'] as $i => &$m) {
        $m['name']  = p("member_{$i}_name");
        $m['role']  = p("member_{$i}_role");
        $m['image'] = p("member_{$i}_image");
    }
    unset($m);

    foreach ($c['values']['items'] as $i => &$v) {
        $v['title'] = p("value_{$i}_title");
        $v['icon']  = p("value_{$i}_icon");
        $v['text']  = p("value_{$i}_text");
    }
    unset($v);

// ── SERVICES ──────────────────────────────────────────────────────────────────
} elseif ($section === 'services') {
    $c['meta']['title'] = p('meta_title');
    $c['intro']         = p('intro');

    foreach ($c['items'] as $i => &$item) {
        $item['title']    = p("item_{$i}_title");
        $item['image']    = p("item_{$i}_image");
        $item['text']     = p("item_{$i}_text");
        $item['benefits'] = pLines("item_{$i}_benefits");
    }
    unset($item);

// ── CONTACT ───────────────────────────────────────────────────────────────────
} elseif ($section === 'contact') {
    $c['meta']['title'] = p('meta_title');

    $c['contact_info']['address']['street'] = p('address_street');
    $c['contact_info']['address']['city']   = p('address_city');
    $c['contact_info']['phone']             = p('phone');
    $c['contact_info']['email']             = p('email');

    foreach ($c['hours'] as $i => &$h) {
        $h['days'] = p("hours_{$i}_days");
        $h['time'] = p("hours_{$i}_time");
    }
    unset($h);

    $c['emergency']['phone']      = p('emergency_phone');
    $c['emergency']['phone_href'] = p('emergency_phone_href');

    $c['online_booking']['heading']      = p('booking_heading');
    $c['online_booking']['cta']['label'] = p('booking_cta_label');
    $c['online_booking']['cta']['href']  = p('booking_cta_href');

// ── IMPRESSUM ─────────────────────────────────────────────────────────────────
} elseif ($section === 'impressum') {
    $c['practice']['name']    = p('practice_name');
    $c['practice']['company'] = p('practice_company');
    $c['practice']['street']  = p('practice_street');
    $c['practice']['city']    = p('practice_city');
    $c['practice']['phone']   = p('practice_phone');
    $c['practice']['email']   = p('practice_email');

    $c['beruf']['lines'] = pLines('beruf_lines');

    $c['kammer']['name']   = p('kammer_name');
    $c['kammer']['street'] = p('kammer_street');
    $c['kammer']['city']   = p('kammer_city');
    $c['kammer']['url']    = p('kammer_url');
    $c['kammer']['url_label'] = parse_url(p('kammer_url'), PHP_URL_HOST) ?: p('kammer_url');

    $c['aufsicht']['name']   = p('aufsicht_name');
    $c['aufsicht']['street'] = p('aufsicht_street');
    $c['aufsicht']['city']   = p('aufsicht_city');
    $c['aufsicht']['url']    = p('aufsicht_url');
    $c['aufsicht']['url_label'] = parse_url(p('aufsicht_url'), PHP_URL_HOST) ?: p('aufsicht_url');

    $c['berufsrecht']['laws'] = pLines('berufsrecht_laws');

    foreach ($c['haftung_inhalte']['paragraphs'] as $i => &$para) {
        $para = p("haftung_inhalte_{$i}");
    }
    unset($para);

    foreach ($c['haftung_links']['paragraphs'] as $i => &$para) {
        $para = p("haftung_links_{$i}");
    }
    unset($para);

    foreach ($c['urheberrecht']['paragraphs'] as $i => &$para) {
        $para = p("urheberrecht_{$i}");
    }
    unset($para);

// ── DATENSCHUTZ ───────────────────────────────────────────────────────────────
} elseif ($section === 'datenschutz') {
    $c['meta']['title'] = p('meta_title');

    foreach ($c['sections'] as $si => &$sec) {
        foreach ($sec['paragraphs'] ?? [] as $pi => &$para) {
            $para = p("sec_{$si}_p_{$pi}");
        }
        unset($para);

        if (isset($sec['list'])) {
            $sec['list'] = pLines("sec_{$si}_list");
        }

        foreach ($sec['subsections'] ?? [] as $ssi => &$sub) {
            foreach ($sub['paragraphs'] ?? [] as $pi => &$para) {
                $para = p("sec_{$si}_sub_{$ssi}_p_{$pi}");
            }
            unset($para);

            if (isset($sub['list'])) {
                $sub['list'] = pLines("sec_{$si}_sub_{$ssi}_list");
            }

            foreach ($sub['paragraphs_after'] ?? [] as $pi => &$para) {
                $para = p("sec_{$si}_sub_{$ssi}_pa_{$pi}");
            }
            unset($para);
        }
        unset($sub);
    }
    unset($sec);
}

$json = json_encode($c, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (file_put_contents($file, $json) === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Could not write file']);
    exit;
}

echo json_encode(['success' => true]);
