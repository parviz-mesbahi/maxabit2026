## CMS Projektbeschreibung

## Was ist dieses Projekt?


---

## Tech-Stack

- **Sprache:** PHP (kein Framework)
- **Datenbank:** keine – Inhalte in JSON-Dateien (`content/`)
- **CSS:** reines CSS, keine Bibliotheken
- **Webserver:** Apache/nginx (lokal: Homebrew)
- **Pfad:** `/opt/homebrew/var/www/maxabit2026`

---

## Dateistruktur

```
maxabit2026/
├── index.php              # Startseite (Hero + Feature-Bereich + Footer)
├── init_layout.html          # Testfall-Übersicht mit Tabelle und Filtern
├── css/
│   └── main.css           # Globales Stylesheet (alle Seiten)
├── content/
│   ├── index.json         # Inhalte für index.php
├── admin/
│   ├── index.php          # Admin-Panel (Login + Seitenauswahl + Formulare)
│   └── save.php           # Speichert POST-Daten zurück in die JSON-Datei
├── js/
├── images/
```

## layout design
Referenz Bild is xxxx.png
erstelle jetzt index.php + css/main.css — sauber getrennt, pixel-genau zum Referenzbild.



---

## Seiten

- index.php
- impressum.php
- datenschutz.php


Daten für die php-seite werden in json gespeichert
`content/index.json`.
`content/impressum.json`.
`content/datenschutz.json`.


---

## Admin-Bereich (`admin/index.php`)

### Login
- Passwort-geschützt via PHP-Session
- Standard-Passwort: `testflow2024` (in `admin/index.php` ändern)
- Einfaches Login-Formular, zentriert

### Nach dem Login
- **Sidebar** (dunkel, `#1a1a2e`) mit den verfügbaren Seiten
- Klick auf eine Seite lädt deren JSON via `?page=index` oder `?page=testcases`
- Formularfelder entsprechen den JSON-Schlüsseln der jeweiligen Seite
- "Speichern"-Button sendet an `save.php?page=<name>`
- `save.php` schreibt die Daten zurück in die JSON-Datei und leitet weiter


---

## JSON-Struktur

### content/index.json
```json
{
  "hero_badge": "...",
  "hero_h1": "...",
  "hero_h1_accent": "...",
  "hero_text": "...",
  "hero_cta_primary": "...",
  "hero_cta_secondary": "...",
  "feature_label": "...",
  "feature_h2": "...",
  "feature_text": "...",
  "feature_list": ["...", "...", "..."],
  "feature_btn": "..."
}
```



---

## Durchgeführte Schritte (Chronologisch)

### Schritt 1 – index.php vereinfachen
- Alle alten Sektionen entfernt (Trust, Services, About, Process, Testimonials, FAQ, CTA)
- Nur Nav, Hero, Notiz-Bereich und Footer behalten
- Texte auf Testcasemanagement-Tool umgeschrieben (Branding: "TestFlow")
- Abhängigkeit von `content.json` entfernt

### Schritt 2 – Design vereinfachen (main.css)
- Altes CSS komplett ersetzt (Blobs, Blätter, bunte Karten entfernt)
- Neues minimales CSS: weiß/grau mit Blau als Akzentfarbe
- Klare Typografie, einfache Buttons, dezente Borders
- Kein externes Framework

### Schritt 3 – Inhalt zentrieren
- `max-width: 900px; margin: 0 auto` als `.page`-Wrapper in CSS
- `<div class="page">` in index.php eingebaut

### Schritt 4 – Notiz-Textarea durch Feature-Sektion ersetzen
- Textarea-Block entfernt
- Neue `.feature-section`: Text links, Bild rechts
- Aufzählungsliste mit blauen Häkchen
- Platzhalterbild via `placehold.co`

### Schritt 5 – testcases.php erstellen
- Neue Seite mit Statistik-Kacheln, Filter-Toolbar und Tabelle
- 10 Beispiel-Testfälle als PHP-Array hardcodiert
- Farbige Status- und Prioritäts-Badges
- Gleiches Design wie index.php (gleiche CSS-Datei)

### Schritt 6 – Navigation verknüpfen
- "Testfälle" in Nav von index.php auf `testcases.php` verlinkt
- Aktiver Link in testcases.php blau hervorgehoben

