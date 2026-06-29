<?php
require 'includes/load_content.php';
$c = load_content('about');

$pageTitle = $c['meta']['title']       ?? 'Über uns – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero    = $c['hero']    ?? [];
$history = $c['history'] ?? [];
$doctor  = $c['doctor']  ?? [];
$team    = $c['team']    ?? [];
$values  = $c['values']  ?? [];
$gallery = $c['gallery'] ?? [];
?>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
    <div class="container">
        <span class="section-label"><?= htmlspecialchars($hero['label'] ?? '') ?></span>
        <h1><?= htmlspecialchars($hero['heading'] ?? '') ?></h1>
        <p><?= htmlspecialchars($hero['text'] ?? '') ?></p>
    </div>
    <img src="images/bg-graphic-2.svg" alt="" class="page-hero-bg" aria-hidden="true">
</section>

<!-- ===== UNSERE GESCHICHTE ===== -->
<section class="section">
    <div class="container about-inner">
        <div class="about-image">
            <img src="<?= htmlspecialchars($history['image'] ?? '') ?>" alt="Zahnarztpraxis Dr. Golkhani">
        </div>
        <div class="about-text">
            <span class="section-label"><?= htmlspecialchars($history['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($history['heading'] ?? '') ?></h2>
            <?php foreach ($history['paragraphs'] ?? [] as $p): ?>
                <p><?= htmlspecialchars($p) ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== DR. GOLKHANI ===== -->
<section class="section section-gray">
    <div class="container doctor-inner">
        <div class="doctor-image">
            <img src="<?= htmlspecialchars($doctor['image'] ?? '') ?>" alt="<?= htmlspecialchars($doctor['name'] ?? '') ?>">
        </div>
        <div class="doctor-text">
            <span class="section-label"><?= htmlspecialchars($doctor['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($doctor['name'] ?? '') ?></h2>
            <p class="doctor-title"><?= htmlspecialchars($doctor['role'] ?? '') ?></p>
            <?php foreach ($doctor['paragraphs'] ?? [] as $p): ?>
                <p><?= htmlspecialchars($p) ?></p>
            <?php endforeach; ?>
            <ul class="why-list">
                <?php foreach ($doctor['qualifications'] ?? [] as $q): ?>
                    <li>✓ <?= htmlspecialchars($q) ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="<?= htmlspecialchars($doctor['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?= htmlspecialchars($doctor['cta']['label'] ?? 'Termin vereinbaren') ?>
            </a>
        </div>
    </div>
</section>

<!-- ===== UNSER TEAM ===== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?= htmlspecialchars($team['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($team['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($team['text'] ?? '') ?></p>
        </div>
        <div class="team-grid">
            <?php foreach ($team['members'] ?? [] as $m): ?>
            <div class="team-card">
                <div class="team-img-wrap">
                    <img src="<?= htmlspecialchars($m['image']) ?>" alt="<?= htmlspecialchars($m['name']) ?>">
                </div>
                <div class="team-body">
                    <h3><?= htmlspecialchars($m['name']) ?></h3>
                    <p class="team-role"><?= htmlspecialchars($m['role']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== UNSERE WERTE ===== -->
<section class="section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?= htmlspecialchars($values['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($values['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($values['text'] ?? '') ?></p>
        </div>
        <div class="values-grid">
            <?php foreach ($values['items'] ?? [] as $v): ?>
            <div class="value-card">
                <div class="value-icon"><?= $v['icon'] ?></div>
                <h3><?= htmlspecialchars($v['title']) ?></h3>
                <p><?= htmlspecialchars($v['text']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== GALERIE ===== -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?= htmlspecialchars($gallery['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($gallery['heading'] ?? '') ?></h2>
        </div>
        <div class="gallery-grid">
            <?php foreach ($gallery['images'] ?? [] as $img): ?>
                <img src="<?= htmlspecialchars($img['src']) ?>" alt="<?= htmlspecialchars($img['alt']) ?>" class="gallery-img">
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
