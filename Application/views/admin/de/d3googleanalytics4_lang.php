<?php
$sLangName = "Deutsch";
// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(
    'charset'                   => 'UTF-8',

    'd3mxgoogleanalytics4'      => 'Google Analytics 4',
    'd3mxgoogleanalytics4set'   => 'Modulverwaltung',

    // Base Translations
    'D3BASECONFIG'              => 'Grundeinstellungen',
    'D3CLOSE'                   => 'Schließen',
    'D3NONE'                    => '- keinen -',
    'D3CONTAINERID'             => 'Container-ID',
    'D3ACTIVATEMOD'             => 'Modul aktivieren',
    'D3CNTRLPARAM'              => 'Steuerungsparameter',

    // Use debug mode?
    'D3USEDEBUGMODE'            => "Debug-Modus aktivieren",

    // Use Consentmode?
    'D3USEGOOGLECONSENTMODE'    => "Google Consent Mode 'Default Values' akivieren",

    // Use CMP?
    'D3CMPTABTITLE'             => 'Cookie Manager Einstellungen',
    'D3CMPUSEQ'                 => 'Cookie Manager nutzen?',
    'D3CMP'                     => 'Consent Management Platform ( CMP )',

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