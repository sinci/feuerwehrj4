# feuerwehrj4 – Joomla 6 Template

Eigenes Joomla 6 Template für die Feuerwehr-Website. Basiert auf der Cassiopeia-Struktur und verwendet UIkit 3 als CSS/JS-Framework.

---

## Voraussetzungen

- Joomla 6.0 oder höher
- PHP 8.1 oder höher
- MySQL 8.4 oder höher

---

## Installation

### 1. Template installieren

1. Im Joomla-Backend einloggen: `https://deine-domain.de/administrator`
2. **System → Erweiterungen installieren**
3. Zip-Datei des Templates hochladen oder Ordner direkt nach `/templates/feuerwehrj4/` kopieren
4. **System → Website-Templates** öffnen
5. `feuerwehrj4` als Standard setzen (Stern-Symbol klicken)

### 2. Template-Einstellungen

Unter **System → Website-Templates → feuerwehrj4 bearbeiten**:

| Einstellung | Beschreibung |
|---|---|
| Branding | Logo und Seitentitel ein-/ausblenden |
| Logo | Bilddatei für das Logo auswählen |
| Seitentitel | Text neben dem Logo |
| Tagline | Untertitel/Slogan |
| Favicon | Favicon-Datei auswählen |
| Apple Touch Icon | Icon für iOS-Geräte |

---

## Template-Positionen

| Position | Beschreibung |
|---|---|
| `toolbar-left` | Werkzeugleiste links |
| `toolbar-right` | Werkzeugleiste rechts |
| `logo` | Logo-Bereich |
| `menu` | Hauptnavigation |
| `search` | Suchfeld |
| `header` | Kopfbereich |
| `breadcrumbs` | Brotkrumennavigation |
| `main-top` | Oberhalb des Hauptinhalts |
| `main-bottom` | Unterhalb des Hauptinhalts |
| `sidebar-left` | Linke Seitenleiste |
| `sidebar-right` | Rechte Seitenleiste |
| `mobile` | Nur für mobile Geräte |
| `footer-a` | Footer Spalte A |
| `footer-b` | Footer Spalte B |
| `footer-c` | Footer Spalte C |
| `footer-menu` | Footer Navigation |
| `debug` | Debug-Ausgabe |

---

## Template-Overrides

Folgende Joomla-Komponenten und Module haben eigene Overrides:

### Komponenten (`html/`)
- `com_contact` – Kontaktformular und Adresse
- `com_content` – Artikel- und Blogansicht (max. 100 Wörter im Blog mit automatischem Weiterlesen-Link, Bild verlinkt)
- `com_finder` – Suche
- `com_users` – Login, Passwort vergessen, Zurücksetzen

### Module (`html/`)
- `mod_articles` – Beitrags-Slideshow (UIkit) für Joomla 6
- `mod_articles_news` – Legacy-Slideshow (Joomla 5, deprecated in Joomla 6)
- `mod_breadcrumbs` – Brotkrumen
- `mod_finder` – Suchfeld
- `mod_login` – Login-Formular
- `mod_menu` – Navigation

### Plugins (`html/`)
- `plg_content_pagenavigation` – Seitennavigation
- `plg_fields_media` – Medienfeld mit UIkit Lightbox

---

## Beitrags-Slideshow einrichten (mod_articles)

1. Im Backend: **Inhalt → Module → Neu → Beiträge**
2. Kategorie auswählen
3. Unter **Erweitert → Layout**: `default` wählen
4. Modul einer Position zuweisen (z. B. `header`)
5. Im Modul-Override werden Bild, Kategorie und Titel als UIkit-Slideshow dargestellt

---

## CSS anpassen

Eigene Styles in `/css/custom.css` eintragen – diese Datei wird automatisch geladen und bei Updates nicht überschrieben.

---

## JavaScript anpassen

Eigene Scripts in `/js/custom.js` eintragen.

---

## UIkit

Das Template verwendet **UIkit 3**. Alle UIkit-Komponenten können direkt in Artikeln und Modulen über `uk-*` Attribute und CSS-Klassen verwendet werden.

Dokumentation: https://getuikit.com/docs/introduction

---

## Sicherheit

- Alle Ausgaben sind mit `htmlspecialchars()` abgesichert
- CSRF-Token in allen Formularen aktiv
- Joomla Email Cloaking Plugin schützt E-Mail-Adressen automatisch
- `defined('_JEXEC') or die` in allen PHP-Dateien vorhanden

---

## Entwicklung

```
templates/feuerwehrj4/
├── css/
│   ├── custom.css       ← eigene Styles hier eintragen
│   ├── uikit.min.css
│   └── uikit-rtl.min.css
├── js/
│   ├── custom.js        ← eigene Scripts hier eintragen
│   ├── uikit.min.js
│   └── uikit-icons.min.js
├── fonts/               ← Roboto Schriftart (lokal)
├── html/                ← Template-Overrides
├── language/            ← Sprachdateien
├── index.php            ← Haupt-Template
├── error.php            ← Fehlerseite
├── offline.php          ← Wartungsseite
├── component.php        ← Komponenten-Layout
└── templateDetails.xml  ← Template-Konfiguration
```

---

## Git

```bash
# Änderungen committen
git add .
git commit -m "Beschreibung der Änderung"

# Auf Remote pushen
git push origin master
git push origin feature
```

Branches:
- `master` – stabiler Stand
- `feature` – neue Funktionen in Entwicklung
