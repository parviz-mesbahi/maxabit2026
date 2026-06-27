<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Corporate Website – MaxaBit IT-Solutions</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/service.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>
<?php include __DIR__ . '/consent.php'; ?>

<!-- ── HERO ── -->
<section class="sp-hero sp-hero-sky">
  <div class="sp-blob sp-blob-1"></div>
  <div class="sp-blob sp-blob-2"></div>
  <div class="sp-hero-inner">
    <div class="sp-tag">
      <div class="sp-tag-dot"><span></span></div>
      Webdesign
    </div>
    <h1>Ihre professionelle <em class="hl">Unternehmenswebsite</em></h1>
    <p class="sp-hero-sub">
      Wir gestalten und entwickeln Corporate Websites, die Vertrauen aufbauen, Kunden überzeugen
      und messbar mehr Anfragen generieren — maßgeschneidert für Ihr Unternehmen.
    </p>
    <div class="sp-hero-btns">
      <a href="index.php#kontakt" class="btn-primary">
        Projekt starten
        <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
      </a>
      <a href="index.php#preise" class="btn-sec">Preise ansehen</a>
    </div>
  </div>
</section>

<!-- ── FEATURES ── -->
<section class="sp-features">
  <div class="sp-features-head">
    <div class="section-label">Was Sie bekommen</div>
    <h2>Alles aus einer <em>Hand</em></h2>
    <p class="section-sub">Von der ersten Idee bis zum Go-live — wir begleiten Sie durch den gesamten Prozess.</p>
  </div>
  <div class="sp-grid">

    <div class="srv c-sky">
      <div class="srv-badge badge-blue">Design</div>
      <div class="srv-icon sky">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
      </div>
      <h3>Responsives Design</h3>
      <p>Ihre Website sieht auf jedem Gerät perfekt aus — vom Smartphone bis zum Widescreen-Monitor.</p>
      <ul class="srv-list">
        <li>Mobile-First Ansatz</li>
        <li>Pixel-perfekte Umsetzung</li>
        <li>Markenkonformes Layout</li>
      </ul>
    </div>

    <div class="srv c-mint">
      <div class="srv-badge badge-mint">CMS</div>
      <div class="srv-icon mint">
        <svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
      </div>
      <h3>CMS-Integration</h3>
      <p>Inhalte selbst pflegen — ohne technisches Vorwissen. Wir integrieren ein passendes CMS für Sie.</p>
      <ul class="srv-list">
        <li>WordPress / Kirby / Headless</li>
        <li>Einfache Bedienung</li>
        <li>Schulung inklusive</li>
      </ul>
    </div>

    <div class="srv c-purple">
      <div class="srv-badge badge-purple">SEO</div>
      <div class="srv-icon purple">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      </div>
      <h3>SEO-Optimierung</h3>
      <p>Von Anfang an suchmaschinenoptimiert — technisches SEO, strukturierte Daten und schnelle Ladezeiten.</p>
      <ul class="srv-list">
        <li>Core Web Vitals</li>
        <li>Schema Markup</li>
        <li>Meta & Open Graph</li>
      </ul>
    </div>

    <div class="srv c-yellow">
      <div class="srv-badge badge-yellow">Performance</div>
      <div class="srv-icon yellow">
        <svg viewBox="0 0 24 24"><polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <h3>Höchste Performance</h3>
      <p>Schnelle Ladezeiten verbessern Nutzererfahrung und Google-Ranking gleichermaßen.</p>
      <ul class="srv-list">
        <li>Lighthouse Score 95+</li>
        <li>Bildoptimierung</li>
        <li>CDN & Caching</li>
      </ul>
    </div>

    <div class="srv c-coral">
      <div class="srv-badge badge-coral">Sicherheit</div>
      <div class="srv-icon coral">
        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      </div>
      <h3>SSL & Sicherheit</h3>
      <p>Ihre Website und Ihre Besucher sind geschützt — HTTPS, regelmäßige Updates und Backups inklusive.</p>
      <ul class="srv-list">
        <li>SSL-Zertifikat</li>
        <li>Tägliche Backups</li>
        <li>DSGVO-konform</li>
      </ul>
    </div>

    <div class="srv c-pink">
      <div class="srv-badge badge-pink">Support</div>
      <div class="srv-icon pink">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      </div>
      <h3>Persönlicher Support</h3>
      <p>Wir sind auch nach dem Launch für Sie da — schnell, zuverlässig und auf Augenhöhe.</p>
      <ul class="srv-list">
        <li>Direkter Ansprechpartner</li>
        <li>Reaktionszeit &lt; 24h</li>
        <li>Wartungsvertrag optional</li>
      </ul>
    </div>

  </div>
</section>

<!-- ── PROZESS ── -->
<section class="sp-process">
  <div class="sp-process-head">
    <div class="section-label">Unser Vorgehen</div>
    <h2>Von der Idee zum <em>fertigen Auftritt</em></h2>
    <p class="section-sub">In vier klaren Schritten zur Website, die Ergebnisse liefert.</p>
  </div>
  <div class="steps">
    <div class="step">
      <div class="step-num">1
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
      </div>
      <h3>Briefing</h3>
      <p>Wir lernen Ihr Unternehmen, Ihre Ziele und Ihre Zielgruppe kennen.</p>
    </div>
    <div class="step">
      <div class="step-num">2
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
        </div>
      </div>
      <h3>Design</h3>
      <p>Wir erstellen Wireframes und ein individuelles Design — Sie geben Feedback.</p>
    </div>
    <div class="step">
      <div class="step-num">3
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
      </div>
      <h3>Entwicklung</h3>
      <p>Sauberer Code, schnelle Ladezeiten, SEO und CMS-Integration.</p>
    </div>
    <div class="step">
      <div class="step-num">4
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
      </div>
      <h3>Launch</h3>
      <p>Go-live, Einweisung und auf Wunsch laufende Betreuung durch uns.</p>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="sp-cta">
  <div class="section-label">Jetzt starten</div>
  <h2>Bereit für Ihren neuen Webauftritt?</h2>
  <p>Kostenloses Erstgespräch — wir analysieren Ihre Situation und zeigen Ihnen konkrete Möglichkeiten.</p>
  <div class="sp-cta-btns">
    <a href="index.php#kontakt" class="btn-cta-white">Kostenlos beraten lassen</a>
    <a href="index.php#preise" class="btn-cta-outline">Preise ansehen</a>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
