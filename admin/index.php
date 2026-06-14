<?php
require __DIR__ . '/auth.php';
$section = $_GET['section'] ?? 'index';
$validSections = ['index', 'hero', 'menu', 'footer', 'media'];
if (!in_array($section, $validSections)) $section = 'index';

$c = [];
if ($section !== 'media') {
    $jsonFile = __DIR__ . "/../content/{$section}.json";
    $c = json_decode(file_get_contents($jsonFile), true) ?? [];
}

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function ta($arr) { return implode("\n", (array)$arr); }

$saved = isset($_GET['saved']);

$nav = [
    'index'  => ['label' => 'Hauptseite',       'file' => 'index.json',  'sub' => 'Meta · Logos · How · Services · KI · Preise · Testimonials · CTA'],
    'hero'   => ['label' => 'Hero',              'file' => 'hero.json',   'sub' => 'Bild · Headline · CTAs · Trust · Chips'],
    'menu'   => ['label' => 'Navigation',        'file' => 'menu.json',   'sub' => 'Logo · Links · Buttons'],
    'footer' => ['label' => 'Footer',            'file' => 'footer.json', 'sub' => 'Brand · Spalten · Copyright'],
    'media'  => ['label' => 'Bilder-Bibliothek', 'file' => null,          'sub' => 'Hochladen · Verwalten'],
];
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Admin – <?= $nav[$section]['label'] ?> – MaxaBit</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<?php if ($saved): ?>
<div class="toast" id="toast">✓ <?= $nav[$section]['file'] ?? 'Gespeichert' ?></div>
<script>setTimeout(()=>document.getElementById('toast')?.remove(),3000)</script>
<?php endif; ?>

<div class="admin-bar">
  <h1>MaxaBit <span>Admin</span></h1>
  <div class="bar-right">
    <?php if ($section !== 'media'): ?>
    <span class="file-badge">content/<?= $nav[$section]['file'] ?></span>
    <button class="btn-save" form="adminForm">Speichern</button>
    <?php else: ?>
    <span class="file-badge">images/</span>
    <?php endif; ?>
    <a href="logout.php" class="btn-logout">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
           stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/>
        <line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
      Abmelden
    </a>
  </div>
</div>

