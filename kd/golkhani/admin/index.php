<?php
require __DIR__ . '/auth.php';

$section = $_GET['section'] ?? 'home';
$validSections = ['home', 'about', 'services', 'contact', 'impressum', 'datenschutz', 'media'];
if (!in_array($section, $validSections)) $section = 'home';

$c = [];
if ($section !== 'media') {
    $jsonFile = __DIR__ . "/../content/{$section}.json";
    $c = json_decode(file_get_contents($jsonFile), true) ?? [];
}

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

function imgField(string $name, string $val, string $label = 'Bild'): string {
    $id  = 'inp_' . preg_replace('/\W/', '_', $name);
    $pid = 'prev_' . $id;
    $nid = 'nm_'   . $id;
    $src = $val ? ('../' . htmlspecialchars($val, ENT_QUOTES)) : '';
    $fn  = $val ? basename($val) : 'Kein Bild ausgewählt';
    $thumb = $val
        ? "<img id=\"{$pid}\" src=\"{$src}\" alt=\"\">"
        : "<img id=\"{$pid}\" src=\"\" alt=\"\" style=\"display:none\"><span class=\"img-thumb-empty\">Kein Bild</span>";
    return "<div class=\"field\"><label>" . htmlspecialchars($label, ENT_QUOTES) . "</label>
<div class=\"img-picker-field\">
  <div class=\"img-thumb-wrap\">{$thumb}</div>
  <div class=\"img-picker-meta\">
    <div class=\"img-picker-filename\" id=\"{$nid}\">{$fn}</div>
    <input type=\"hidden\" id=\"{$id}\" name=\"" . htmlspecialchars($name, ENT_QUOTES) . "\" value=\"" . htmlspecialchars($val, ENT_QUOTES) . "\">
    <button type=\"button\" class=\"btn-pick\" onclick=\"MediaPicker.open('{$id}','{$pid}','{$nid}')\">Bild wählen</button>
  </div>
</div></div>";
}

$nav = [
    'home'        => ['label' => 'Startseite',         'sub' => 'Hero · Über uns · Leistungen · Team · Testimonials'],
    'about'       => ['label' => 'Über uns',            'sub' => 'Geschichte · Arzt · Team · Werte'],
    'services'    => ['label' => 'Leistungen',          'sub' => 'Alle 8 Leistungen'],
    'contact'     => ['label' => 'Kontakt',             'sub' => 'Adresse · Öffnungszeiten · Formular'],
    'impressum'   => ['label' => 'Impressum',           'sub' => 'Adresse · Kammer · Regelungen'],
    'datenschutz' => ['label' => 'Datenschutzerklärung','sub' => 'Alle 9 Abschnitte'],
    'media'       => ['label' => 'Bilder',              'sub' => 'Hochladen · Verwalten'],
];

