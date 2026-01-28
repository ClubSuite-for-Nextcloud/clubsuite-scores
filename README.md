# ClubSuite Scores

[![Nextcloud Version](https://img.shields.io/badge/Nextcloud-28--32-blue.svg)](https://nextcloud.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1--8.3-purple.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-AGPL%20v3-green.svg)](LICENSE)

> 🎵 Notenbibliothek und Stimmenverwaltung für Musikvereine.

## 📋 Übersicht

ClubSuite Scores verwaltet Ihr Notenmaterial digital:

- **Notenbibliothek**: Katalog aller Werke mit Metadaten
- **Stimmen**: Einzelstimmen pro Werk verwalten
- **Zuweisung**: Material an Mitglieder/Registergruppen zuweisen
- **Ensembles**: Gruppierung nach Besetzung
- **Ausleihe**: Tracking ausgegebener Noten

## 🚀 Installation

### Über den Nextcloud App Store
1. **ClubSuite Core** muss installiert sein
2. Apps → Organisation → "ClubSuite Scores" suchen
3. Installieren und aktivieren

### Manuelle Installation
```bash
cd /path/to/nextcloud/apps
git clone https://github.com/clubsuite/clubsuite-scores.git
php occ app:enable clubsuite-scores
```

## 📦 Anforderungen

| Komponente | Version |
|------------|--------|
| Nextcloud | 28 - 32 |
| PHP | 8.1 - 8.3 |
| **clubsuite-core** | erforderlich |

## 🔒 DSGVO / Datenschutz

- Zuweisungsdaten mit Personenbezug geschützt
- Datenexport über Nextcloud Privacy API

## 📄 Lizenz

AGPL v3 – Siehe [LICENSE](LICENSE)

## 🐛 Bugs & Feature Requests

[GitHub Issues](https://github.com/clubsuite/clubsuite-scores/issues)

---

© 2026 Stefan Schulz
