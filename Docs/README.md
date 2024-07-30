# Technische Doku
## GA4 Events / Customizing
Für alle implementierten GA4 Events existieren Templates unter `source/modules/d3/googleanalytics4/Application/views/event/`, dabei entspricht der Dateiname dem Eventnamen in GA4.
Die Einbindung dieser Event-Templates erfolgt über TPL-Blöcke unter `source/modules/d3/googleanalytics4/Application/views/blocks/`.  
*Hinweis: nicht alle templates sind bereits gefüllt. Wünschen Sie die Implementierung eines unausgefüllten templates?
Kommen Sie auf uns zu unter https://www.d3data.de/

## Container-ID
Diese finden Sie im "Google-Tag-Manager"-Arbeitsbereich in der Navigationsleiste.
Sie beginnt mit GTM, gefolgt von einem Bindestrich und einer Zeichenkette. 

Diese ID wird benötigt, um Google anzuweise, zu welchem "Google Tag Manager"-Arbeitsbereich die
gesammelten Daten im Daten-Stream geleitet werden sollen.

## Steuerungsparameter
Tragen Sie hier im Normalfall die ID des zu prüfenden Cookies ein.  
In bestimmten Fällen, müssen Sie hier alternative Werte eintragen. Diese Fälle sind bedingt
nach der gewählten CMP (Consent Manager Platform).  
  
> nähere Infos unter [CMP](#consent-manager-platform-cmp)

## Verfügbare Datalayer Variablen
Für die einfachste Übersicht der enthaltenen Daten empfehle ich den Vorschau-Modus vom Google Tag Manager.

Bei jedem Seitenaufruf wird die Datenschicht mit einigen wenigen Infos erstellt, die man zum reinen Erfassen der Seitenaufrufe benötigt:
+ **page.type** - Seitentyp: default / cms / product / listing / checkout (an google analytics angelehnt)
+ **page.title** - Seitentitel (außer Startseite, sie hat keinen Titel)
+ **page.cl** - OXID Controller Klasse (start, search, etc)
+ **userid** - oxId vom Benutzer bzw `false` falls nicht eingeloggt
+ **sessionid** - session iD

Alle für Ecommerce Tracking relevanten Daten werden mit speziellen Ecommerce Events in die Datenschicht eingefügt.

## Cookie-Handling
Sie nutzen einen eigenen, als Modul im Shop installierten, Cookie-manager?  
Dann tragen Sie in den Folgeeinstellungen unter "Cookie Manager Einstellungen", 
die Cookie-ID des zugehörigen Cookies ein.  
Aktivieren Sie anschließend diese Weiche. Setzen Sie den Haken bei "Eigenen Cookie Manager nutzen?".

## Consent Manager Platform (CMP)
- [Consentmanager](https://git.d3data.de/D3Public/GoogleAnalytics4/src/branch/master/Docs/CMP/consentmanager.md)

### Unterstützung für
- [aggrosoft - oxid-cookie-compliance](https://github.com/aggrosoft/oxid-cookie-compliance)
  - https://github.com/aggrosoft/oxid-cookie-compliance
  - die entsprechend gewählte Kategorie in den Moduleinstellungen des 'Google Analytics 4' unter
    ```Einstell. > Cookie Manager Einstellungen > Cookie-ID``` eintragen
  - Default-Werte sind entweder ```ANALYTICS``` oder ```MARKETING```. Bitte auf die Großschreibung achten.

- [Netensio - Cookie Consent Manager](https://www.netensio.de/oxid-eshop-module/cookie-consent-manager-fuer-oxid-eshop.html)
  - Modul entsprechend konfigurieren
  - CookieID des angelegten Cookies in den Moduleinstellungen des 'Google Analytics 4' unter
    ```Einstell. > Cookie Manager Einstellungen > Cookie-ID``` eintragen

- [OXID Cookie Management powered by usercentrics](https://docs.oxid-esales.com/modules/usercentrics/de/latest/einfuehrung.html)
  - In der Usercentrics-Verwaltung die Services "Google Analytics" und "Google Tag Manager" anlegen
  - Den Service ```Google Tag Manager``` in den Moduleinstellungen des 'Google Analytics 4' unter
    Google Tag Manager eintragen
 
- [Consent Management Provider](https://www.consentmanager.net/)
  - In der Consentmanager-Oberfläche den Anbieter "Google Tag Manager" mit der ID s905 hinzufügen
  - Im Frontend, im consentmanager-Pop-up nach dem 'Google Tag Manager' suchen
    - kleines Fragezeichen neben den Namen anklicken und ganz runter scrollen
      - prüfen, ob ein Cookie vorgegeben ist
      - sonst, in der Consentmanager-Oberfläche Cookie-Liste entsprechendes Cookie suchen und im Admin unter
        ```Einstell. > Cookie Manager Einstellungen > Cookie-ID``` eintragen

- [Cookiefirst](https://cookiefirst.com)
  - im Cookiefirst-Hub das jeweilige Cookie finden underen zugeordnete Kategorie kopieren
  - die kopierte Kategory wird nun in den Einstellungen des Moduls hinterlegt:
  ```Erweiterungen > Module > Google Analytics 4 > Einstell. > Cookie Manager Einstellungen > Steuerungsparameter (vormals CookieID)```
  - **Wichtig!** bei Nutzung des Consent-Managers von Google, muss zwangsläufig die Einstellung "Cookie manager Nutzen?" __ausgeschalten!__ werden