$saved = isset($_GET['saved']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin – <?= $nav[$section]['label'] ?> – Dr. Golkhani</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<?php if ($saved): ?>
<div class="toast" id="toast">✓ Gespeichert</div>
<script>setTimeout(()=>document.getElementById('toast')?.remove(),3000)</script>
<?php endif; ?>

<div class="admin-bar">
  <h1>Dr. Golkhani <span>Admin</span></h1>
  <div class="bar-right">
    <?php if ($section !== 'media'): ?>
    <span class="file-badge">content/<?= $section ?>.json</span>
    <button class="btn-save" form="adminForm">Speichern</button>
    <?php else: ?>
    <span class="file-badge">images/</span>
    <?php endif; ?>
    <a href="logout.php" class="btn-logout">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
      Abmelden
    </a>
  </div>
</div>

<div class="layout">
  <nav class="sidebar">
    <div class="sidebar-group">Seiten</div>
    <?php foreach (['home','about','services','contact'] as $key): ?>
    <a href="?section=<?= $key ?>" class="<?= $section===$key?'active':'' ?>">
      <?= $nav[$key]['label'] ?>
      <span class="file-sub"><?= $nav[$key]['sub'] ?></span>
    </a>
    <?php endforeach; ?>
    <hr class="sidebar-divider">
    <div class="sidebar-group">Rechtliches</div>
    <?php foreach (['impressum','datenschutz'] as $key): ?>
    <a href="?section=<?= $key ?>" class="<?= $section===$key?'active':'' ?>">
      <?= $nav[$key]['label'] ?>
      <span class="file-sub"><?= $nav[$key]['sub'] ?></span>
    </a>
    <?php endforeach; ?>
    <hr class="sidebar-divider">
    <div class="sidebar-group">Medien</div>
    <a href="?section=media" class="<?= $section==='media'?'active':'' ?>">
      <?= $nav['media']['label'] ?>
      <span class="file-sub"><?= $nav['media']['sub'] ?></span>
    </a>
    <hr class="sidebar-divider">
    <div class="sidebar-group">Aktionen</div>
    <a href="../" target="_blank">← Website ansehen</a>
    <a href="logout.php" style="color:#f87171">⏻ Abmelden</a>
  </nav>

  <main class="main">

  <?php if ($section === 'media'): ?>
  <!-- ══ BILDER-BIBLIOTHEK ══ -->
  <div class="media-upload-zone" id="dropZone">
    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
      <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
    </svg>
    <p>Bilder hierher ziehen</p>
    <small>JPG, PNG, WebP, GIF, SVG · max. 10 MB</small><br>
    <button class="btn-upload-choose" onclick="document.getElementById('fileInputLib').click()">Datei auswählen</button>
    <input type="file" id="fileInputLib" accept="image/*" multiple style="display:none">
    <div class="upload-progress" id="libProgress">
      <div class="upload-bar-bg"><div class="upload-bar-fill" id="libBar"></div></div>
    </div>
  </div>
  <div class="media-grid" id="mediaGrid"><div class="media-empty">Lade Bilder…</div></div>

  <?php else: ?>
  <!-- ══ CONTENT-FORMULAR ══ -->
  <form id="adminForm" method="POST" action="save.php?section=<?= $section ?>">

  <?php if ($section === 'home'):
    $hero  = $c['hero']            ?? [];
    $about = $c['about_preview']   ?? [];
    $svc   = $c['services']        ?? [];
    $appt  = $c['appointment_cta'] ?? [];
    $team  = $c['team_preview']    ?? [];
    $why   = $c['why_us']          ?? [];
    $testi = $c['testimonials']    ?? [];
  ?>

  <!-- META -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Meta</div>
    <div class="section-body">
      <div class="field"><label>Seiten-Titel</label>
        <input type="text" name="meta_title" value="<?= e($c['meta']['title'] ?? '') ?>">
      </div>
      <div class="field"><label>Meta-Beschreibung</label>
        <input type="text" name="meta_desc" value="<?= e($c['meta']['description'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- HERO -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Hero</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="hero_heading" value="<?= e($hero['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Text</label>
        <textarea name="hero_text" rows="3"><?= e($hero['text'] ?? '') ?></textarea>
      </div>
      <div class="row2">
        <div class="field"><label>CTA-Label</label>
          <input type="text" name="hero_cta_label" value="<?= e($hero['cta']['label'] ?? '') ?>">
        </div>
        <div class="field"><label>CTA-Link</label>
          <input type="text" name="hero_cta_href" value="<?= e($hero['cta']['href'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- ÜBER UNS VORSCHAU -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Über uns – Vorschau</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="about_heading" value="<?= e($about['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Text</label>
        <textarea name="about_text" rows="3"><?= e($about['text'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <!-- LEISTUNGEN -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Leistungen</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="svc_heading" value="<?= e($svc['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Untertext</label>
        <input type="text" name="svc_subheading" value="<?= e($svc['subheading'] ?? '') ?>">
      </div>
      <hr class="divider">
      <?php foreach ($svc['items'] ?? [] as $i => $item): ?>
      <div class="sub-block">
        <div class="sub-block-title"><?= e($item['title']) ?></div>
        <div class="field"><label>Titel</label>
          <input type="text" name="svc_<?= $i ?>_title" value="<?= e($item['title']) ?>">
        </div>
        <?= imgField("svc_{$i}_image", $item['image'] ?? '') ?>
        <div class="field"><label>Text</label>
          <textarea name="svc_<?= $i ?>_text" rows="2"><?= e($item['text']) ?></textarea>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- TERMINVEREINBARUNG CTA -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Terminvereinbarung CTA</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="appt_heading" value="<?= e($appt['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Text</label>
        <textarea name="appt_text" rows="2"><?= e($appt['text'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <!-- TEAM VORSCHAU -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Team – Vorschau</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="team_heading" value="<?= e($team['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Text</label>
        <textarea name="team_text" rows="2"><?= e($team['text'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <!-- WARUM WIR -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Warum wir?</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="why_heading" value="<?= e($why['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Untertext</label>
        <input type="text" name="why_subheading" value="<?= e($why['subheading'] ?? '') ?>">
      </div>
      <div class="field"><label>Arzt-Text</label>
        <textarea name="why_doctor_text" rows="3"><?= e($why['doctor']['text'] ?? '') ?></textarea>
      </div>
      <div class="field"><label>Bullet-Points (eine pro Zeile)</label>
        <textarea name="why_bullets" rows="3"><?= e(implode("\n", $why['doctor']['bullets'] ?? [])) ?></textarea>
      </div>
    </div>
  </div>

  <!-- TESTIMONIALS -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Testimonials</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="testi_heading" value="<?= e($testi['heading'] ?? '') ?>">
      </div>
      <hr class="divider">
      <?php foreach ($testi['items'] ?? [] as $i => $t): ?>
      <div class="sub-block">
        <div class="sub-block-title"><?= e($t['name']) ?></div>
        <div class="field"><label>Name</label>
          <input type="text" name="testi_<?= $i ?>_name" value="<?= e($t['name']) ?>">
        </div>
        <div class="field"><label>Bewertungstext</label>
          <textarea name="testi_<?= $i ?>_text" rows="3"><?= e($t['text']) ?></textarea>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($section === 'about'):
    $hero    = $c['hero']    ?? [];
    $history = $c['history'] ?? [];
    $doctor  = $c['doctor']  ?? [];
    $team    = $c['team']    ?? [];
    $values  = $c['values']  ?? [];
  ?>

  <!-- META -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Meta</div>
    <div class="section-body">
      <div class="field"><label>Seiten-Titel</label>
        <input type="text" name="meta_title" value="<?= e($c['meta']['title'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- HERO -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Hero</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="hero_heading" value="<?= e($hero['heading'] ?? '') ?>">
      </div>
      <div class="field"><label>Text</label>
        <input type="text" name="hero_text" value="<?= e($hero['text'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- GESCHICHTE -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Unsere Geschichte</div>
    <div class="section-body">
      <?php foreach ($history['paragraphs'] ?? [] as $i => $p):
        $text = is_array($p) ? $p['text'] : $p;
        $bold = is_array($p) && !empty($p['bold']);
      ?>
      <div class="sub-block">
        <div class="row2">
          <div class="field"><label>Absatz <?= $i+1 ?></label>
            <textarea name="history_p_<?= $i ?>_text" rows="2"><?= e($text) ?></textarea>
          </div>
          <div class="field"><label>Fett?</label>
            <select name="history_p_<?= $i ?>_bold">
              <option value="0" <?= !$bold?'selected':'' ?>>Nein</option>
              <option value="1" <?= $bold?'selected':'' ?>>Ja</option>
            </select>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ARZT -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Dr. Golkhani</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Name</label>
          <input type="text" name="doctor_name" value="<?= e($doctor['name'] ?? '') ?>">
        </div>
        <div class="field"><label>Funktion</label>
          <input type="text" name="doctor_role" value="<?= e($doctor['role'] ?? '') ?>">
        </div>
      </div>
      <?php foreach ($doctor['paragraphs'] ?? [] as $i => $p): ?>
      <div class="field"><label>Absatz <?= $i+1 ?></label>
        <textarea name="doctor_p_<?= $i ?>" rows="2"><?= e($p) ?></textarea>
      </div>
      <?php endforeach; ?>
      <div class="field"><label>Qualifikationen (eine pro Zeile)</label>
        <textarea name="doctor_qualifications" rows="4"><?= e(implode("\n", $doctor['qualifications'] ?? [])) ?></textarea>
      </div>
    </div>
  </div>

  <!-- TEAM -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Team</div>
    <div class="section-body">
      <div class="field"><label>Team-Text</label>
        <textarea name="team_text" rows="2"><?= e($team['text'] ?? '') ?></textarea>
      </div>
      <hr class="divider">
      <?php foreach ($team['members'] ?? [] as $i => $m): ?>
      <div class="sub-block">
        <div class="sub-block-title">Mitglied <?= $i+1 ?></div>
        <div class="row2">
          <div class="field"><label>Name</label>
            <input type="text" name="member_<?= $i ?>_name" value="<?= e($m['name']) ?>">
          </div>
          <div class="field"><label>Funktion</label>
            <input type="text" name="member_<?= $i ?>_role" value="<?= e($m['role']) ?>">
          </div>
        </div>
        <?= imgField("member_{$i}_image", $m['image'] ?? '') ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- WERTE -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Werte</div>
    <div class="section-body">
      <?php foreach ($values['items'] ?? [] as $i => $v): ?>
      <div class="sub-block">
        <div class="sub-block-title"><?= e($v['title']) ?></div>
        <div class="row2">
          <div class="field"><label>Titel</label>
            <input type="text" name="value_<?= $i ?>_title" value="<?= e($v['title']) ?>">
          </div>
          <div class="field"><label>Icon (Emoji)</label>
            <input type="text" name="value_<?= $i ?>_icon" value="<?= e($v['icon']) ?>">
          </div>
        </div>
        <div class="field"><label>Text</label>
          <textarea name="value_<?= $i ?>_text" rows="2"><?= e($v['text']) ?></textarea>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($section === 'services'):
    $items = $c['items'] ?? [];
  ?>

  <!-- META -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Meta</div>
    <div class="section-body">
      <div class="field"><label>Seiten-Titel</label>
        <input type="text" name="meta_title" value="<?= e($c['meta']['title'] ?? '') ?>">
      </div>
      <div class="field"><label>Intro-Text</label>
        <input type="text" name="intro" value="<?= e($c['intro'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- LEISTUNGEN -->
  <?php foreach ($items as $i => $item): ?>
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> <?= e($item['title']) ?></div>
    <div class="section-body">
      <div class="field"><label>Titel</label>
        <input type="text" name="item_<?= $i ?>_title" value="<?= e($item['title']) ?>">
      </div>
      <?= imgField("item_{$i}_image", $item['image'] ?? '') ?>
      <div class="field"><label>Text</label>
        <textarea name="item_<?= $i ?>_text" rows="2"><?= e($item['text'] ?? '') ?></textarea>
      </div>
      <div class="field"><label>Vorteile (eine pro Zeile)</label>
        <textarea name="item_<?= $i ?>_benefits" rows="3"><?= e(implode("\n", $item['benefits'] ?? [])) ?></textarea>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <?php elseif ($section === 'contact'):
    $info  = $c['contact_info']   ?? [];
    $hours = $c['hours']          ?? [];
    $emerg = $c['emergency']      ?? [];
    $book  = $c['online_booking'] ?? [];
  ?>

  <!-- META -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Meta</div>
    <div class="section-body">
      <div class="field"><label>Seiten-Titel</label>
        <input type="text" name="meta_title" value="<?= e($c['meta']['title'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- KONTAKTDATEN -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Kontaktdaten</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Straße</label>
          <input type="text" name="address_street" value="<?= e($info['address']['street'] ?? '') ?>">
        </div>
        <div class="field"><label>Stadt / PLZ</label>
          <input type="text" name="address_city" value="<?= e($info['address']['city'] ?? '') ?>">
        </div>
      </div>
      <div class="row2">
        <div class="field"><label>Telefon</label>
          <input type="text" name="phone" value="<?= e($info['phone'] ?? '') ?>">
        </div>
        <div class="field"><label>E-Mail</label>
          <input type="text" name="email" value="<?= e($info['email'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- ÖFFNUNGSZEITEN -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Öffnungszeiten</div>
    <div class="section-body">
      <?php foreach ($hours as $i => $h): ?>
      <div class="row2">
        <div class="field"><label>Tag(e)</label>
          <input type="text" name="hours_<?= $i ?>_days" value="<?= e($h['days']) ?>">
        </div>
        <div class="field"><label>Zeit</label>
          <input type="text" name="hours_<?= $i ?>_time" value="<?= e($h['time']) ?>">
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- NOTFALLDIENST -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Notfalldienst</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Telefon</label>
          <input type="text" name="emergency_phone" value="<?= e($emerg['phone'] ?? '') ?>">
        </div>
        <div class="field"><label>Tel-Link (href)</label>
          <input type="text" name="emergency_phone_href" value="<?= e($emerg['phone_href'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- ONLINE BOOKING -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Online-Buchung</div>
    <div class="section-body">
      <div class="field"><label>Überschrift</label>
        <input type="text" name="booking_heading" value="<?= e($book['heading'] ?? '') ?>">
      </div>
      <div class="row2">
        <div class="field"><label>CTA-Label</label>
          <input type="text" name="booking_cta_label" value="<?= e($book['cta']['label'] ?? '') ?>">
        </div>
        <div class="field"><label>CTA-Link (Doctolib)</label>
          <input type="text" name="booking_cta_href" value="<?= e($book['cta']['href'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <?php elseif ($section === 'impressum'):
    $pr   = $c['practice']        ?? [];
    $ber  = $c['beruf']           ?? [];
    $kam  = $c['kammer']          ?? [];
    $auf  = $c['aufsicht']        ?? [];
    $br   = $c['berufsrecht']     ?? [];
    $str  = $c['streit']          ?? [];
    $hi   = $c['haftung_inhalte'] ?? [];
    $hl   = $c['haftung_links']   ?? [];
    $ur   = $c['urheberrecht']    ?? [];
  ?>

  <!-- PRAXIS -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Praxisdaten</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Name</label>
          <input type="text" name="practice_name" value="<?= e($pr['name'] ?? '') ?>">
        </div>
        <div class="field"><label>Praxisname</label>
          <input type="text" name="practice_company" value="<?= e($pr['company'] ?? '') ?>">
        </div>
      </div>
      <div class="row2">
        <div class="field"><label>Straße</label>
          <input type="text" name="practice_street" value="<?= e($pr['street'] ?? '') ?>">
        </div>
        <div class="field"><label>Stadt / PLZ</label>
          <input type="text" name="practice_city" value="<?= e($pr['city'] ?? '') ?>">
        </div>
      </div>
      <div class="row2">
        <div class="field"><label>Telefon</label>
          <input type="text" name="practice_phone" value="<?= e($pr['phone'] ?? '') ?>">
        </div>
        <div class="field"><label>E-Mail</label>
          <input type="text" name="practice_email" value="<?= e($pr['email'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- BERUF -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Berufsbezeichnung</div>
    <div class="section-body">
      <div class="field"><label>Zeilen (eine pro Zeile)</label>
        <textarea name="beruf_lines" rows="4"><?= e(implode("\n", $ber['lines'] ?? [])) ?></textarea>
      </div>
    </div>
  </div>

  <!-- KAMMER -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Zuständige Kammer</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Name</label>
          <input type="text" name="kammer_name" value="<?= e($kam['name'] ?? '') ?>">
        </div>
        <div class="field"><label>Straße</label>
          <input type="text" name="kammer_street" value="<?= e($kam['street'] ?? '') ?>">
        </div>
      </div>
      <div class="row2">
        <div class="field"><label>Stadt / PLZ</label>
          <input type="text" name="kammer_city" value="<?= e($kam['city'] ?? '') ?>">
        </div>
        <div class="field"><label>Website-URL</label>
          <input type="text" name="kammer_url" value="<?= e($kam['url'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- AUFSICHT -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Zuständige Aufsichtsbehörde</div>
    <div class="section-body">
      <div class="row2">
        <div class="field"><label>Name</label>
          <input type="text" name="aufsicht_name" value="<?= e($auf['name'] ?? '') ?>">
        </div>
        <div class="field"><label>Straße</label>
          <input type="text" name="aufsicht_street" value="<?= e($auf['street'] ?? '') ?>">
        </div>
      </div>
      <div class="row2">
        <div class="field"><label>Stadt / PLZ</label>
          <input type="text" name="aufsicht_city" value="<?= e($auf['city'] ?? '') ?>">
        </div>
        <div class="field"><label>Website-URL</label>
          <input type="text" name="aufsicht_url" value="<?= e($auf['url'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- BERUFSRECHT -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Berufsrechtliche Regelungen</div>
    <div class="section-body">
      <div class="field"><label>Gesetze (eine pro Zeile)</label>
        <textarea name="berufsrecht_laws" rows="4"><?= e(implode("\n", $br['laws'] ?? [])) ?></textarea>
      </div>
    </div>
  </div>

  <!-- HAFTUNG INHALTE -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Haftung für Inhalte</div>
    <div class="section-body">
      <?php foreach ($hi['paragraphs'] ?? [] as $i => $para): ?>
      <div class="field"><label>Absatz <?= $i+1 ?></label>
        <textarea name="haftung_inhalte_<?= $i ?>" rows="3"><?= e($para) ?></textarea>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- HAFTUNG LINKS -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Haftung für Links</div>
    <div class="section-body">
      <?php foreach ($hl['paragraphs'] ?? [] as $i => $para): ?>
      <div class="field"><label>Absatz <?= $i+1 ?></label>
        <textarea name="haftung_links_<?= $i ?>" rows="3"><?= e($para) ?></textarea>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- URHEBERRECHT -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Urheberrecht</div>
    <div class="section-body">
      <?php foreach ($ur['paragraphs'] ?? [] as $i => $para): ?>
      <div class="field"><label>Absatz <?= $i+1 ?></label>
        <textarea name="urheberrecht_<?= $i ?>" rows="3"><?= e($para) ?></textarea>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($section === 'datenschutz'):
    $sections = $c['sections'] ?? [];
  ?>

  <!-- META -->
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> Meta</div>
    <div class="section-body">
      <div class="field"><label>Seiten-Titel</label>
        <input type="text" name="meta_title" value="<?= e($c['meta']['title'] ?? '') ?>">
      </div>
    </div>
  </div>

  <!-- ABSCHNITTE -->
  <?php foreach ($sections as $si => $sec): ?>
  <div class="section-block">
    <div class="section-header"><span class="dot"></span> <?= e($sec['heading']) ?></div>
    <div class="section-body">

      <?php foreach ($sec['paragraphs'] ?? [] as $pi => $para): ?>
      <div class="field"><label>Absatz <?= $pi+1 ?></label>
        <textarea name="sec_<?= $si ?>_p_<?= $pi ?>" rows="3"><?= e($para) ?></textarea>
      </div>
      <?php endforeach; ?>

      <?php if (!empty($sec['list'])): ?>
      <div class="field"><label>Liste (eine pro Zeile)</label>
        <textarea name="sec_<?= $si ?>_list" rows="<?= max(4, count($sec['list'])) ?>"><?= e(implode("\n", $sec['list'])) ?></textarea>
      </div>
      <?php endif; ?>

      <?php foreach ($sec['subsections'] ?? [] as $ssi => $sub): ?>
      <div class="sub-block">
        <div class="sub-block-title"><?= e($sub['heading'] ?? '') ?></div>
        <?php foreach ($sub['paragraphs'] ?? [] as $pi => $para): ?>
        <div class="field"><label>Absatz <?= $pi+1 ?></label>
          <textarea name="sec_<?= $si ?>_sub_<?= $ssi ?>_p_<?= $pi ?>" rows="3"><?= e($para) ?></textarea>
        </div>
        <?php endforeach; ?>
        <?php if (!empty($sub['list'])): ?>
        <div class="field"><label>Liste (eine pro Zeile)</label>
          <textarea name="sec_<?= $si ?>_sub_<?= $ssi ?>_list" rows="<?= max(4, count($sub['list'])) ?>"><?= e(implode("\n", $sub['list'])) ?></textarea>
        </div>
        <?php endif; ?>
        <?php foreach ($sub['paragraphs_after'] ?? [] as $pi => $para): ?>
        <div class="field"><label>Absatz nach Liste <?= $pi+1 ?></label>
          <textarea name="sec_<?= $si ?>_sub_<?= $ssi ?>_pa_<?= $pi ?>" rows="3"><?= e($para) ?></textarea>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
  <?php endforeach; ?>

  <?php endif; ?>
  </form>
  <?php endif; ?>

  </main>
</div>

<!-- ══ MEDIA PICKER MODAL ══ -->
<div class="modal-backdrop" id="mediaPicker">
  <div class="modal">
    <div class="modal-header">
      <h2>Bild auswählen</h2>
      <button class="modal-close" onclick="MediaPicker.close()">✕</button>
    </div>
    <div class="modal-body">
      <div class="picker-upload-row" id="pickerUploadRow" onclick="document.getElementById('pickerFileInput').click()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
        </svg>
        <span>Neues Bild hochladen – <strong>Datei auswählen</strong></span>
        <input type="file" id="pickerFileInput" accept="image/*" style="display:none">
      </div>
      <div class="picker-grid" id="pickerGrid"><div class="picker-loading">Lade Bilder…</div></div>
    </div>
    <div class="modal-footer">
      <button class="btn-ghost" onclick="MediaPicker.close()">Abbrechen</button>
      <button class="btn-primary-sm" id="pickerConfirm" onclick="MediaPicker.confirm()" disabled>Übernehmen</button>
    </div>
  </div>
</div>
<input type="file" id="fileInputLib" accept="image/*" multiple style="display:none">

<script>
function fmtSize(b){if(b<1024)return b+' B';if(b<1024*1024)return(b/1024).toFixed(0)+' KB';return(b/1024/1024).toFixed(1)+' MB';}

const MediaPicker={
  _inputEl:null,_previewEl:null,_nameEl:null,_selected:null,
  open(inputId,previewId,nameId){
    this._inputEl=document.getElementById(inputId);
    this._previewEl=previewId?document.getElementById(previewId):null;
    this._nameEl=nameId?document.getElementById(nameId):null;
    this._selected=this._inputEl?.value||null;
    document.getElementById('pickerConfirm').disabled=!this._selected;
    document.getElementById('mediaPicker').classList.add('open');
    this._loadImages();
  },
  close(){document.getElementById('mediaPicker').classList.remove('open');this._selected=null;},
  confirm(){
    if(!this._selected)return;
    if(this._inputEl)this._inputEl.value=this._selected;
    if(this._previewEl){
      this._previewEl.src='../'+this._selected;
      this._previewEl.style.display='';
      const empty=this._previewEl.parentElement?.querySelector('.img-thumb-empty');
      if(empty)empty.style.display='none';
    }
    if(this._nameEl)this._nameEl.textContent=this._selected.split('/').pop();
    this.close();
  },
  async _loadImages(){
    const grid=document.getElementById('pickerGrid');
    grid.innerHTML='<div class="picker-loading">Lade…</div>';
    const imgs=await fetch('api.php?action=list').then(r=>r.json());
    grid.innerHTML='';
    if(!imgs.length){grid.innerHTML='<div class="picker-loading">Noch keine Bilder.</div>';return;}
    imgs.forEach(img=>{
      const div=document.createElement('div');
      div.className='picker-item'+(img.path===this._selected?' selected':'');
      div.innerHTML=`<img src="../${img.path}" alt="${img.name}" loading="lazy"><div class="pi-name">${img.name}</div><div class="pi-check">✓</div>`;
      div.onclick=()=>{
        document.querySelectorAll('.picker-item').forEach(el=>el.classList.remove('selected'));
        div.classList.add('selected');
        this._selected=img.path;
        document.getElementById('pickerConfirm').disabled=false;
      };
      grid.appendChild(div);
    });
  }
};

document.getElementById('pickerFileInput').addEventListener('change',e=>{if(e.target.files[0])MediaPicker._upload(e.target.files[0]);});
document.getElementById('mediaPicker').addEventListener('click',e=>{if(e.target===document.getElementById('mediaPicker'))MediaPicker.close();});

<?php if ($section === 'media'): ?>
async function loadLibrary(){
  const grid=document.getElementById('mediaGrid');
  const imgs=await fetch('api.php?action=list').then(r=>r.json());
  grid.innerHTML='';
  if(!imgs.length){grid.innerHTML='<div class="media-empty">Noch keine Bilder.</div>';return;}
  imgs.forEach(img=>{
    const card=document.createElement('div');
    card.className='media-card';
    card.innerHTML=`<img class="mc-img" src="../${img.path}" alt="${img.name}" loading="lazy"><div class="mc-info"><div class="mc-name">${img.name}</div><div class="mc-size">${fmtSize(img.size)}</div></div><button class="mc-del" title="Löschen" onclick="deleteImg('${img.name}',this)">✕</button>`;
    grid.appendChild(card);
  });
}
async function deleteImg(name,btn){
  if(!confirm(`„${name}" wirklich löschen?`))return;
  btn.textContent='…';
  const fd=new FormData();fd.append('name',name);
  const r=await fetch('api.php?action=delete',{method:'POST',body:fd}).then(r=>r.json());
  if(r.success)btn.closest('.media-card').remove();
  else alert('Fehler: '+r.error);
}
document.getElementById('fileInputLib').addEventListener('change',e=>{libUpload(e.target.files);e.target.value='';});
const dz=document.getElementById('dropZone');
dz.addEventListener('dragover',e=>{e.preventDefault();dz.classList.add('drag-over');});
dz.addEventListener('dragleave',()=>dz.classList.remove('drag-over'));
dz.addEventListener('drop',e=>{e.preventDefault();dz.classList.remove('drag-over');libUpload(e.dataTransfer.files);});
async function libUpload(files){
  const prog=document.getElementById('libProgress'),bar=document.getElementById('libBar');
  prog.style.display='block';
  for(const file of files){bar.style.width='30%';const fd=new FormData();fd.append('file',file);const r=await fetch('api.php?action=upload',{method:'POST',body:fd}).then(r=>r.json());bar.style.width='100%';if(!r.success)alert('Fehler: '+r.error);}
  setTimeout(()=>{prog.style.display='none';bar.style.width='0';},400);loadLibrary();
}
loadLibrary();
<?php endif; ?>

<?php if ($section !== 'media'): ?>
const form=document.getElementById('adminForm');
form?.addEventListener('submit',async e=>{
  e.preventDefault();
  const data=new FormData(form);
  const res=await fetch(form.action,{method:'POST',body:data});
  const json=await res.json();
  if(res.status===401||json.login){window.location.href='login.php';return;}
  if(json.success){const u=new URL(window.location.href);u.searchParams.set('saved','1');window.location.href=u.toString();}
  else alert('Fehler: '+(json.error??'Unbekannter Fehler'));
});
<?php endif; ?>
</script>
</body>
</html>
