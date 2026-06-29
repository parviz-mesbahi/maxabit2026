<?php
require 'includes/load_content.php';
$c = load_content('contact');

$pageTitle = $c['meta']['title']       ?? 'Kontakt – Dr. Golkhani';
$pageDesc  = $c['meta']['description'] ?? '';
require 'includes/header.php';

$hero    = $c['hero']           ?? [];
$form    = $c['form']           ?? [];
$info    = $c['contact_info']   ?? [];
$hours   = $c['hours']          ?? [];
$emerg   = $c['emergency']      ?? [];
$map     = $c['map']            ?? [];
$booking = $c['online_booking'] ?? [];

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name)                                        $errors[] = 'Bitte geben Sie Ihren Namen ein.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))    $errors[] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
    if (!$message)                                     $errors[] = 'Bitte geben Sie eine Nachricht ein.';

    if (empty($errors)) {
        $to      = $form['recipient'] ?? 'dr.bijan.golkhani@gmx.de';
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
        <span class="section-label"><?= htmlspecialchars($hero['label'] ?? '') ?></span>
        <h1><?= htmlspecialchars($hero['heading'] ?? '') ?></h1>
        <p><?= htmlspecialchars($hero['text'] ?? '') ?></p>
    </div>
    <img src="images/bg-graphic-2.svg" alt="" class="page-hero-bg" aria-hidden="true">
</section>

<!-- ===== KONTAKT BEREICH ===== -->
<section class="section">
    <div class="container contact-grid">

        <!-- FORMULAR -->
        <div class="contact-form-wrap">
            <h2><?= htmlspecialchars($form['heading'] ?? '') ?></h2>
            <p class="contact-form-sub"><?= htmlspecialchars($form['subheading'] ?? '') ?></p>

            <?php if ($success): ?>
                <div class="form-success">
                    <strong>Vielen Dank!</strong> <?= htmlspecialchars($form['success_message'] ?? '') ?>
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
                <?php
                $fields = $form['fields'] ?? [];
                $row_open = false;
                foreach ($fields as $idx => $field):
                    $next = $fields[$idx + 1] ?? null;
                    $prev = $fields[$idx - 1] ?? null;

                    // group email + phone in a row
                    if ($field['name'] === 'email' && $next && $next['name'] === 'phone'):
                        echo '<div class="form-row">';
                        $row_open = true;
                    endif;
                ?>
                <div class="form-group">
                    <label for="<?= $field['name'] ?>"><?= htmlspecialchars($field['label']) ?><?= $field['required'] ? ' *' : '' ?></label>
                    <?php if ($field['type'] === 'textarea'): ?>
                        <textarea id="<?= $field['name'] ?>" name="<?= $field['name'] ?>" rows="5"
                                  placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                                  <?= $field['required'] ? 'required' : '' ?>><?= htmlspecialchars($_POST[$field['name']] ?? '') ?></textarea>
                    <?php else: ?>
                        <input type="<?= $field['type'] ?>" id="<?= $field['name'] ?>" name="<?= $field['name'] ?>"
                               placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                               value="<?= htmlspecialchars($_POST[$field['name']] ?? '') ?>"
                               <?= $field['required'] ? 'required' : '' ?>>
                    <?php endif; ?>
                </div>
                <?php
                    if ($field['name'] === 'phone' && $prev && $prev['name'] === 'email'):
                        echo '</div>';
                        $row_open = false;
                    endif;
                endforeach; ?>
                <button type="submit" class="btn btn-primary"><?= htmlspecialchars($form['submit_label'] ?? 'Absenden') ?></button>
            </form>
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
                <div class="contact-info-icon">✉️</div>
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
    <iframe src="<?= htmlspecialchars($map['embed_url']) ?>"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="<?= htmlspecialchars($map['label'] ?? 'Standort') ?>"></iframe>
</section>
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
