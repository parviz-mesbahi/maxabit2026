<?php
$h = json_decode(file_get_contents(__DIR__ . '/content/hero.json'), true);
function hh($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!-- ── HERO ── -->
<section class="hero">
  <div class="hero-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>
  <div class="hero-inner">
    <div class="hero-text">
      <div class="hero-tag">
        <span class="tag-dot"><span class="tag-dot-inner"></span></span>
        <?= hh($h['tag']) ?>
      </div>
      <h1><?= $h['headline'] ?> <span class="wave">✦</span></h1>
      <p class="hero-sub"><?= $h['sub'] ?></p>
      <div class="hero-ctas">
        <a href="<?= hh($h['cta_primary']['href']) ?>" class="btn-primary">
          <?= hh($h['cta_primary']['label']) ?>
          <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
        </a>
        <a href="<?= hh($h['cta_secondary']['href']) ?>" class="btn-sec"><?= hh($h['cta_secondary']['label']) ?></a>
      </div>
      <div class="hero-trust">
        <div class="trust-avatars">
          <?php foreach ($h['trust']['avatars'] as $av): ?>
          <div class="trust-av"><?= hh($av) ?></div>
          <?php endforeach; ?>
        </div>
        <div class="trust-text">
          <strong><?= hh($h['trust']['count']) ?></strong>
          <?= hh($h['trust']['rating']) ?>
        </div>
      </div>
    </div>
    <div class="hero-visual">
      <img src="<?= hh($h['image'] ?? 'images/hero.jpg') ?>"
           alt="Moderner MacBook-Arbeitsplatz"
           class="hero-img">
      <!-- Photo: Ales Nesetril / Unsplash -->

      <?php foreach ($h['chips'] as $i => $chip): ?>
      <div class="float-chip chip-<?= $i + 1 ?>">
        <div class="chip-icon <?= hh($chip['color']) ?>">
          <svg viewBox="0 0 24 24"><?= $chip['icon'] ?></svg>
        </div>
        <div>
          <div class="chip-label"><?= hh($chip['label']) ?></div>
          <div class="chip-sub"><?= hh($chip['sub']) ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
