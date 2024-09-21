<?php

namespace D3\GoogleAnalytics4\Application\Model;

use D3\GoogleAnalytics4\Application\Model\CMP\Usercentrics;

class ManagerTypes
{
    const EXTERNAL_SERVICE          = "eigener Service";
    const INTERNAL_EXTERNAL_SERVICE          = "externalService";
    const NET_COOKIE_MANAGER        = "Netensio Cookie Manager";
    const INTERNAL_NET_COOKIE_MANAGER        = "net_cookie_manager";

    /**
     * Further information's:
     * https://github.com/aggrosoft/oxid-cookie-compliance
     */
    const AGCOOKIECOMPLIANCE        = "Aggrosoft Cookie Compliance";
    const INTERNAL_AGCOOKIECOMPLIANCE        = "agcookiecompliance";

    const CONSENTMANAGER            = "Consentmanager";
    const INTERNAL_CONSENTMANAGER            = "cmconsentmanager";

    const COOKIEFIRST               = "Cookiefirst";
    const INTERNAL_COOKIEFIRST               = "cookiefirst";

    const COOKIEBOT                 = "Cookiebot";
    const INTERNAL_COOKIEBOT                 = "cookiebot";

    /**
     * @return array
     */
    public function getManagerList(): array
    {
        return [
            self::INTERNAL_EXTERNAL_SERVICE       => self::EXTERNAL_SERVICE,
            self::INTERNAL_AGCOOKIECOMPLIANCE    => self::AGCOOKIECOMPLIANCE,
            self::INTERNAL_NET_COOKIE_MANAGER    => self::NET_COOKIE_MANAGER,
            Usercentrics::sModuleIncludationInternalName    => Usercentrics::sModuleIncludationPublicName,
            Usercentrics::sExternalIncludationInternalName  => Usercentrics::sExternalIncludationPublicName,
            self::INTERNAL_CONSENTMANAGER      => self::CONSENTMANAGER,
            self::INTERNAL_COOKIEFIRST           => self::COOKIEFIRST,
            self::INTERNAL_COOKIEBOT             => self::COOKIEBOT,
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
			ManagerTypes::INTERNAL_CONSENTMANAGER,
			ManagerTypes::INTERNAL_COOKIEFIRST,
			ManagerTypes::INTERNAL_COOKIEBOT,
			ManagerTypes::INTERNAL_EXTERNAL_SERVICE
		];
	}
}