<div class="layout">
  <nav class="sidebar">
    <div class="sidebar-group">Content-Dateien</div>
    <?php foreach (['index','hero','menu','footer'] as $key): ?>
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
  <!-- ══════════════ MEDIA LIBRARY ══════════════ -->
  <div class="media-upload-zone" id="dropZone">
    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
      <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
    </svg>
    <p>Bilder hierher ziehen</p>
    <small>JPG, PNG, WebP, GIF, SVG · max. 10 MB</small>
    <br>
    <button class="btn-upload-choose" onclick="document.getElementById('fileInputLib').click()">Datei auswählen</button>
    <input type="file" id="fileInputLib" accept="image/*" multiple style="display:none">
    <div class="upload-progress" id="libProgress">
      <div class="upload-bar-bg"><div class="upload-bar-fill" id="libBar"></div></div>
    </div>
  </div>

  <div class="media-grid" id="mediaGrid">
    <div class="media-empty">Lade Bilder…</div>
  </div>

  <?php else: ?>
  <!-- ══════════════ CONTENT FORM ══════════════ -->
  <form id="adminForm" method="POST" action="save.php?section=<?= $section ?>">

  <?php if ($section === 'index'): ?>

    <div class="section-block" id="meta">
      <div class="section-header"><span class="dot"></span> Meta</div>
      <div class="section-body">
        <div class="field">
          <label>Seiten-Titel (Browser-Tab)</label>
          <input type="text" name="meta_title" value="<?= e($c['meta']['title']) ?>">
        </div>
      </div>
    </div>

    <div class="section-block" id="logos">
      <div class="section-header"><span class="dot"></span> Logos-Band</div>
      <div class="section-body">
        <div class="field">
          <label>Beschriftung</label>
          <input type="text" name="logos_label" value="<?= e($c['logos']['label']) ?>">
        </div>
        <div class="field">
          <label>Einträge</label>
          <textarea name="logos_items" rows="5"><?= e(ta($c['logos']['items'])) ?></textarea>
          <span class="hint">Ein Eintrag pro Zeile</span>
        </div>
      </div>
    </div>

    <div class="section-block" id="how">
      <div class="section-header"><span class="dot"></span> How It Works</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="how_section_label" value="<?= e($c['how']['section_label']) ?>">
          </div>
          <div class="field" style="grid-column:span 2">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="how_headline" value="<?= e($c['how']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext</label>
          <input type="text" name="how_sub" value="<?= e($c['how']['sub']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['how']['steps'] as $i => $step): ?>
        <div class="sub-block">
          <div class="sub-block-title">Schritt <?= e($step['num']) ?></div>
          <div class="row2">
            <div class="field">
              <label>Titel</label>
              <input type="text" name="how_step_<?= $i ?>_title" value="<?= e($step['title']) ?>">
            </div>
            <div class="field">
              <label>Text</label>
              <input type="text" name="how_step_<?= $i ?>_text" value="<?= e($step['text']) ?>">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section-block" id="services">
      <div class="section-header"><span class="dot"></span> Services</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="srv_section_label" value="<?= e($c['services']['section_label']) ?>">
          </div>
          <div class="field" style="grid-column:span 2">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="srv_headline" value="<?= e($c['services']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext</label>
          <input type="text" name="srv_sub" value="<?= e($c['services']['sub']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['services']['items'] as $i => $srv): ?>
        <div class="sub-block">
          <div class="sub-block-title"><?= e($srv['title']) ?></div>
          <div class="row3">
            <div class="field">
              <label>Badge</label>
              <input type="text" name="srv_<?= $i ?>_badge" value="<?= e($srv['badge']) ?>">
            </div>
            <div class="field">
              <label>Titel</label>
              <input type="text" name="srv_<?= $i ?>_title" value="<?= e($srv['title']) ?>">
            </div>
            <div class="field">
              <label>Beschreibung</label>
              <input type="text" name="srv_<?= $i ?>_text" value="<?= e($srv['text']) ?>">
            </div>
          </div>
          <div class="field">
            <label>Features</label>
            <textarea name="srv_<?= $i ?>_features" rows="3"><?= e(ta($srv['features'])) ?></textarea>
            <span class="hint">Ein Feature pro Zeile</span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section-block" id="ai">
      <div class="section-header"><span class="dot"></span> KI-Sektion</div>
      <div class="section-body">
        <div class="sub-block">
          <div class="sub-block-title">Karte (links)</div>
          <div class="row2">
            <div class="field">
              <label>Karten-Label</label>
              <input type="text" name="ai_card_label" value="<?= e($c['ai']['card_label']) ?>">
            </div>
            <div class="field">
              <label>Karten-Titel (HTML erlaubt)</label>
              <input type="text" name="ai_card_title" value="<?= e($c['ai']['card_title']) ?>">
            </div>
          </div>
          <?php $aiImg = $c['ai']['card_image'] ?? ''; ?>
          <div class="field"><label>Karten-Bild (optional)</label></div>
          <div class="img-picker-field">
            <div class="img-thumb-wrap">
              <img id="prev_ai_card_image" src="<?= $aiImg ? '../'.e($aiImg) : '' ?>"
                   alt="" style="<?= $aiImg ? '' : 'display:none' ?>">
              <?php if (!$aiImg): ?><span class="img-thumb-empty">Kein Bild</span><?php endif; ?>
            </div>
            <input type="hidden" name="ai_card_image" id="fld_ai_card_image" value="<?= e($aiImg) ?>">
            <div class="img-picker-meta">
              <div class="img-picker-filename" id="name_ai_card_image"><?= $aiImg ? e(basename($aiImg)) : '–' ?></div>
              <button type="button" class="btn-pick"
                onclick="MediaPicker.open('fld_ai_card_image','prev_ai_card_image','name_ai_card_image')">
                Bild auswählen
              </button>
              <?php if ($aiImg): ?>
              <button type="button" class="btn-pick" style="margin-top:4px;color:#f87171;border-color:#f871714d"
                onclick="document.getElementById('fld_ai_card_image').value='';
                         document.getElementById('prev_ai_card_image').style.display='none';
                         document.getElementById('name_ai_card_image').textContent='–';
                         this.previousElementSibling.style.display='';">
                Bild entfernen
              </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="sub-block">
          <div class="sub-block-title">Fortschrittsbalken</div>
          <?php foreach ($c['ai']['progress'] as $i => $p): ?>
          <div class="row2">
            <div class="field">
              <label>Label <?= $i+1 ?></label>
              <input type="text" name="ai_prog_<?= $i ?>_label" value="<?= e($p['label']) ?>">
            </div>
            <div class="field">
              <label>Wert <?= $i+1 ?></label>
              <input type="text" name="ai_prog_<?= $i ?>_value" value="<?= e($p['value']) ?>">
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="sub-block">
          <div class="sub-block-title">Floater-Chips</div>
          <?php foreach ($c['ai']['floaters'] as $i => $f): ?>
          <div class="row2">
            <div class="field">
              <label>Text <?= $i+1 ?></label>
              <input type="text" name="ai_float_<?= $i ?>_text" value="<?= e($f['text']) ?>">
            </div>
            <div class="field">
              <label>Wert <?= $i+1 ?></label>
              <input type="text" name="ai_float_<?= $i ?>_val" value="<?= e($f['val']) ?>">
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <hr class="divider">
        <div class="row3">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="ai_section_label" value="<?= e($c['ai']['section_label']) ?>">
          </div>
          <div class="field" style="grid-column:span 2">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="ai_headline" value="<?= e($c['ai']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext (HTML erlaubt)</label>
          <textarea name="ai_sub" rows="2"><?= e($c['ai']['sub']) ?></textarea>
        </div>
        <div class="sub-block">
          <div class="sub-block-title">Side-Cards</div>
          <?php foreach ($c['ai']['side_cards'] as $i => $sc): ?>
          <div class="row2">
            <div class="field">
              <label>Label <?= $i+1 ?></label>
              <input type="text" name="ai_sc_<?= $i ?>_label" value="<?= e($sc['label']) ?>">
            </div>
            <div class="field">
              <label>Sub <?= $i+1 ?></label>
              <input type="text" name="ai_sc_<?= $i ?>_sub" value="<?= e($sc['sub']) ?>">
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="field">
          <label>Pills</label>
          <textarea name="ai_pills" rows="3"><?= e(ta($c['ai']['pills'])) ?></textarea>
          <span class="hint">Eine Pill pro Zeile</span>
        </div>
        <div class="row2">
          <div class="field">
            <label>CTA-Label</label>
            <input type="text" name="ai_cta_label" value="<?= e($c['ai']['cta']['label']) ?>">
          </div>
          <div class="field">
            <label>CTA-Link</label>
            <input type="text" name="ai_cta_href" value="<?= e($c['ai']['cta']['href']) ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="section-block" id="pricing">
      <div class="section-header"><span class="dot"></span> Preise</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="price_section_label" value="<?= e($c['pricing']['section_label']) ?>">
          </div>
          <div class="field" style="grid-column:span 2">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="price_headline" value="<?= e($c['pricing']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext</label>
          <input type="text" name="price_sub" value="<?= e($c['pricing']['sub']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['pricing']['plans'] as $i => $plan): ?>
        <div class="sub-block">
          <div class="sub-block-title"><?= e($plan['name']) ?></div>
          <div class="row3">
            <div class="field">
              <label>Tag</label>
              <input type="text" name="plan_<?= $i ?>_tag" value="<?= e($plan['tag']) ?>">
            </div>
            <div class="field">
              <label>Name</label>
              <input type="text" name="plan_<?= $i ?>_name" value="<?= e($plan['name']) ?>">
            </div>
            <div class="field">
              <label>Beschreibung</label>
              <input type="text" name="plan_<?= $i ?>_desc" value="<?= e($plan['desc']) ?>">
            </div>
          </div>
          <div class="row3">
            <div class="field">
              <label>Preis</label>
              <input type="text" name="plan_<?= $i ?>_price" value="<?= e($plan['price']) ?>">
            </div>
            <div class="field">
              <label>Zeitraum</label>
              <input type="text" name="plan_<?= $i ?>_period" value="<?= e($plan['period']) ?>">
            </div>
            <div class="field">
              <label>CTA-Text</label>
              <input type="text" name="plan_<?= $i ?>_cta" value="<?= e($plan['cta']) ?>">
            </div>
          </div>
          <div class="field">
            <label>Features</label>
            <textarea name="plan_<?= $i ?>_features" rows="4"><?= e(ta($plan['features'])) ?></textarea>
            <span class="hint">Ein Feature pro Zeile</span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section-block" id="testimonials">
      <div class="section-header"><span class="dot"></span> Kundenstimmen</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="testi_section_label" value="<?= e($c['testimonials']['section_label']) ?>">
          </div>
          <div class="field" style="grid-column:span 2">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="testi_headline" value="<?= e($c['testimonials']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext</label>
          <input type="text" name="testi_sub" value="<?= e($c['testimonials']['sub']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['testimonials']['items'] as $i => $t): ?>
        <div class="sub-block">
          <div class="sub-block-title"><?= e($t['name']) ?></div>
          <div class="row2">
            <div class="field">
              <label>Name</label>
              <input type="text" name="testi_<?= $i ?>_name" value="<?= e($t['name']) ?>">
            </div>
            <div class="field">
              <label>Rolle</label>
              <input type="text" name="testi_<?= $i ?>_role" value="<?= e($t['role']) ?>">
            </div>
          </div>
          <div class="field">
            <label>Zitat</label>
            <textarea name="testi_<?= $i ?>_text" rows="3"><?= e($t['text']) ?></textarea>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section-block" id="cta">
      <div class="section-header"><span class="dot"></span> CTA-Bereich</div>
      <div class="section-body">
        <div class="row2">
          <div class="field">
            <label>Sektion-Label</label>
            <input type="text" name="cta_section_label" value="<?= e($c['cta']['section_label']) ?>">
          </div>
          <div class="field">
            <label>Headline (HTML erlaubt)</label>
            <input type="text" name="cta_headline" value="<?= e($c['cta']['headline']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Subtext</label>
          <textarea name="cta_sub" rows="2"><?= e($c['cta']['sub']) ?></textarea>
        </div>
        <div class="row2">
          <div class="sub-block">
            <div class="sub-block-title">Primär-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_primary_label" value="<?= e($c['cta']['primary']['label']) ?>">
            </div>
            <div class="field">
              <label>Link (href)</label>
              <input type="text" name="cta_primary_href" value="<?= e($c['cta']['primary']['href']) ?>">
            </div>
          </div>
          <div class="sub-block">
            <div class="sub-block-title">Ghost-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_ghost_label" value="<?= e($c['cta']['ghost']['label']) ?>">
            </div>
            <div class="field">
              <label>Link (href)</label>
              <input type="text" name="cta_ghost_href" value="<?= e($c['cta']['ghost']['href']) ?>">
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php elseif ($section === 'hero'): ?>
  <?php $imgSrc = $c['image'] ?? ''; ?>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Hero-Bild</div>
      <div class="section-body">
        <div class="img-picker-field">
          <div class="img-thumb-wrap">
            <img id="prev_image" src="<?= $imgSrc ? '../'.e($imgSrc) : '' ?>"
                 alt="" style="<?= $imgSrc ? '' : 'display:none' ?>">
            <?php if (!$imgSrc): ?>
            <span class="img-thumb-empty">Kein Bild</span>
            <?php endif; ?>
          </div>
          <input type="hidden" name="image" id="fld_image" value="<?= e($imgSrc) ?>">
          <div class="img-picker-meta">
            <div class="img-picker-filename" id="name_image"><?= $imgSrc ? e(basename($imgSrc)) : '–' ?></div>
            <button type="button" class="btn-pick"
              onclick="MediaPicker.open('fld_image','prev_image','name_image')">
              Bild auswählen
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Tag & Headline</div>
      <div class="section-body">
        <div class="field">
          <label>Tag (kleines Label über der Headline)</label>
          <input type="text" name="tag" value="<?= e($c['tag']) ?>">
        </div>
        <div class="field">
          <label>Headline (HTML erlaubt, z.B. &lt;br&gt;)</label>
          <textarea name="headline" rows="3"><?= e($c['headline']) ?></textarea>
        </div>
        <div class="field">
          <label>Subtext (HTML erlaubt)</label>
          <textarea name="sub" rows="3"><?= e($c['sub']) ?></textarea>
        </div>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> CTA-Buttons</div>
      <div class="section-body">
        <div class="row2">
          <div class="sub-block">
            <div class="sub-block-title">Primär-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_primary_label" value="<?= e($c['cta_primary']['label']) ?>">
            </div>
            <div class="field">
              <label>Link (href)</label>
              <input type="text" name="cta_primary_href" value="<?= e($c['cta_primary']['href']) ?>">
            </div>
          </div>
          <div class="sub-block">
            <div class="sub-block-title">Sekundär-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_secondary_label" value="<?= e($c['cta_secondary']['label']) ?>">
            </div>
            <div class="field">
              <label>Link (href)</label>
              <input type="text" name="cta_secondary_href" value="<?= e($c['cta_secondary']['href']) ?>">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Trust-Bereich</div>
      <div class="section-body">
        <div class="field">
          <label>Avatare (Initialen)</label>
          <textarea name="trust_avatars" rows="3"><?= e(ta($c['trust']['avatars'])) ?></textarea>
          <span class="hint">Zwei Buchstaben pro Zeile, z.B. MK</span>
        </div>
        <div class="row2">
          <div class="field">
            <label>Anzahl / Beschriftung</label>
            <input type="text" name="trust_count" value="<?= e($c['trust']['count']) ?>">
          </div>
          <div class="field">
            <label>Bewertung</label>
            <input type="text" name="trust_rating" value="<?= e($c['trust']['rating']) ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Screen & Float-Chips</div>
      <div class="section-body">
        <div class="field">
          <label>Screen URL (Mock-Browserleiste)</label>
          <input type="text" name="screen_url" value="<?= e($c['screen_url']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['chips'] as $i => $chip): ?>
        <div class="sub-block">
          <div class="sub-block-title">Chip <?= $i+1 ?></div>
          <div class="row2">
            <div class="field">
              <label>Label</label>
              <input type="text" name="chip_<?= $i ?>_label" value="<?= e($chip['label']) ?>">
            </div>
            <div class="field">
              <label>Subtext</label>
              <input type="text" name="chip_<?= $i ?>_sub" value="<?= e($chip['sub']) ?>">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  <?php elseif ($section === 'menu'): ?>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Logo</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Name</label>
            <input type="text" name="logo_name" value="<?= e($c['logo']['name']) ?>">
          </div>
          <div class="field">
            <label>Suffix</label>
            <input type="text" name="logo_suffix" value="<?= e($c['logo']['suffix']) ?>">
          </div>
          <div class="field">
            <label>Link (href)</label>
            <input type="text" name="logo_href" value="<?= e($c['logo']['href']) ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Navigationslinks</div>
      <div class="section-body">
        <?php foreach ($c['links'] as $i => $link): ?>
        <div class="sub-block">
          <div class="sub-block-title">Link <?= $i+1 ?></div>
          <div class="row2">
            <div class="field">
              <label>Label</label>
              <input type="text" name="link_<?= $i ?>_label" value="<?= e($link['label']) ?>">
            </div>
            <div class="field">
              <label>href</label>
              <input type="text" name="link_<?= $i ?>_href" value="<?= e($link['href']) ?>">
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Buttons (rechts)</div>
      <div class="section-body">
        <div class="row2">
          <div class="sub-block">
            <div class="sub-block-title">Ghost-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_ghost_label" value="<?= e($c['cta_ghost']['label']) ?>">
            </div>
            <div class="field">
              <label>href</label>
              <input type="text" name="cta_ghost_href" value="<?= e($c['cta_ghost']['href']) ?>">
            </div>
          </div>
          <div class="sub-block">
            <div class="sub-block-title">Primär-Button</div>
            <div class="field">
              <label>Label</label>
              <input type="text" name="cta_primary_label" value="<?= e($c['cta_primary']['label']) ?>">
            </div>
            <div class="field">
              <label>href</label>
              <input type="text" name="cta_primary_href" value="<?= e($c['cta_primary']['href']) ?>">
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php elseif ($section === 'footer'): ?>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Brand</div>
      <div class="section-body">
        <div class="row3">
          <div class="field">
            <label>Logo Name</label>
            <input type="text" name="logo_name" value="<?= e($c['logo']['name']) ?>">
          </div>
          <div class="field">
            <label>Logo Suffix</label>
            <input type="text" name="logo_suffix" value="<?= e($c['logo']['suffix']) ?>">
          </div>
          <div class="field">
            <label>Logo Link</label>
            <input type="text" name="logo_href" value="<?= e($c['logo']['href']) ?>">
          </div>
        </div>
        <div class="field">
          <label>Brand-Text</label>
          <textarea name="brand_text" rows="2"><?= e($c['brand_text']) ?></textarea>
        </div>
        <div class="field">
          <label>KI-Badge</label>
          <input type="text" name="badge" value="<?= e($c['badge']) ?>">
        </div>
      </div>
    </div>

    <?php foreach ($c['cols'] as $i => $col): ?>
    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Spalte <?= $i+1 ?>: <?= e($col['title']) ?></div>
      <div class="section-body">
        <div class="field">
          <label>Spalten-Titel</label>
          <input type="text" name="col_<?= $i ?>_title" value="<?= e($col['title']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($col['links'] as $j => $link): ?>
        <div class="row2">
          <div class="field">
            <label>Link <?= $j+1 ?> Label</label>
            <input type="text" name="col_<?= $i ?>_link_<?= $j ?>_label" value="<?= e($link['label']) ?>">
          </div>
          <div class="field">
            <label>Link <?= $j+1 ?> href</label>
            <input type="text" name="col_<?= $i ?>_link_<?= $j ?>_href" value="<?= e($link['href']) ?>">
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <div class="section-block">
      <div class="section-header"><span class="dot"></span> Footer-Bottom</div>
      <div class="section-body">
        <div class="field">
          <label>Copyright-Text</label>
          <input type="text" name="copy" value="<?= e($c['copy']) ?>">
        </div>
        <hr class="divider">
        <?php foreach ($c['bottom_links'] as $i => $link): ?>
        <div class="row2">
          <div class="field">
            <label>Link <?= $i+1 ?> Label</label>
            <input type="text" name="bottom_link_<?= $i ?>_label" value="<?= e($link['label']) ?>">
          </div>
          <div class="field">
            <label>Link <?= $i+1 ?> href</label>
            <input type="text" name="bottom_link_<?= $i ?>_href" value="<?= e($link['href']) ?>">
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

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
      <div class="picker-upload-row" id="pickerUploadRow"
           onclick="document.getElementById('pickerFileInput').click()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
        </svg>
        <span>Neues Bild hochladen — <strong>Datei auswählen</strong></span>
        <input type="file" id="pickerFileInput" accept="image/*" style="display:none">
      </div>
      <div class="picker-grid" id="pickerGrid">
        <div class="picker-loading">Lade Bilder…</div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-ghost" onclick="MediaPicker.close()">Abbrechen</button>
      <button class="btn-primary-sm" id="pickerConfirm"
              onclick="MediaPicker.confirm()" disabled>Übernehmen</button>
    </div>
  </div>
