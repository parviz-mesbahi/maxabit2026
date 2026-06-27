<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Web-Apps &amp; Mobile Apps – MaxaBit IT-Solutions</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/service.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>
<?php include __DIR__ . '/consent.php'; ?>

<!-- ── HERO ── -->
<section class="sp-hero sp-hero-purple">
  <div class="sp-blob sp-blob-1"></div>
  <div class="sp-blob sp-blob-2"></div>
  <div class="sp-hero-inner">
    <div class="sp-tag">
      <div class="sp-tag-dot"><span></span></div>
      Applikationen
    </div>
    <h1>Individuelle <em class="hl">Web-Apps</em> &amp; Mobile Apps</h1>
    <p class="sp-hero-sub">
      Von der Idee bis zum fertigen Produkt — wir entwickeln skalierbare Web-Applikationen
      und native Mobile Apps für iOS und Android, die Ihre Geschäftsprozesse digital transformieren.
    </p>
    <div class="sp-hero-btns">
      <a href="index.php#kontakt" class="btn-primary">
        Anforderungen besprechen
        <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
      </a>
      <a href="index.php#preise" class="btn-sec">Preise ansehen</a>
    </div>
  </div>
</section>

<!-- ── FEATURES ── -->
<section class="sp-features">
  <div class="sp-features-head">
    <div class="section-label">Unsere Leistungen</div>
    <h2>Full-Stack aus <em>einer Hand</em></h2>
    <p class="section-sub">Backend, Frontend, API, Deployment — wir decken den gesamten Technologie-Stack ab.</p>
  </div>
  <div class="sp-grid">

    <div class="srv c-purple">
      <div class="srv-badge badge-purple">Web-App</div>
      <div class="srv-icon purple">
        <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
      </div>
      <h3>Web-Applikationen</h3>
      <p>Leistungsstarke Browser-Apps mit modernen Frameworks — reaktionsschnell, skalierbar und wartungsfreundlich.</p>
      <ul class="srv-list">
        <li>React / Vue / Next.js</li>
        <li>PHP / Laravel / Node.js</li>
        <li>REST & GraphQL APIs</li>
      </ul>
    </div>

    <div class="srv c-sky">
      <div class="srv-badge badge-blue">Mobile</div>
      <div class="srv-icon sky">
        <svg viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>
      </div>
      <h3>Mobile Apps</h3>
      <p>Native und Cross-Platform Apps für iOS und Android — mit nativem Look & Feel und maximaler Performance.</p>
      <ul class="srv-list">
        <li>React Native / Flutter</li>
        <li>iOS & Android</li>
        <li>App Store Einreichung</li>
      </ul>
    </div>

    <div class="srv c-mint">
      <div class="srv-badge badge-mint">Backend</div>
      <div class="srv-icon mint">
        <svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/><path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/></svg>
      </div>
      <h3>Datenbank & API</h3>
      <p>Robuste Datenmodelle, sichere APIs und skalierbare Datenbankarchitekturen für Ihre Anwendung.</p>
      <ul class="srv-list">
        <li>MySQL / PostgreSQL</li>
        <li>API-Dokumentation</li>
        <li>Authentifizierung & Auth</li>
      </ul>
    </div>

    <div class="srv c-yellow">
      <div class="srv-badge badge-yellow">Cloud</div>
      <div class="srv-icon yellow">
        <svg viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>
      </div>
      <h3>Cloud-Hosting</h3>
      <p>Zuverlässiges Hosting auf skalierbarer Cloud-Infrastruktur — mit automatischen Deployments und Monitoring.</p>
      <ul class="srv-list">
        <li>AWS / Hetzner / Vercel</li>
        <li>CI/CD Pipelines</li>
        <li>99,9% Uptime SLA</li>
      </ul>
    </div>

    <div class="srv c-coral">
      <div class="srv-badge badge-coral">Testing</div>
      <div class="srv-icon coral">
        <svg viewBox="0 0 24 24"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
      </div>
      <h3>Qualitätssicherung</h3>
      <p>Automatisierte Tests, Code-Reviews und manuelle QA-Prozesse — für fehlerfreie Software.</p>
      <ul class="srv-list">
        <li>Unit & Integration Tests</li>
        <li>End-to-End Testing</li>
        <li>Performance Profiling</li>
      </ul>
    </div>

    <div class="srv c-pink">
      <div class="srv-badge badge-pink">Wartung</div>
      <div class="srv-icon pink">
        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
      </div>
      <h3>Pflege & Weiterentwicklung</h3>
      <p>Ihre App wächst mit Ihrem Unternehmen — wir kümmern uns um Updates, neue Features und Bugfixes.</p>
      <ul class="srv-list">
        <li>Monatliche Wartungspakete</li>
        <li>Feature-Entwicklung</li>
        <li>24h Notfall-Support</li>
      </ul>
    </div>

  </div>
</section>

<!-- ── PROZESS ── -->
<section class="sp-process">
  <div class="sp-process-head">
    <div class="section-label">Unser Vorgehen</div>
    <h2>Strukturiert zum <em>fertigen Produkt</em></h2>
    <p class="section-sub">Agile Entwicklung mit klaren Meilensteinen — transparent und termingerecht.</p>
  </div>
  <div class="steps">
    <div class="step">
      <div class="step-num">1
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </div>
      </div>
      <h3>Analyse</h3>
      <p>Anforderungsanalyse, Zieldefinition und technische Machbarkeitsstudie.</p>
    </div>
    <div class="step">
      <div class="step-num">2
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
        </div>
      </div>
      <h3>Konzept</h3>
      <p>Architektur, Datenbankmodell, UX-Konzept und interaktive Prototypen.</p>
    </div>
    <div class="step">
      <div class="step-num">3
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
      </div>
      <h3>Entwicklung</h3>
      <p>Agile Sprints, regelmäßige Demos und kontinuierliches Feedback.</p>
    </div>
    <div class="step">
      <div class="step-num">4
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
      </div>
      <h3>Launch & Betrieb</h3>
      <p>Deployment, Monitoring, Einweisung und optionaler Wartungsvertrag.</p>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="sp-cta">
  <div class="section-label">Projekt starten</div>
  <h2>Ihre App-Idee verdient die beste Umsetzung</h2>
  <p>Kostenloses Erstgespräch — wir schauen uns Ihre Anforderungen an und machen ein konkretes Angebot.</p>
  <div class="sp-cta-btns">
    <a href="index.php#kontakt" class="btn-cta-white">Jetzt anfragen</a>
    <a href="index.php#preise" class="btn-cta-outline">Preisübersicht</a>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
