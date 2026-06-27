<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>KI-Integration – MaxaBit IT-Solutions</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/service.css">
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>
<?php include __DIR__ . '/consent.php'; ?>

<!-- ── HERO ── -->
<section class="sp-hero sp-hero-mint">
  <div class="sp-blob sp-blob-1"></div>
  <div class="sp-blob sp-blob-2"></div>
  <div class="sp-hero-inner">
    <div class="sp-tag">
      <div class="sp-tag-dot"><span></span></div>
      KI-Spezialisten
    </div>
    <h1>KI-Power für <em class="hl">Ihr Unternehmen</em></h1>
    <p class="sp-hero-sub">
      Wir integrieren Künstliche Intelligenz direkt in Ihre bestehenden Prozesse und Produkte —
      von intelligenten Chatbots über Prozessautomatisierung bis zur individuellen KI-Lösung mit großen Sprachmodellen.
    </p>
    <div class="sp-hero-btns">
      <a href="index.php#kontakt" class="btn-primary">
        KI-Potenzial entdecken
        <svg viewBox="0 0 24 24"><polyline points="5 12 19 12"/><polyline points="13 6 19 12 13 18"/></svg>
      </a>
      <a href="index.php#ki" class="btn-sec">Mehr erfahren</a>
    </div>
  </div>
</section>

<!-- ── FEATURES ── -->
<section class="sp-features">
  <div class="sp-features-head">
    <div class="section-label">KI-Lösungen</div>
    <h2>Von der Idee zur <em>intelligenten Anwendung</em></h2>
    <p class="section-sub">Wir machen KI für Ihr Unternehmen greifbar — praxisnah, datenschutzkonform und messbar.</p>
  </div>
  <div class="sp-grid">

    <div class="srv c-mint">
      <div class="srv-badge badge-mint">Chat</div>
      <div class="srv-icon mint">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      </div>
      <h3>KI-Chatbots</h3>
      <p>Intelligente Assistenten für Ihren Kundenservice — rund um die Uhr verfügbar, lernfähig und individuell trainiert.</p>
      <ul class="srv-list">
        <li>GPT-4 / Claude Integration</li>
        <li>Auf Ihre Datenbasis trainiert</li>
        <li>Website & WhatsApp Integration</li>
      </ul>
    </div>

    <div class="srv c-sky">
      <div class="srv-badge badge-blue">Automation</div>
      <div class="srv-icon sky">
        <svg viewBox="0 0 24 24"><polyline points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </div>
      <h3>Prozessautomatisierung</h3>
      <p>Wiederkehrende Aufgaben automatisch erledigen lassen — von der Dokumentenverarbeitung bis zur E-Mail-Klassifizierung.</p>
      <ul class="srv-list">
        <li>Dokumenten-Extraktion</li>
        <li>E-Mail-Routing</li>
        <li>Workflow-Automatisierung</li>
      </ul>
    </div>

    <div class="srv c-purple">
      <div class="srv-badge badge-purple">LLM</div>
      <div class="srv-icon purple">
        <svg viewBox="0 0 24 24"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 0 2h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1 0-2h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2z"/></svg>
      </div>
      <h3>LLM-Integration</h3>
      <p>Große Sprachmodelle (GPT, Claude, Llama) direkt in Ihre Anwendungen integriert — sicher und auf Ihre Daten zugeschnitten.</p>
      <ul class="srv-list">
        <li>RAG (Retrieval Augmented Generation)</li>
        <li>Fine-Tuning & Prompting</li>
        <li>On-Premise & Cloud</li>
      </ul>
    </div>

    <div class="srv c-yellow">
      <div class="srv-badge badge-yellow">Analyse</div>
      <div class="srv-icon yellow">
        <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      </div>
      <h3>Datenanalyse & Vorhersage</h3>
      <p>KI-gestützte Auswertung Ihrer Unternehmensdaten — Muster erkennen, Trends vorhersagen, Entscheidungen verbessern.</p>
      <ul class="srv-list">
        <li>Predictive Analytics</li>
        <li>Anomalie-Erkennung</li>
        <li>Dashboard & Reporting</li>
      </ul>
    </div>

    <div class="srv c-coral">
      <div class="srv-badge badge-coral">Vision</div>
      <div class="srv-icon coral">
        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
      </div>
      <h3>Computer Vision</h3>
      <p>Bilder und Videos automatisch analysieren — von der Qualitätskontrolle bis zur Dokumentenerkennung.</p>
      <ul class="srv-list">
        <li>Bildklassifizierung</li>
        <li>OCR & Dokumentenanalyse</li>
        <li>Objekterkennung</li>
      </ul>
    </div>

    <div class="srv c-pink">
      <div class="srv-badge badge-pink">Custom AI</div>
      <div class="srv-icon pink">
        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
      </div>
      <h3>Individuelle KI-Lösung</h3>
      <p>Kein Standard-Tool trifft Ihren Bedarf? Wir entwickeln maßgeschneiderte KI-Lösungen speziell für Ihr Unternehmen.</p>
      <ul class="srv-list">
        <li>Requirements Engineering</li>
        <li>Modellentwicklung & Training</li>
        <li>Evaluation & Deployment</li>
      </ul>
    </div>

  </div>
</section>

<!-- ── PROZESS ── -->
<section class="sp-process">
  <div class="sp-process-head">
    <div class="section-label">Unser KI-Vorgehen</div>
    <h2>Von der Analyse zur <em>intelligenten Lösung</em></h2>
    <p class="section-sub">Strukturiert, datenschutzkonform und immer mit messbarem Mehrwert für Ihr Unternehmen.</p>
  </div>
  <div class="steps">
    <div class="step">
      <div class="step-num">1
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </div>
      </div>
      <h3>Potenzialanalyse</h3>
      <p>Wir identifizieren die größten KI-Hebel in Ihrem Unternehmen — schnell und praxisnah.</p>
    </div>
    <div class="step">
      <div class="step-num">2
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 0 2h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1 0-2h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2z"/></svg>
        </div>
      </div>
      <h3>Modellauswahl</h3>
      <p>Wir wählen das optimale KI-Modell — Open Source, Cloud oder Custom — für Ihren Anwendungsfall.</p>
    </div>
    <div class="step">
      <div class="step-num">3
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
      </div>
      <h3>Integration</h3>
      <p>Nahtlose Einbindung in Ihre bestehenden Systeme, Workflows und Anwendungen.</p>
    </div>
    <div class="step">
      <div class="step-num">4
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
      </div>
      <h3>Monitoring</h3>
      <p>Kontinuierliche Überwachung, Optimierung und Weiterentwicklung der KI-Lösung.</p>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="sp-cta">
  <div class="section-label">KI starten</div>
  <h2>Entdecken Sie das KI-Potenzial Ihres Unternehmens</h2>
  <p>In einem kostenlosen 30-Minuten-Gespräch zeigen wir Ihnen, welche KI-Lösungen sofort Mehrwert liefern.</p>
  <div class="sp-cta-btns">
    <a href="index.php#kontakt" class="btn-cta-white">Kostenlos beraten lassen</a>
    <a href="index.php#ki" class="btn-cta-outline">KI-Funktionen ansehen</a>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
