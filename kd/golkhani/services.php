<?php
require 'includes/load_content.php';
$c = load_content('services');

$pageTitle = $c['meta']['title']       ?? 'Leistungen – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero  = $c['hero']  ?? [];
$items = $c['items'] ?? [];
?>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
    <div class="container">
        <span class="section-label"><?= htmlspecialchars($hero['label'] ?? '') ?></span>
        <h1><?= htmlspecialchars($hero['heading'] ?? '') ?></h1>
        <p><?= htmlspecialchars($hero['text'] ?? '') ?></p>
    </div>
    <img src="images/bg-graphic-1.svg" alt="" class="page-hero-bg" aria-hidden="true">
</section>

<section class="section">
    <div class="container">
        <p class="services-intro"><?= htmlspecialchars($c['intro'] ?? '') ?></p>
    </div>
</section>

<!-- ===== LEISTUNGEN ===== -->
<?php foreach ($items as $i => $item):
    $reverse  = ($i % 2 !== 0) ? ' reverse' : '';
    $gray     = ($i % 2 === 0) ? ' section-gray' : '';
?>
<section class="service-detail section<?= $gray ?>" id="<?= htmlspecialchars($item['id']) ?>">
    <div class="container service-detail-inner<?= $reverse ?>">
        <div class="service-detail-image">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
        </div>
        <div class="service-detail-text">
            <span class="section-label"><?= htmlspecialchars($item['label'] ?? 'Leistung') ?></span>
            <h2><?= htmlspecialchars($item['title']) ?></h2>

            <?php if (!empty($item['text'])): ?>
                <p><?= htmlspecialchars($item['text']) ?></p>
            <?php endif; ?>

            <?php foreach ($item['paragraphs'] ?? [] as $p): ?>
                <p><?= htmlspecialchars($p) ?></p>
            <?php endforeach; ?>

            <?php if (!empty($item['benefits'])): ?>
            <ul class="service-benefits">
                <?php foreach ($item['benefits'] as $b): ?>
                    <li>✓ <?= htmlspecialchars($b) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php foreach ($item['subsections'] ?? [] as $sub): ?>
            <h3><?= htmlspecialchars($sub['title']) ?></h3>
            <p><?= htmlspecialchars($sub['text']) ?></p>
            <?php if (!empty($sub['benefits'])): ?>
            <ul class="service-benefits">
                <?php foreach ($sub['benefits'] as $b): ?>
                    <li>✓ <?= htmlspecialchars($b) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <?php endforeach; ?>

            <?php if (!empty($item['gallery'])): ?>
            <div class="service-gallery">
                <?php foreach ($item['gallery'] as $img): ?>
                    <img src="<?= htmlspecialchars($img['src']) ?>" alt="<?= htmlspecialchars($img['alt']) ?>">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <a href="contact.php" class="btn btn-primary">Termin vereinbaren</a>
        </div>
    </div>
</section>
<?php endforeach; ?>

<?php require 'includes/footer.php'; ?>
