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
    const INTERNAL_CONSENTMANAGER            = "cmconsentmanager";

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
	
	/**
	 * @return array
	 *
	 * the CMP from this method always needs the script tag delivered to the dom.
	 */
	public function scriptTagDeliveredByDefaultArray() :array
	{
		return [
			Usercentrics::sModuleIncludationInternalName,
			Usercentrics::sExternalIncludationInternalName,
			ManagerTypes::CONSENTMANAGER,
			ManagerTypes::INTERNAL_CONSENTMANAGER,
			ManagerTypes::COOKIEFIRST,
			ManagerTypes::COOKIEBOT,
			ManagerTypes::EXTERNAL_SERVICE
		];
	}
}