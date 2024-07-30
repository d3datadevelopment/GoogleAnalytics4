<?php
$sLangName = "Deutsch";
// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(
    'charset'                   => 'UTF-8',

    'd3mxgoogleanalytics4'      => 'Google Analytics 4',
    'd3mxgoogleanalytics4set'   => 'Einstellungen',

    // Base Translations
    'D3BASECONFIG'              => 'Grundeinstellungen',
    'D3CLOSE'                   => 'Schließen',
    'D3NONE'                    => '- keinen -',
    'D3CONTAINERID'             => 'Container-ID',
    'D3CONTAINERID_HELP'        => '<a target="_blank" href="https://github.com/d3datadevelopment/GoogleAnalytics4/blob/master/Docs/README.md#Container-ID" class="text-muted text-decoration-none"><i class="bi bi-book-half"></i> Was ist die <strong>Container-ID</strong>?</a>',
    'D3ACTIVATEMOD'             => 'Modul aktivieren',
    'D3CNTRLPARAM'              => 'Steuerungsparameter',
    'D3CNTRLPARAM_HELP'         => '<a target="_blank" href="https://github.com/d3datadevelopment/GoogleAnalytics4/blob/master/Docs/README.md#steuerungsparameter" class="text-muted text-decoration-none"><i class="bi bi-book-half"></i> Was ist der <strong>Steuerungsparameter</strong>?</a>',
    'D3INACTIVATEMOD'           => 'Modul ist nicht aktiv! Es werden keine Funktionen ausgespielt!',
    // Usercentrics Dynamische Optionen
    'D3USRCNTRCSDYNOPT'         => 'Usercentrics Dynamische Optionen',

    // Use debug mode?
    'D3USEDEBUGMODE'            => "Debug-Modus aktivieren",
    'D3USEDEBUGMODE_HELP'       => "Der <strong>Debug Modus</strong> setzt an alle DataLayer ( also Daten Sammlungen im Frontend )
                                    <strong>'debug_mode': 'true'</strong> und ermöglicht im Google Tag Manager selbst ein detaillierteres
                                    Auswerten des einfließenden Datenstroms.",

    // Use Consentmode?
    'D3USEGOOGLECONSENTMODE'    => "Google Consent Mode 'Default Values' akivieren",
    'D3USEGOOGLECONSENTMODE_HELP'   => "Der <trong>Consent Mode 'Default Values'</trong> setzt im Frontend, 
                                        vor jedem Sammeln und Senden von Daten, einen Befehl der die Bearbeitung der Daten fortlaufend verändert.<br>
                                        <br>
                                        Diese Veränderte Berarbeitung heißt im Detail, dass der Google Tag Manager ( GTM ) 
                                        bzw. in erster Instanz die Consent Management Platform ( CMP ) keine Daten zur Verarbeitung an Google sendet,
                                        bis ein entsprechendes Zustimmungs-Signal vom Kunden explizit erteilt wurde.<br>
                                        Die CMP ist sogar derartig restriktiv, dass diese den Datenstrom zum GTM ( Vorinstanz zu Google Analytics ) 
                                        völlig verhindert, solange keine Zustimmung erteilt wurde.<br>
                                        <br>
                                        Ein einfaches anschalten dieser Funktion regelt noch <strong>nicht</strong> die völlige Funktionsweise
                                        aller beteiligten Instanzen; diese bedarf eine detailiertere Konfiguration!<br>",

    // Use CMP?
    'D3CMPTABTITLE'             => 'Cookie Manager Einstellungen',
    'D3CMPUSEQ'                 => 'Consent Management Platform ( CMP ) nutzen?',
    'D3CMPUSEQ_HELP'            => '"Eine Consent Management Platform ( CMP ) ist eine Software, mit der Website-Betreiber 
                                    oder Anbieter von Web-Apps über ein Banner oder ein Pop-up eine datenschutzrechtliche 
                                    Einwilligung der Besucher einholen und speichern, bevor Nutzerdaten über 
                                    Website-Skripte erfasst werden (Tracking)." <a target="_blank" href="https://de.wikipedia.org/wiki/Consent_Management_Platform">Wikipedia Beschreibung</a><br>
                                    <br>
                                    Um Google Analytics 4 ( <a target="_blank" href="https://marketingplatform.google.com/intl/de/about/analytics/">Google Analytics</a> ) weiterhin nutzen zu können,
                                    und dank fortschreitendem Datenschutz unserer personenbezogener Daten, ist das Nutzen eines konformen CMP
                                    heute zwangläufig nötig.<br>
                                    <br>
                                    Diese konformen CMP sind in 
                                    <a target="_blank" href="https://cmppartnerprogram.withgoogle.com/">offizieller Partnerschaft mit Google ( Liste der Partner )</a> 
                                    und unterliegen strengen Vorschriften, um ein ordnungsgemäßes Senden und 
                                    Verarbeiten der Zustimmung unterliegenden Daten sicher zu stellen.',
    'D3CMP'                     => 'Consent Management Platform ( CMP ) wählen',

    // Usercentrics Config
    // activate Individual Default Values
    'D3USRCNTRCSCFG_ACT_INDIVDEFVAL'    => "usercentrics individual 'Default Values' aktiveren",
    // standard Consent
    'D3USRCNTRCSCFG_STD_CNST'           => "GTM Standard Consent",
    // activate consent mode API
    'D3USRCNTRCSCFG_ACT_CNSTMDE_API'    => "Usercentrics Consent Mode API aktivieren",
    // consent mode api
    'D3USRCNTRCSCFG_CNSTMDE_API'        => "Consent Mode API",
    'D3USRCNTRCSCFG_DOCS'               => 'Nähere Infos zu den hier konfigurierbaren Einstellungen entnehmen Sie bitte der offiziellen
                                            Dokumentation von Usercentrics selbst: <a href="https://docs.usercentrics.com/#/consent-mode" class="text-primary"><i class="bi bi-book-half"></i> Dokumentation</a>',
    'D3USRCNTRCSCFG_WARNING'            => "Bevor Sie hier Anpassungen machen, konsultieren Sie bitte einen technischen Support!<br>
                                            Anpassungen können zu Beeinträchtigungen und Ausfall von Funktionen im Frontend führen!",

    // Additional Config
    // Server-Side tagging
    'D3SERVERSIDETAGGING'       => 'Server-Side tagging',
    'D3DETAILED_DESC'           => 'Detailliertere Erklärung der Funktion',
    'D3SERVERSIDETAGGING_HINT'  => 'Die Conatiner-ID wird weiterhin unter "Grundeinstellungen" eingetragen!<br><br>
    "Serverseitiges Tagging ist eine neue Möglichkeit, mit Google Tag Manager Ihre Anwendung geräteübergreifend zu verwalten.<br>
    Servercontainer verwenden dasselbe Tag-, Trigger- und Variablenmodell, das Sie gewohnt sind.<br> 
    Außerdem bieten sie neue Tools, mit denen Sie Nutzeraktivitäten überall messen können." <br>
    <br>
    - Quelle <a href="https://developers.google.com/tag-platform/tag-manager/server-side/intro">Developers-Google Server-Side tagging</a><br>
    <br>
    <strong>Verändern Sie die Werte nur, wenn Sie Server-Side tagging verwenden wollen! Gegebenenfalls fragen Sie einen technischen Ansprechpartner.</strong>
    ',
    'D3SERVERSIDETAGGING_TITLE_ACTIVE'   => 'Ausführender code',
    'D3SERVERSIDETAGGING_ACTIVE'    => 'Diese Domain wird im <strong>aktiven</strong>-code ausgefüht. Das heißt,
                                                                        dass es sich hierbei um das HTML-Tag <code>script</code> handelt.
                                                                        Dieses kümmert sich darum, dass die im DataLayer
                                                                        zusammengefassten Daten an den GTM weitergeleitet werden.<br>
                                                                        <br>
                                                                        <h4>Folgend eine Darstellung, was genau ausgetauscht wird</h4>
                                                                        <pre>
<code>
Vorher:
https://www.googletagmanager.com/gtm.js?id=

Nachher:
{Domain}?id=
</code>
                                                                        </pre>',
    'D3SERVERSIDETAGGING_TITLE_PASSIVE'   => '<u>nicht</u>&nbsp;Ausführneder code',
    'D3SERVERSIDETAGGING_PASSIVE'   => 'Diese Domain wird im <strong>passiven</strong>-code ausgefüht. Das heißt,
                                                                        dass es sich hierbei um das HTML-Tag <code>noscript</code> handelt.
                                                                        Dieses wird ausgeführt, wenn aus einem bestimmten Grund
                                                                        das Javascript nicht ausgeführt wird.<br>
                                                                        ( keine Cookies erlaubt, JavaScript-Unterbindung, ... )
                                                                        <br>
                                                                        <h4>Folgend eine Darstellung, was genau ausgetauscht wird</h4>
                                                                        <pre>
<code>
Vorher:
src="https://www.googletagmanager.com/ns.html?id={Container-ID}"

Nachher:
src="{Domain}?id={Container-ID}"
</code>
                                                                        </pre>',
);