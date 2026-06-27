<?php
function h($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Impressum – MaxaBit IT-Solutions</title>

  <link rel="stylesheet" href="css/main.css">
  <style>
    .legal-section h1,.legal-section h2,.legal-section h3{font-family:var(--display)}
    .legal-section h1{font-size:1.75rem;margin-top:2rem}
    .legal-section h2{font-size:1.2rem;margin-top:1.75rem}
    .legal-section h3{font-size:1rem;margin-top:1.25rem;margin-bottom:.4rem}
    .legal-section strong{display:inline-block;margin-bottom:.25rem}
  </style>
</head>
<body>

<?php include __DIR__ . '/menu.php'; ?>

<?php include __DIR__ . '/consent.php'; ?>

<section class="legal-section" style="margin-top: 70px; margin-left: 30px">
  <div class="legal-container">
    <h1>Impressum</h1>

    <h2>Angaben gemäß § 5 TMG</h2>
    <p>
      MaxaBit IT-Solutions<br>
      Gallus Straße 80 a <br>
      53227 Bonn <br>
      Deutschland
    </p>

    <h2>Kontakt</h2>
    <p>
      Telefon: +49 (0) 228 9480361<br>
      E-Mail: info@maxabit.de
    </p>

    <h2>Vertreten durch</h2>
    <p>Parviz Mesbahi (Geschäftsführer)</p>

    <h2>Umsatzsteuer-ID</h2>
    <p>
      Umsatzsteuer-Identifikationsnummer gemäß § 27a Umsatzsteuergesetz:<br>
      DE 206/5212/0753
    </p>

    <h2>Berufsbezeichnung und berufsrechtliche Regelungen</h2>
    <p>
      Berufsbezeichnung: IT-Dienstleister / Webentwicklung<br>
      Zuständige Kammer: IHK Bonn<br>
    </p>

    <h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h2>
    <p>
      Parviz Mesbahi
    </p>

    <h2>EU-Streitschlichtung</h2>
    <p>
      Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
      <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>.<br>
      Unsere E-Mail-Adresse finden Sie oben im Impressum.
    </p>

    <h2>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h2>
<!--    <p>-->
<!--      Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer-->
<!--      Verbraucherschlichtungsstelle teilzunehmen.-->
<!--    </p>-->

    <h2>Haftung für Inhalte</h2>
    <p>
      Als Diensteanbieter sind wir gemäß § 7 Abs. 1 TMG für eigene Inhalte auf diesen Seiten nach den
      allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht
      verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen
      zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
    </p>
    <p>
      Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen
      Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt
      der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden
      Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
    </p>

    <h2>Haftung für Links</h2>
    <p>
      Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben.
      Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der
      verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
    </p>

    <h2>Urheberrecht</h2>
    <p>
      Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen
      Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der
      Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
      Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.
    </p>
  </div>
</section>
<p style="margin-bottom: 30px"></p>

<?php include __DIR__ . '/footer.php'; ?>

</body>
</html>