</div>

<!-- hidden file input for library page -->
<input type="file" id="fileInputLib" accept="image/*" multiple style="display:none">

<script>
function fmtSize(b) {
  if (b < 1024) return b + ' B';
  if (b < 1024*1024) return (b/1024).toFixed(0) + ' KB';
  return (b/1024/1024).toFixed(1) + ' MB';
}

/* ══ MEDIA PICKER ══ */
const MediaPicker = {
  _inputEl: null, _previewEl: null, _nameEl: null, _selected: null,

  open(inputId, previewId, nameId) {
    this._inputEl   = document.getElementById(inputId);
    this._previewEl = previewId ? document.getElementById(previewId) : null;
    this._nameEl    = nameId   ? document.getElementById(nameId)    : null;
    this._selected  = this._inputEl?.value || null;
    document.getElementById('pickerConfirm').disabled = !this._selected;
    document.getElementById('mediaPicker').classList.add('open');
    this._loadImages();
  },

  close() {
    document.getElementById('mediaPicker').classList.remove('open');
    this._selected = null;
  },

  confirm() {
    if (!this._selected) return;
    if (this._inputEl)   this._inputEl.value = this._selected;
    if (this._previewEl) {
      this._previewEl.src = '../' + this._selected;
      this._previewEl.style.display = '';
    }
    if (this._nameEl) this._nameEl.textContent = this._selected.split('/').pop();
    this.close();
  },

  async _loadImages() {
    const grid = document.getElementById('pickerGrid');
    grid.innerHTML = '<div class="picker-loading">Lade…</div>';
    const imgs = await fetch('api.php?action=list').then(r=>r.json());
    grid.innerHTML = '';
    if (!imgs.length) {
      grid.innerHTML = '<div class="picker-loading">Noch keine Bilder vorhanden.</div>';
      return;
    }
    imgs.forEach(img => {
      const div = document.createElement('div');
      div.className = 'picker-item' + (img.path === this._selected ? ' selected' : '');
      div.innerHTML = `
        <img src="../${img.path}" alt="${img.name}" loading="lazy">
        <div class="pi-name">${img.name}</div>
        <div class="pi-check">✓</div>`;
      div.onclick = () => {
        document.querySelectorAll('.picker-item').forEach(el=>el.classList.remove('selected'));
        div.classList.add('selected');
        this._selected = img.path;
        document.getElementById('pickerConfirm').disabled = false;
      };
      grid.appendChild(div);
    });
  },

  async _upload(file) {
    const fd = new FormData();
    fd.append('file', file);
    const res = await fetch('api.php?action=upload', { method:'POST', body:fd });
    const json = await res.json();
    if (json.success) {
      this._selected = json.path;
      await this._loadImages();
      // Auto-select newly uploaded image
      document.querySelectorAll('.picker-item').forEach(el => {
        if (el.querySelector('.pi-name')?.textContent === json.name) {
          el.classList.add('selected');
        }
      });
      document.getElementById('pickerConfirm').disabled = false;
    } else {
      alert('Upload-Fehler: ' + json.error);
    }
  }
};

