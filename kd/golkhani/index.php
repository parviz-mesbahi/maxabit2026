<?php
require 'includes/load_content.php';
$c = load_content('home');

$pageTitle = $c['meta']['title']       ?? 'Zahnarzt Dr. Golkhani – Frechen';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero    = $c['hero']             ?? [];
$about   = $c['about_preview']    ?? [];
$svc     = $c['services']         ?? [];
$appt    = $c['appointment_cta']  ?? [];
$team    = $c['team_preview']     ?? [];
$why     = $c['why_us']           ?? [];
$testi   = $c['testimonials']     ?? [];
$footer  = $c['footer']           ?? [];
?>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="container hero-inner">
        <div class="hero-text">
            <h1><?= htmlspecialchars($hero['heading'] ?? '') ?></h1>
            <p><?= htmlspecialchars($hero['text'] ?? '') ?></p>
            <a href="<?= htmlspecialchars($hero['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?= htmlspecialchars($hero['cta']['label'] ?? 'Termin vereinbaren') ?>
            </a>
        </div>
        <div class="hero-images">
            <?php foreach ($hero['images'] ?? [] as $i => $img): ?>
                <img src="<?= htmlspecialchars($img) ?>" alt="Zahnarztpraxis Dr. Golkhani"
                     class="hero-img <?= $i === 0 ? 'hero-img-main' : 'hero-img-secondary' ?>">
            <?php endforeach; ?>
        </div>
    </div>
    <img src="images/bg-graphic-1.svg" alt="" class="hero-bg-graphic" aria-hidden="true">
</section>

<!-- ===== ÜBER UNS ===== -->
<section class="about-preview section">
    <div class="container about-inner">
        <div class="about-image">
            <img src="<?= htmlspecialchars($about['image'] ?? '') ?>" alt="Zahnarztpraxis Innenansicht">
        </div>
        <div class="about-text">
            <span class="section-label"><?= htmlspecialchars($about['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($about['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($about['text'] ?? '') ?></p>
            <a href="<?= htmlspecialchars($about['cta']['href'] ?? 'about.php') ?>" class="btn btn-outline">
                <?= htmlspecialchars($about['cta']['label'] ?? 'Mehr erfahren') ?>
            </a>
        </div>
    </div>
</section>

<!-- ===== LEISTUNGEN ===== -->
<section class="services section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?= htmlspecialchars($svc['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($svc['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($svc['subheading'] ?? '') ?></p>
        </div>
        <div class="services-grid">
            <?php foreach ($svc['items'] ?? [] as $item): ?>
            <div class="service-card">
                <div class="service-img-wrap">
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                </div>
                <div class="service-body">
                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                    <p><?= htmlspecialchars($item['text']) ?></p>
                    <a href="<?= htmlspecialchars($item['href']) ?>" class="service-link">Mehr erfahren →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="section-cta">
            <a href="<?= htmlspecialchars($svc['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?= htmlspecialchars($svc['cta']['label'] ?? 'Termin vereinbaren') ?>
            </a>
        </div>
    </div>
</section>

<!-- ===== TERMINVEREINBARUNG CTA ===== -->
<section class="cta-section section">
    <div class="container cta-inner">
        <div class="cta-text">
            <h2><?= htmlspecialchars($appt['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($appt['text'] ?? '') ?></p>
            <a href="<?= htmlspecialchars($appt['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?= htmlspecialchars($appt['cta']['label'] ?? 'Termin vereinbaren') ?>
            </a>
        </div>
        <div class="cta-image">
            <img src="<?= htmlspecialchars($appt['image'] ?? '') ?>" alt="Termin vereinbaren">
        </div>
    </div>
</section>

<!-- ===== TEAM ===== -->
<section class="team-preview section section-gray">
    <div class="container team-inner">
        <div class="team-image">
            <img src="<?= htmlspecialchars($team['image'] ?? '') ?>" alt="Dr. Bijan Golkhani">
        </div>
        <div class="team-text">
            <span class="section-label"><?= htmlspecialchars($team['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($team['heading'] ?? '') ?></h2>
            <p><?= htmlspecialchars($team['text'] ?? '') ?></p>
            <a href="<?= htmlspecialchars($team['cta']['href'] ?? 'about.php') ?>" class="btn btn-outline">
                <?= htmlspecialchars($team['cta']['label'] ?? 'Mehr erfahren') ?>
            </a>
        </div>
    </div>
</section>

<!-- ===== WARUM WIR ===== -->
<section class="why-us section">
    <div class="container why-inner">
        <div class="why-text">
            <span class="section-label"><?= htmlspecialchars($why['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($why['heading'] ?? '') ?></h2>
            <p class="why-sub"><?= htmlspecialchars($why['subheading'] ?? '') ?></p>
            <?php $doc = $why['doctor'] ?? []; ?>
            <div class="why-doctor">
                <strong><?= htmlspecialchars($doc['name'] ?? '') ?></strong>
                <p><?= htmlspecialchars($doc['text'] ?? '') ?></p>
                <ul class="why-list">
                    <?php foreach ($doc['bullets'] ?? [] as $b): ?>
                        <li>✓ <?= htmlspecialchars($b) ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?= htmlspecialchars($why['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
                    <?= htmlspecialchars($why['cta']['label'] ?? 'Termin vereinbaren') ?>
                </a>
            </div>
        </div>
        <div class="why-image">
            <img src="<?= htmlspecialchars($why['image'] ?? '') ?>" alt="Dr. Golkhani Praxis">
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="testimonials section section-gray">
    <div class="container">
        <div class="section-header">
            <span class="section-label"><?= htmlspecialchars($testi['label'] ?? '') ?></span>
            <h2><?= htmlspecialchars($testi['heading'] ?? '') ?></h2>
        </div>
        <div class="testimonials-grid">
            <?php foreach ($testi['items'] ?? [] as $t): ?>
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p>„<?= htmlspecialchars($t['text']) ?>"</p>
                <div class="testimonial-author">
                    <img src="<?= htmlspecialchars($t['image']) ?>" alt="<?= htmlspecialchars($t['name']) ?>">
                    <span><?= htmlspecialchars($t['name']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
