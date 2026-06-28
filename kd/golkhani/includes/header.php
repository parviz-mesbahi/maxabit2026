<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Zahnarzt Dr. Golkhani – Frechen') ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc ?? 'Zahnarztpraxis Dr. Bijan Golkhani in Frechen. Erstklassige Zahnmedizin – Implantologie, Parodontologie, Ästhetik und mehr.') ?>">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="index.php" class="logo">
            <img src="images/logo-new-2.png" alt="Dr. Golkhani Zahnarzt" class="logo-img">
        </a>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php"    <?= $current === 'index.php'    ? 'class="active"' : '' ?>>Home</a></li>
                <li><a href="about.php"    <?= $current === 'about.php'    ? 'class="active"' : '' ?>>Über uns</a></li>
                <li><a href="services.php" <?= $current === 'services.php' ? 'class="active"' : '' ?>>Leistungen</a></li>
                <li><a href="contact.php"  <?= $current === 'contact.php'  ? 'class="active"' : '' ?>>Kontakt</a></li>
            </ul>
        </nav>
        <a href="tel:+4922341666" class="btn btn-primary header-cta">+49 2234 16 666</a>
        <button class="mobile-menu-toggle" aria-label="Menü öffnen">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
