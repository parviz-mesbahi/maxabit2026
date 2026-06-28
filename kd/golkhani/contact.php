<?php
$pageTitle = 'Kontakt – Zahnarztpraxis Dr. Golkhani, Frechen';
$pageDesc  = 'Zahnarztpraxis Dr. Bijan Golkhani – Hauptstraße 124-126, 50226 Frechen. Tel: 02234 16 666. Jetzt Termin vereinbaren.';
require 'includes/header.php';

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name)                       $errors[] = 'Bitte geben Sie Ihren Namen ein.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
    if (!$message)                    $errors[] = 'Bitte geben Sie eine Nachricht ein.';

    if (empty($errors)) {
        $to      = 'dr.bijan.golkhani@gmx.de';
        $subject = 'Kontaktanfrage von ' . $name;
        $body    = "Name: $name\nE-Mail: $email\nTelefon: $phone\n\nNachricht:\n$message";
        $headers = "From: noreply@zahnarzt-golkhani.de\r\nReply-To: $email";
        mail($to, $subject, $body, $headers);
        $success = true;
    }
}
?>

<!-- ===== PAGE HERO ===== -->
<section class="page-hero">
    <div class="container">
        <span class="section-label">Kontakt</span>
        <h1>Wir sind für Sie da</h1>
        <p>Vereinbaren Sie Ihren Termin – online, telefonisch oder per E-Mail. Wir freuen uns auf Ihren Besuch.</p>
    </div>
    <img src="images/bg-graphic-2.svg" alt="" class="page-hero-bg" aria-hidden="true">
</section>

<!-- ===== KONTAKT BEREICH ===== -->
<section class="section">
    <div class="container contact-grid">

        <!-- KONTAKTFORMULAR -->
        <div class="contact-form-wrap">
            <h2>Nachricht senden</h2>
            <p class="contact-form-sub">Wir melden uns schnellstmöglich bei Ihnen.</p>

            <?php if ($success): ?>
                <div class="form-success">
                    <strong>Vielen Dank!</strong> Ihre Nachricht wurde erfolgreich übermittelt. Wir werden uns zeitnah bei Ihnen melden.
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="form-errors">
                    <?php foreach ($errors as $e): ?>
                        <p><?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="contact.php" class="contact-form" novalidate>
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" placeholder="Ihr vollständiger Name"
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-Mail *</label>
                        <input type="email" id="email" name="email" placeholder="ihre@email.de"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" placeholder="0 2234 ..."
                               value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Nachricht *</label>
                    <textarea id="message" name="message" rows="5" placeholder="Wie können wir Ihnen helfen?" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Nachricht absenden</button>
            </form>
        </div>

        <!-- KONTAKTDATEN -->
        <div class="contact-info">
            <div class="contact-info-card">
                <div class="contact-info-icon">📍</div>
                <h3>Adresse</h3>
                <p>Hauptstraße 124-126<br>50226 Frechen</p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">📞</div>
                <h3>Telefon</h3>
                <p><a href="tel:+4922341666">02234 16 666</a></p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">✉️</div>
                <h3>E-Mail</h3>
                <p><a href="mailto:dr.bijan.golkhani@gmx.de">dr.bijan.golkhani@gmx.de</a></p>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">🕐</div>
                <h3>Öffnungszeiten</h3>
                <table class="hours-table">
                    <tr><td>Mo – Do</td><td>8:30 – 12:30 &amp; 15:00 – 19:00</td></tr>
                    <tr><td>Mi-Nachmittag</td><td>Nur nach Vereinbarung</td></tr>
                    <tr><td>Freitag</td><td>08:30 – 13:30</td></tr>
                    <tr><td>Sa &amp; So</td><td>Geschlossen</td></tr>
                </table>
            </div>
            <div class="contact-info-card contact-emergency">
                <div class="contact-info-icon">🚨</div>
                <h3>Notfalldienst</h3>
                <p>Zentrale Rufnummer der nordrheinischen Zahnärzte:</p>
                <p><strong><a href="tel:018059867000">01805 / 98 67 00</a></strong></p>
            </div>
        </div>

    </div>
</section>

<!-- ===== KARTE ===== -->
<section class="map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2512.5!2d6.8150!3d50.9285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bf25c0e1a2b2c3%3A0x0!2sHauptstra%C3%9Fe+124-126%2C+50226+Frechen!5e0!3m2!1sde!2sde!4v1"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Standort Zahnarztpraxis Dr. Golkhani, Frechen">
    </iframe>
</section>

<!-- ===== DOCTOLIB CTA ===== -->
<section class="section section-gray">
    <div class="container" style="text-align:center">
        <span class="section-label">Online buchen</span>
        <h2>Einfach online Termin buchen</h2>
        <p style="color:var(--muted);margin:16px auto 32px;max-width:520px">Vereinbaren Sie Ihren Termin ganz einfach online über Doctolib – schnell, unkompliziert und rund um die Uhr.</p>
        <a href="https://www.doctolib.de/zahnarzt/frechen/bijan-golkhani" class="btn btn-primary" target="_blank" rel="noopener">
            Jetzt Termin buchen
        </a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
