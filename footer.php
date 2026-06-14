<?php
$f = json_decode(file_get_contents(__DIR__ . '/content/footer.json'), true);
function fh($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!-- ── FOOTER ── -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <a href="<?= fh($f['logo']['href']) ?>" class="logo">
        <span class="logo-mark"></span>
        <span class="logo-text"><?= fh($f['logo']['name']) ?> <span><?= fh($f['logo']['suffix']) ?></span></span>
      </a>
      <p><?= fh($f['brand_text']) ?></p>
      <span class="badge-ai">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 0 2h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1 0-2h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2z"/></svg>
        <?= fh($f['badge']) ?>
      </span>
    </div>
    <?php foreach ($f['cols'] as $col): ?>
    <div class="footer-col">
      <h4><?= fh($col['title']) ?></h4>
      <ul>
        <?php foreach ($col['links'] as $link): ?>
        <li><a href="<?= fh($link['href']) ?>"><?= fh($link['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="footer-bottom">
    <span class="footer-copy"><?= fh($f['copy']) ?></span>
    <div class="footer-links">
      <?php foreach ($f['bottom_links'] as $link): ?>
      <a href="<?= fh($link['href']) ?>"><?= fh($link['label']) ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</footer>