// Picker file input
document.getElementById('pickerFileInput').addEventListener('change', e => {
  if (e.target.files[0]) MediaPicker._upload(e.target.files[0]);
});

// Close modal on backdrop click
document.getElementById('mediaPicker').addEventListener('click', e => {
  if (e.target === document.getElementById('mediaPicker')) MediaPicker.close();
});

/* ══ MEDIA LIBRARY PAGE ══ */
<?php if ($section === 'media'): ?>
async function loadLibrary() {
  const grid = document.getElementById('mediaGrid');
  const imgs = await fetch('api.php?action=list').then(r=>r.json());
  grid.innerHTML = '';
  if (!imgs.length) {
    grid.innerHTML = '<div class="media-empty">Noch keine Bilder im Ordner images/</div>';
    return;
  }
  imgs.forEach(img => {
    const card = document.createElement('div');
    card.className = 'media-card';
    card.innerHTML = `
      <img class="mc-img" src="../${img.path}" alt="${img.name}" loading="lazy">
      <div class="mc-info">
        <div class="mc-name">${img.name}</div>
        <div class="mc-size">${fmtSize(img.size)}</div>
      </div>
      <button class="mc-del" title="Löschen" onclick="deleteImg('${img.name}', this)">✕</button>`;
    grid.appendChild(card);
  });
}

