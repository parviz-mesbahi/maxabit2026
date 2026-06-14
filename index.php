<?php
$c = json_decode(file_get_contents(__DIR__ . '/content/index.json'), true);
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= h($c['meta']['title']) ?></title>
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>

<?php include __DIR__ . '/hero.php'; ?>

<!-- ── LOGOS BAND ── -->
<div class="logos-band">
  <p class="logos-label"><?= h($c['logos']['label']) ?></p>
  <div class="logos-row">
    <?php foreach ($c['logos']['items'] as $item): ?>
    <span class="logo-item"><?= h($item) ?></span>
    <?php endforeach; ?>
  </div>
</div>

<!-- ── HOW IT WORKS ── -->
<section class="how-section" id="prozess">
  <div class="how-head">
    <div class="section-label"><?= h($c['how']['section_label']) ?></div>
    <h2><?= $c['how']['headline'] ?></h2>
    <p class="section-sub"><?= h($c['how']['sub']) ?></p>
  </div>
  <div class="steps">
    <?php foreach ($c['how']['steps'] as $step): ?>
    <div class="step">
      <div class="step-num">
        <?= h($step['num']) ?>
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><?= $step['icon'] ?></svg>
        </div>
      </div>
      <h3><?= h($step['title']) ?></h3>
      <p><?= h($step['text']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── SERVICES ── -->
<section class="services-section" id="leistungen">
  <div class="services-head">
    <div class="section-label"><?= h($c['services']['section_label']) ?></div>
    <h2><?= $c['services']['headline'] ?></h2>
    <p class="section-sub"><?= h($c['services']['sub']) ?></p>
  </div>
  <div class="services-grid">
    <?php foreach ($c['services']['items'] as $srv): ?>
    <div class="srv <?= h($srv['color']) ?>">
      <div class="srv-badge <?= h($srv['badge_class']) ?>"><?= h($srv['badge']) ?></div>
      <div class="srv-icon <?= h($srv['icon_class']) ?>">
        <svg viewBox="0 0 24 24"><?= $srv['icon'] ?></svg>
      </div>
      <h3><?= h($srv['title']) ?></h3>
      <p><?= h($srv['text']) ?></p>
      <ul class="srv-list">
        <?php foreach ($srv['features'] as $f): ?>
        <li><?= h($f) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── KI SECTION ── -->
<section class="ai-section" id="ki">
  <div class="ai-card-main">
    <div class="ai-card-label"><?= h($c['ai']['card_label']) ?></div>
    <div class="ai-card-title"><?= $c['ai']['card_title'] ?></div>
    <?php if (!empty($c['ai']['card_image'])): ?>
    <img src="<?= h($c['ai']['card_image']) ?>" alt="" class="ai-card-img">
    <?php endif; ?>

    <?php foreach ($c['ai']['progress'] as $p): ?>
    <div class="ai-progress-row">
      <div class="ai-progress-label">
        <span><?= h($p['label']) ?></span>
        <span><?= h($p['value']) ?></span>
      </div>
      <div class="ai-bar-bg">
        <div class="ai-bar <?= h($p['bar_class']) ?>"></div>
      </div>
    </div>
    <?php endforeach; ?>

    <div class="ai-floaters">
      <?php foreach ($c['ai']['floaters'] as $f): ?>
      <div class="ai-floater">
        <div class="ai-dot <?= h($f['color']) ?>"></div>
        <div class="ai-floater-text"><?= h($f['text']) ?></div>
        <div class="ai-floater-val"><?= h($f['val']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="ai-text">
    <div class="section-label"><?= h($c['ai']['section_label']) ?></div>
    <h2><?= $c['ai']['headline'] ?></h2>
    <p class="section-sub"><?= $c['ai']['sub'] ?></p>

    <div class="ai-side-cards">
      <?php foreach ($c['ai']['side_cards'] as $sc): ?>
      <div class="ai-side-card">
        <div class="ai-side-icon">
          <svg viewBox="0 0 24 24"><?= $sc['icon'] ?></svg>
        </div>
        <div>
          <div class="ai-side-label"><?= h($sc['label']) ?></div>
          <div class="ai-side-sub"><?= h($sc['sub']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="feature-pills">
      <?php foreach ($c['ai']['pills'] as $pill): ?>
      <span class="pill"><?= h($pill) ?></span>
      <?php endforeach; ?>
    </div>

    <div class="ai-cta-wrap">
      <a href="<?= h($c['ai']['cta']['href']) ?>" class="btn-primary">
        <?= h($c['ai']['cta']['label']) ?>
        <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ── PRICING ── -->
<section class="pricing-section" id="preise">
  <div class="pricing-head">
    <div class="section-label"><?= h($c['pricing']['section_label']) ?></div>
    <h2><?= $c['pricing']['headline'] ?></h2>
    <p class="section-sub"><?= h($c['pricing']['sub']) ?></p>
  </div>
  <div class="pricing-grid">
    <?php foreach ($c['pricing']['plans'] as $plan): ?>
    <div class="price-card<?= $plan['featured'] ? ' featured' : '' ?>">
      <div class="price-tag <?= h($plan['tag_class']) ?>"><?= h($plan['tag']) ?></div>
      <div class="price-name"><?= h($plan['name']) ?></div>
      <div class="price-desc"><?= h($plan['desc']) ?></div>
      <div class="price-num"><sup>€</sup><?= h($plan['price']) ?><?php if ($plan['price_suffix']): ?><small><?= h($plan['price_suffix']) ?></small><?php endif; ?></div>
      <div class="price-period"><?= h($plan['period']) ?></div>
      <div class="price-divider"></div>
      <div class="price-features">
        <?php foreach ($plan['features'] as $f): ?>
        <div class="pf"><span class="pf-check"></span><?= h($f) ?></div>
        <?php endforeach; ?>
      </div>
      <a href="<?= h($plan['cta_href']) ?>" class="price-cta <?= h($plan['cta_class']) ?>"><?= h($plan['cta']) ?></a>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── TESTIMONIALS ── -->
<section class="testi-section">
  <div class="testi-head">
    <div class="section-label"><?= h($c['testimonials']['section_label']) ?></div>
    <h2><?= $c['testimonials']['headline'] ?></h2>
    <p class="section-sub"><?= h($c['testimonials']['sub']) ?></p>
  </div>
  <div class="testi-grid">
    <?php foreach ($c['testimonials']['items'] as $t): ?>
    <div class="testi">
      <div class="testi-stars">★★★★★</div>
      <div class="testi-quote">"</div>
      <p class="testi-text"><?= h($t['text']) ?></p>
      <div class="testi-author">
        <div class="testi-av <?= h($t['av_class']) ?>"><?= h($t['initials']) ?></div>
        <div>
          <div class="testi-name"><?= h($t['name']) ?></div>
          <div class="testi-role"><?= h($t['role']) ?></div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── CTA ── -->
<section class="cta-section" id="kontakt">
  <div class="section-label"><?= h($c['cta']['section_label']) ?></div>
  <h2 class="cta-h"><?= $c['cta']['headline'] ?></h2>
  <p class="cta-p"><?= h($c['cta']['sub']) ?></p>
  <div class="cta-btns">
    <a href="<?= h($c['cta']['primary']['href']) ?>" class="btn-cta">
      <?= h($c['cta']['primary']['label']) ?>
      <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
    </a>
    <a href="<?= h($c['cta']['ghost']['href']) ?>" class="btn-cta-ghost"><?= h($c['cta']['ghost']['label']) ?></a>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
