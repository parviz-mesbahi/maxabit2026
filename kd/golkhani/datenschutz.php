<?php
require 'includes/load_content.php';
$c = load_content('datenschutz');

$pageTitle = $c['meta']['title'] ?? 'Datenschutzerklärung – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero     = $c['hero']     ?? [];
$sections = $c['sections'] ?? [];

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

function renderSubsection(array $sub): void {
    if (!empty($sub['heading'])): ?>
        <h3><?= e($sub['heading']) ?></h3>
    <?php endif;
    foreach ($sub['paragraphs'] ?? [] as $p): ?>
        <p><?= e($p) ?></p>
    <?php endforeach;
    if (!empty($sub['list'])): ?>
        <ul>
            <?php foreach ($sub['list'] as $item): ?>
                <li><?= e($item) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
    foreach ($sub['paragraphs_after'] ?? [] as $p): ?>
        <p><?= e($p) ?></p>
    <?php endforeach;
    if (!empty($sub['link'])): ?>
        <p><a href="<?= e($sub['link']['url']) ?>" target="_blank" rel="noopener"><?= e($sub['link']['display']) ?></a></p>
    <?php endif;
}
?>

<section class="page-hero">
    <div class="container">
        <span class="section-label"><?= e($hero['label']) ?></span>
        <h1><?= e($hero['heading']) ?></h1>
        <p><?= e($hero['text']) ?></p>
    </div>
    <img src="images/bg-graphic-2.svg" alt="" class="page-hero-bg" aria-hidden="true">
</section>

<section class="section">
    <div class="container legal-content">

        <?php foreach ($sections as $sec): ?>

        <h2><?= e($sec['heading']) ?></h2>

        <?php foreach ($sec['paragraphs'] ?? [] as $p): ?>
            <p><?= e($p) ?></p>
        <?php endforeach; ?>

        <?php if (!empty($sec['address'])): ?>
            <p>
                <?php foreach ($sec['address'] as $line): ?>
                    <?= e($line) ?><br>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($sec['list'])): ?>
            <ul>
                <?php foreach ($sec['list'] as $item): ?>
                    <li><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php foreach ($sec['subsections'] ?? [] as $sub): ?>
            <?php renderSubsection($sub); ?>
        <?php endforeach; ?>

        <?php if (!empty($sec['link'])): ?>
            <p><a href="<?= e($sec['link']['url']) ?>" target="_blank" rel="noopener"><?= e($sec['link']['display']) ?></a></p>
        <?php endif; ?>

        <?php endforeach; ?>

    </div>
</section>

<?php require 'includes/footer.php'; ?>
