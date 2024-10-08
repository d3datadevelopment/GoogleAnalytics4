<?php

namespace D3\GoogleAnalytics4\Application\Model;

use D3\GoogleAnalytics4\Application\Model\CMP\Usercentrics;

class ManagerTypes
{
    const EXTERNAL_SERVICE          = "eigener Service";
    const NET_COOKIE_MANAGER        = "Netensio Cookie Manager";

    /**
     * Further information's:
     * https://github.com/aggrosoft/oxid-cookie-compliance
     */
    const AGCOOKIECOMPLIANCE        = "Aggrosoft Cookie Compliance";

    const CONSENTMANAGER            = "Consentmanager";

    const COOKIEFIRST               = "Cookiefirst";

    const COOKIEBOT                 = "Cookiebot";

    /**
     * @return array
     */
    public function getManagerList(): array
    {
        return [
            "externalService"       => self::EXTERNAL_SERVICE,
            "agcookiecompliance"    => self::AGCOOKIECOMPLIANCE,
            "net_cookie_manager"    => self::NET_COOKIE_MANAGER,
            Usercentrics::sModuleIncludationInternalName    => Usercentrics::sModuleIncludationPublicName,
            Usercentrics::sExternalIncludationInternalName  => Usercentrics::sExternalIncludationPublicName,
            "cmconsentmanager"      => self::CONSENTMANAGER,
            "cookiefirst"           => self::COOKIEFIRST,
            "cookiebot"             => self::COOKIEBOT,
        ];
    }

    /**
     * @param string $sManager
     * @return bool
     */
    public function isManagerInList(string $sManager) :bool
    {
        return in_array($sManager, array_keys($this->getManagerList()), true);
    }
}