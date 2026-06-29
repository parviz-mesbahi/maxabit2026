<?php
require 'includes/load_content.php';
$c = load_content('impressum');

$pageTitle = $c['meta']['title'] ?? 'Impressum – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero       = $c['hero']            ?? [];
$p          = $c['practice']        ?? [];
$beruf      = $c['beruf']           ?? [];
$kammer     = $c['kammer']          ?? [];
$aufsicht   = $c['aufsicht']        ?? [];
$berufsrecht= $c['berufsrecht']     ?? [];
$streit     = $c['streit']          ?? [];
$h_inhalte  = $c['haftung_inhalte'] ?? [];
$h_links    = $c['haftung_links']   ?? [];
$urheber    = $c['urheberrecht']    ?? [];

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
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

        <h2>Angaben gemäß § 5 TMG</h2>

        <!-- Verantwortlich -->
        <h3>Verantwortlich</h3>
        <p>
            <?= e($p['name']) ?><br>
            <?= e($p['company']) ?><br>
            <?= e($p['street']) ?><br>
            <?= e($p['city']) ?>
        </p>

        <!-- Kontakt -->
        <h3>Kontakt</h3>
        <p>
            Telefon: <a href="<?= e($p['phone_href']) ?>"><?= e($p['phone']) ?></a><br>
            E-Mail: <a href="mailto:<?= e($p['email']) ?>"><?= e($p['email']) ?></a>
        </p>

        <!-- Berufsbezeichnung -->
        <h3><?= e($beruf['heading']) ?></h3>
        <p>
            <?php foreach ($beruf['lines'] ?? [] as $i => $line): ?>
                <?= e($line) ?><?= $i < count($beruf['lines']) - 1 ? '<br>' : '' ?>
            <?php endforeach; ?>
        </p>

        <!-- Kammer -->
        <h3><?= e($kammer['heading']) ?></h3>
        <p>
            <?= e($kammer['name']) ?><br>
            <?= e($kammer['street']) ?><br>
            <?= e($kammer['city']) ?><br>
            <a href="<?= e($kammer['url']) ?>" target="_blank" rel="noopener"><?= e($kammer['url_label']) ?></a>
        </p>

        <!-- Aufsicht -->
        <h3><?= e($aufsicht['heading']) ?></h3>
        <p>
            <?= e($aufsicht['name']) ?><br>
            <?= e($aufsicht['street']) ?><br>
            <?= e($aufsicht['city']) ?><br>
            <a href="<?= e($aufsicht['url']) ?>" target="_blank" rel="noopener"><?= e($aufsicht['url_label']) ?></a>
        </p>

        <!-- Berufsrechtliche Regelungen -->
        <h3><?= e($berufsrecht['heading']) ?></h3>
        <p><?= e($berufsrecht['intro']) ?></p>
        <ul>
            <?php foreach ($berufsrecht['laws'] ?? [] as $law): ?>
                <li><?= e($law) ?></li>
            <?php endforeach; ?>
        </ul>
        <p>
            <?= e($berufsrecht['outro']) ?><br>
            <a href="<?= e($berufsrecht['url']) ?>" target="_blank" rel="noopener"><?= e($berufsrecht['url_label']) ?></a>
        </p>

        <!-- Streitschlichtung -->
        <h3><?= e($streit['heading']) ?></h3>
        <p>
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
            <a href="<?= e($streit['os_url']) ?>" target="_blank" rel="noopener"><?= e($streit['os_url']) ?></a>
        </p>
        <p><?= e($streit['no_participation']) ?></p>

        <!-- Haftung für Inhalte -->
        <h3><?= e($h_inhalte['heading']) ?></h3>
        <?php foreach ($h_inhalte['paragraphs'] ?? [] as $para): ?>
            <p><?= e($para) ?></p>
        <?php endforeach; ?>

        <!-- Haftung für Links -->
        <h3><?= e($h_links['heading']) ?></h3>
        <?php foreach ($h_links['paragraphs'] ?? [] as $para): ?>
            <p><?= e($para) ?></p>
        <?php endforeach; ?>

        <!-- Urheberrecht -->
        <h3><?= e($urheber['heading']) ?></h3>
        <?php foreach ($urheber['paragraphs'] ?? [] as $para): ?>
            <p><?= e($para) ?></p>
        <?php endforeach; ?>

    </div>
</section>

<?php require 'includes/footer.php'; ?>
