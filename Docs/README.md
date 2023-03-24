# Technische Doku
## GA4 Events / Customizing
Für alle implementierten GA4 Events existieren Templates unter `source/modules/d3/googleanalytics4/Application/views/ga4/`, dabei entspricht der Dateiname dem Eventnamen in GA4.
Die Einbindung dieser Event-Templates erfolgt über TPL-Blöcke unter `source/modules/d3/googleanalytics4/Application/views/blocks/`.  
*Hinweis: nicht alle templates sind bereits gefüllt. Wünschen Sie die Implementierung eines unausgefüllten templates?
Kommen Sie auf uns zu unter https://www.d3data.de/

## Blöcke
Für den geregelten Ablauf sind folgende Blöcke nötig:
- Suchergebnisse
    - Blockname: search_results
    - Datei: page/search/search.tpl
    - GA4 Event: view_search_results
- Artikelliste
    - Blockname: d3Ga4_view_item_list (muss hinzugefügt werden)
    - Datei: widget/product/list.tpl
    - GA4 Event: view_item_list
- Detailseite
    - Blockname: details_productmain_title
    - Datei: page/details/inc/productmain.tpl
    - GA4 Event: view_item
- dem WK hinzufügen (button)
    - Blockname: details_productmain_tobasket
    - Datei: page/details/inc/productmain.tpl
    - GA4 Event: add_to_cart
- Warenkorb
    - Blockname: checkout_basket_main
    - Datei: page/checkout/basket.tpl
    - GA4 Event: view_cart
- abgeschlossener Kauf
    - Blockname: checkout_thankyou_main
    - Datei: page/checkout/thankyou.tpl
    - GA4 Event: purchase

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
  - In der Usercentrics-Verwaltung einen Service für Google Analytics anlegen
  - Den Service-Namen in den Moduleinstellungen des 'Google Analytics 4' unter
    ```Einstell. > Cookie Manager Einstellungen > Cookie-ID``` eintragen
