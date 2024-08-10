<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Application\Model\CMP;


use D3\GoogleAnalytics4\Application\Model\ManagerTypes;

/**
 * Used the OXID Module.
 *
 * Further information's:
 * https://docs.oxid-esales.com/modules/usercentrics/de/latest/einfuehrung.html
 *
 * Usercentrics homepage:
 * https://usercentrics.com
 */
class Usercentrics extends ConsentManagementPlatformBaseModel
{
    const sExternalIncludationPublicName    = "( Externe Einbindung ) Usercentrics";
    const sExternalIncludationInternalName  = "usercentrics";
    const sModuleIncludationPublicName      = "( Modul ) Usercentrics";
    const sModuleIncludationInternalName    = "oxps_usercentrics";
}