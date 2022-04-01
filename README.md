# rocketmedia-mfTest-2022

Repository für Marcel Freitag.

Aufgabe: Mini Gästebuch

Entwickle in einem Framework Deiner Wahl
- Nutze ein Datenbank-System Deiner Wahl (zB MySQL oder SQLite)
- Nutze eine Composer Installation des Frameworks
- Achte auf Clean Code

Anwendung:

- Der Besucher der Anwendung sieht die 10 letzten Gästebucheinträge (List-Action) und kann einen neuen Eintrag erstellen (Save-Action)
- Bitte nutze Ajax zum POSTen eines neuen Eintrages
- Die Gästebucheinträge werden in der Datenbank gespeichert, nutze den ORM des Frameworks dazu
- Einträge sollen nicht > 150 Zeichen sein
- Mit einem Console Command können Einträge gelöscht werden, die älter als 10 Tage sind
- Der Command nutzt dazu einen Service, der je Eintrag entscheidet, ob dieser älter 10 Tage ist
- Bitte schreibe einen Unit Test für den Service

Hinweise:
Datenbank anfangs befüllen über:
php bin/console doctrine:fixtures:load

Webpack ausführen über:
npm run watch

TODO:
- Mögliche Fehlermeldungen nach AJAX Submit anzeigen