async function deleteImg(name, btn) {
  if (!confirm(`„${name}" wirklich löschen?`)) return;
  btn.textContent = '…';
  const fd = new FormData();
  fd.append('name', name);
  const r = await fetch('api.php?action=delete', {method:'POST', body:fd}).then(r=>r.json());
  if (r.success) btn.closest('.media-card').remove();
  else alert('Fehler: ' + r.error);
}

// Upload for library page
async function libUpload(files) {
  const prog = document.getElementById('libProgress');
  const bar  = document.getElementById('libBar');
  prog.style.display = 'block';
  for (const file of files) {
    bar.style.width = '30%';
    const fd = new FormData();
    fd.append('file', file);
    const r = await fetch('api.php?action=upload', {method:'POST', body:fd}).then(r=>r.json());
    bar.style.width = '100%';
    if (!r.success) alert('Fehler: ' + r.error);
  }
  setTimeout(() => { prog.style.display = 'none'; bar.style.width = '0'; }, 400);
  loadLibrary();
}

document.getElementById('fileInputLib').addEventListener('change', e => {
  libUpload(e.target.files);
  e.target.value = '';
});

// Drag & drop on drop zone
const dz = document.getElementById('dropZone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
  e.preventDefault();
  dz.classList.remove('drag-over');
  libUpload(e.dataTransfer.files);
});

loadLibrary();
<?php endif; ?>

/* ══ FORM SAVE (async) ══ */
<?php if ($section !== 'media'): ?>
const form = document.getElementById('adminForm');
form?.addEventListener('submit', async e => {
  e.preventDefault();
  const data = new FormData(form);
  const res  = await fetch(form.action, { method:'POST', body:data });
  const json = await res.json();
  if (res.status === 401 || json.login) { window.location.href = 'login.php'; return; }
  if (json.success) {
    const u = new URL(window.location.href);
    u.searchParams.set('saved','1');
    window.location.href = u.toString();
  } else {
    alert('Fehler: ' + (json.error ?? 'Unbekannter Fehler'));
  }
});
<?php endif; ?>

/* ── Scroll-highlight für index ── */
<?php if ($section === 'index'): ?>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (!e.isIntersecting) return;
    document.querySelectorAll('.sidebar a[href^="#"]').forEach(l=>l.classList.remove('active'));
    const a = document.querySelector(`.sidebar a[href="#${e.target.id}"]`);
    if (a) a.classList.add('active');
  });
}, {threshold:.3});
document.querySelectorAll('.section-block[id]').forEach(s=>obs.observe(s));
<?php endif; ?>
</script>
</body>
</html>
