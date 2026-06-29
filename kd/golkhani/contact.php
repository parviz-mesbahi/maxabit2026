<?php
require 'includes/load_content.php';
$c = load_content('contact');

$pageTitle = $c['meta']['title']       ?? 'Kontakt – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero    = $c['hero']           ?? [];
$info    = $c['contact_info']   ?? [];
$hours   = $c['hours']          ?? [];
$emerg   = $c['emergency']      ?? [];
$map     = $c['map']            ?? [];
$booking = $c['online_booking'] ?? [];

$email   = $info['email'] ?? 'dr.bijan.golkhani@gmx.de';
$subject = rawurlencode('Kontaktanfrage – Zahnarztpraxis Dr. Golkhani');
$mailtoHref = 'mailto:' . htmlspecialchars($email) . '?subject=' . $subject;
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

<!-- ===== KONTAKT BEREICH ===== -->
<section class="section">
    <div class="container contact-grid">

        <!-- E-MAIL KONTAKT -->
        <div class="contact-form-wrap">
            <h2>Schreiben Sie uns</h2>
            <p class="contact-form-sub">Klicken Sie auf den Button – Ihr E-Mail-Programm öffnet sich mit der richtigen Adresse und einem vorausgefüllten Betreff.</p>

            <a href="<?= $mailtoHref ?>" class="mailto-card">
                <div class="mailto-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>
                <div class="mailto-text">
                    <span class="mailto-label">E-Mail schreiben</span>
                    <span class="mailto-address"><?= htmlspecialchars($email) ?></span>
                </div>
                <div class="mailto-arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <p class="mailto-hint">Kein E-Mail-Programm installiert? Rufen Sie uns gerne direkt an:<br>
                <a href="<?= htmlspecialchars($info['phone_href'] ?? '#') ?>" class="mailto-phone">
                    <?= htmlspecialchars($info['phone'] ?? '') ?>
                </a>
            </p>
        </div>

        <!-- KONTAKTDATEN -->
        <div class="contact-info">
            <div class="contact-info-card">
                <div class="contact-info-icon">📍</div>
                <h3>Adresse</h3>
                <p><?= htmlspecialchars($info['address']['street'] ?? '') ?><br>
                   <?= htmlspecialchars($info['address']['city'] ?? '') ?></p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">📞</div>
                <h3>Telefon</h3>
                <p><a href="<?= htmlspecialchars($info['phone_href'] ?? '#') ?>"><?= htmlspecialchars($info['phone'] ?? '') ?></a></p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon contact-info-icon--blue">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>
                <h3>E-Mail</h3>
                <p><a href="mailto:<?= htmlspecialchars($info['email'] ?? '') ?>"><?= htmlspecialchars($info['email'] ?? '') ?></a></p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">🕐</div>
                <h3>Öffnungszeiten</h3>
                <table class="hours-table">
                    <?php foreach ($hours as $h): ?>
                    <tr>
                        <td><?= htmlspecialchars($h['days']) ?></td>
                        <td><?= htmlspecialchars($h['time']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="contact-info-card contact-emergency">
                <div class="contact-info-icon">🚨</div>
                <h3><?= htmlspecialchars($emerg['label'] ?? '') ?></h3>
                <p><?= htmlspecialchars($emerg['text'] ?? '') ?></p>
                <p><strong><a href="<?= htmlspecialchars($emerg['phone_href'] ?? '#') ?>"><?= htmlspecialchars($emerg['phone'] ?? '') ?></a></strong></p>
            </div>
        </div>

    </div>
</section>

<!-- ===== KARTE ===== -->
<?php if (!empty($map['embed_url'])): ?>
<section class="map-section">
    <div class="map-consent" id="mapConsent">
        <div class="map-consent-inner">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
            </svg>
            <h3>Google Maps</h3>
            <p>Diese Karte wird von Google bereitgestellt. Beim Laden werden Daten (IP-Adresse) an Google übertragen. Stimmen Sie zu, um die Karte anzuzeigen.</p>
            <button class="btn btn-primary" onclick="loadMap(
                '<?= htmlspecialchars($map['embed_url'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($map['label'] ?? 'Standort', ENT_QUOTES) ?>'
            )">Karte laden</button>
            <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="map-consent-link">Google Datenschutzerklärung</a>
        </div>
    </div>
    <iframe id="mapFrame" src="" width="100%" height="450"
            style="border:0;display:none;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="<?= htmlspecialchars($map['label'] ?? 'Standort') ?>"></iframe>
</section>
<script>
function loadMap(url, label) {
    const frame = document.getElementById('mapFrame');
    const consent = document.getElementById('mapConsent');
    frame.src = url;
    frame.title = label;
    frame.style.display = 'block';
    consent.style.display = 'none';
}
</script>
<?php endif; ?>

<!-- ===== ONLINE BOOKING CTA ===== -->
<section class="section section-gray">
    <div class="container" style="text-align:center">
        <span class="section-label"><?= htmlspecialchars($booking['label'] ?? '') ?></span>
        <h2><?= htmlspecialchars($booking['heading'] ?? '') ?></h2>
        <p style="color:var(--muted);margin:16px auto 32px;max-width:520px"><?= htmlspecialchars($booking['text'] ?? '') ?></p>
        <a href="<?= htmlspecialchars($booking['cta']['href'] ?? '#') ?>" class="btn btn-primary" target="_blank" rel="noopener">
            <?= htmlspecialchars($booking['cta']['label'] ?? 'Jetzt buchen') ?>
        </a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