### Schritt 7 – admin/index.php anpassen
- Altes "Praxis Marzock"-Admin komplett ersetzt
- TestFlow-Branding (blauer Logo-Block)
- Sidebar mit Seitenliste statt Sektionsliste

### Schritt 8 – Admin: seitenbasierte Navigation
- Sidebar zeigt die Seiten: Startseite, Testfälle
- URL-Parameter `?page=` steuert welches JSON geladen wird
- `index.php` → `content/index.json`
- `testcases.php` → `content/testcases.json`
- Für jede Seite eigene Formularfelder
- JSON-Dateien mit TestFlow-Inhalten neu befüllt

### Schritt 9 – save.php korrigiert
- Problem: `save.php` schrieb noch in die alte `content.json` und kannte `?page=` nicht
- Lösung: `save.php` komplett neu geschrieben
- Liest `?page=` aus der URL und wählt die passende JSON-Datei
- `?page=index` → schreibt in `content/index.json` (Hero + Feature-Felder)
- `?page=testcases` → schreibt in `content/testcases.json` (Testfall-Array)
- Leitet nach dem Speichern zurück zu `admin/index.php?page=<name>&saved=1`

### Schritt 10 – Zentrales Menü (menu.php)
- `menu.php` als eigene Datei erstellt
- Enthält alle Nav-Links: Dashboard, Testfälle, Testläufe, Berichte + CTA-Button
- Aktiver Link wird automatisch blau hervorgehoben via `basename($_SERVER['PHP_SELF'])`
- `function_exists('h')` verhindert Doppeldefinition beim Include
- In `index.php` und `testcases.php` ersetzt durch `<?php include __DIR__ . '/menu.php'; ?>`
- CSS: `.nav-links a.active` ergänzt
- Neue Seiten einbinden: `<?php include __DIR__ . '/menu.php'; ?>` in `<div class="page">` einfügen

### Schritt 11 – Menü aus JSON (content/menu.json)
- `content/menu.json` erstellt mit Menüpunkten (label + href) und CTA-Button (cta_label, cta_href)
- `menu.php` liest jetzt `content/menu.json` statt hardcodierter Links
- Admin: neuer Sidebar-Link "Menü" (🔗) unter `?page=menu`
- Formular: Bezeichnung + href für jeden Menüpunkt, CTA-Label + CTA-href bearbeitbar
- `save.php` um `menu`-Block erweitert → speichert in `content/menu.json`
- Änderungen im Admin erscheinen sofort im Menü aller Seiten

### Schritt 12 – href-Felder im Admin Menü als readonly
- Felder "Ziel (href)" bei Menüpunkten und CTA-Button auf `readonly` gesetzt
- Visuell: grauer Hintergrund (`#f3f4f6`), grauer Text (`#9ca3af`), kein Textcursor
- Nebenbei: fehlerhaftes `"` nach `readonly` in Zeile 366 behoben

### Schritt 13 – Feature-Bild über Admin änderbar
- `feature_image` in `content/index.json` hinzugefügt (Wert: `"images/testcase.png"`)
- `index.php` liest Bildpfad dynamisch aus JSON: `<?= h($c['feature_image']) ?>`
- Admin `?page=index`: neue Sektion "Feature-Bild" mit Vorschau und Upload-Feld
- Formular-Tag um `enctype="multipart/form-data"` erweitert (Pflicht für Datei-Uploads)
- `save.php`: prüft MIME-Type (JPG, PNG, WebP) und Dateigröße (max. 5 MB), speichert als `images/feature.<ext>`, schreibt Pfad in JSON

---

## Neues Projekt starten (Vorlage)

1. Ordnerstruktur kopieren: `index.php`, `css/main.css`, `admin/`, `content/`
2. `content/index.json` mit neuen Inhalten befüllen
3. Neue Seiten anlegen (z.B. `dashboard.php`) und in `$pages`-Array in `admin/index.php` eintragen
4. Für jede neue Seite:
   - JSON-Datei in `content/` anlegen
   - In `admin/index.php` einen `elseif`-Block mit den Formularfeldern ergänzen
   - `save.php` um den neuen Seitentyp erweitern
5. Passwort in `admin/index.php` ändern (`define('ADMIN_PASS', '...')`)
6. CSS-Akzentfarbe anpassen (`#2563eb` suchen/ersetzen)
