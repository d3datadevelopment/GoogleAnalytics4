<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

$style = '<style type="text/css">
.groupExp a.rc b {font-size:medium;color:#ff3600;}
.groupExp dt .txt,
.groupExp dt .select,
.groupExp dt .txtfield {width:250px !important; margin: 2px !important; padding: 1px 4px !important; border: 1px solid #ccc !important; }
.groupExp dt textarea.txtfield { min-height: 125px;}
.groupExp dl { display:block !important;}
input.confinput {position:fixed;top:20px;right:70px;background:#008B2D;padding:10px 25px;color:white;border:1px solid black;cursor:pointer;font-size:125%;}
input.confinput:hover {outline:3px solid #ff3600;}
</style>';
$aLang = [
    'charset'                               => 'UTF-8',
    'SHOP_MODULE_d3_gtm_sContainerID'      => 'Container ID',
    'SHOP_MODULE_GROUP_d3_gtm_settings'     => 'Einstellungen',
    'SHOP_MODULE_d3_gtm_blGA4enab'          => 'GA4 Aktivieren',
    'SHOP_MODULE_d3_gtm_blUAenabled'        => 'UA Aktivieren',
    'SHOP_MODULE_d3_gtm_blEnableDebug'      => 'Debug-Modus aktivieren',

    // for cookie manager settings
    'SHOP_MODULE_GROUP_d3_gtm_settings_cookiemanager'   => 'Cookie Manager Einstellungen',
    'SHOP_MODULE_d3_gtm_settings_hasOwnCookieManager'   => 'Eigenen Cookie Manager nutzen?',
    'SHOP_MODULE_d3_gtm_settings_cookieName'            => 'Cookie-Name',
    'SHOP_MODULE_d3_gtm_settings_blEnableUserCentrics'  => 'UserCentrics verwenden',
    'HELP_SHOP_MODULE_d3_gtm_settings_blEnableUserCentrics' => 'Wenn Sie UserCentrics nutzen, geben sie Feld "Cookie-Name" die in UserCentrics definierte Bezeichnung des Service ("Google Analytics") ein.',
];
