<?php
$m = json_decode(file_get_contents(__DIR__ . '/content/menu.json'), true);
function mh($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!-- ── NAV ── -->
<nav>
  <a href="<?= mh($m['logo']['href']) ?>" class="logo">
    <span class="logo-mark"></span>
    <span class="logo-text"><?= mh($m['logo']['name']) ?> <span><?= mh($m['logo']['suffix']) ?></span></span>
  </a>
  <ul class="nav-links">
    <?php foreach ($m['links'] as $link): ?>
    <li><a href="<?= mh($link['href']) ?>"><?= mh($link['label']) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="nav-right">
    <a href="<?= mh($m['cta_ghost']['href']) ?>"   class="btn-nav-ghost"><?= mh($m['cta_ghost']['label']) ?></a>
    <a href="<?= mh($m['cta_primary']['href']) ?>" class="btn-nav-primary"><?= mh($m['cta_primary']['label']) ?></a>
  </div>
</nav>
