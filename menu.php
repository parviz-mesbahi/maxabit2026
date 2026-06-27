<?php
$m = json_decode(file_get_contents(__DIR__ . '/content/menu.json'), true);
if (!function_exists('mh')) {
    function mh($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('isActive')) {
    function isActive($href, $current) { return basename(strtok($href, '#')) === $current; }
}
$current = basename($_SERVER['SCRIPT_NAME']);
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
    <a href="<?= mh($m['cta_primary']['href']) ?>" class="btn-nav-primary"><?= mh($m['cta_primary']['label']) ?></a>
    <button class="nav-burger" id="nav-burger" aria-label="Menü öffnen">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="nav-mobile" id="nav-mobile" style="display:none">
  <ul>
    <?php foreach ($m['links'] as $link): ?>
    <li><a href="<?= mh($link['href']) ?>"<?= isActive($link['href'], $current) ? ' class="active"' : '' ?>><?= mh($link['label']) ?></a></li>
    <?php endforeach; ?>
  </ul>
  <div class="nav-mobile-btns">
    <a href="<?= mh($m['cta_primary']['href']) ?>" class="btn-nav-primary"><?= mh($m['cta_primary']['label']) ?></a>
  </div>
</div>

<script>
(function(){
  var burger = document.getElementById('nav-burger');
  var menu   = document.getElementById('nav-mobile');
  function openMenu(){
    menu.style.display = 'flex';
    burger.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeMenu(){
    menu.style.display = 'none';
    burger.classList.remove('open');
    document.body.style.overflow = '';
  }
  burger.addEventListener('click', function(){
    menu.style.display === 'none' ? openMenu() : closeMenu();
  });
  menu.querySelectorAll('a').forEach(function(a){
    a.addEventListener('click', closeMenu);
  });
  window.addEventListener('resize', function(){
    if (window.innerWidth > 1300) closeMenu();
  });
})();
</script>
