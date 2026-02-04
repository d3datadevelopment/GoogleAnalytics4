<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

namespace D3\GoogleAnalytics4\Modules\Core;

use D3\GoogleAnalytics4\Application\Model\CMP\Usercentrics;
use D3\GoogleAnalytics4\Application\Model\Constants;
use D3\GoogleAnalytics4\Application\Model\ManagerHandler;
use D3\GoogleAnalytics4\Application\Model\ManagerTypes;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleConfigurationDaoBridgeInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Exception\ModuleConfigurationNotFoundException;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Setting\Setting;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Setup\Bridge\ModuleActivationBridgeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ViewConfig extends ViewConfig_parent
{
    // Google Tag Manager Container ID
    private $sContainerId = null;

    // used CMP
    private $sCookieManagerType = null;

    // isModule Activated properly?
    private $blGA4enabled = null;

    public function getGtmContainerId()
    {
        if ($this->sContainerId === null) {
            $this->sContainerId = str_replace(' ', '', $this->d3GetModuleConfigParam("_sContainerID"));
        }
        return $this->sContainerId;
    }

    /**
     * @return void
     */
    public function defineCookieManagerType(): void
    {
        if ($this->sCookieManagerType === null) {
            /** @var ManagerHandler $oManagerHandler */
            $oManagerHandler = oxNew(ManagerHandler::class);
            $this->sCookieManagerType = $oManagerHandler->getActManager();
        }
    }

    /**
     * @return bool
     */
    public function shallUseOwnCookieManager(): bool
    {
        return (bool) $this->d3GetModuleConfigParam('_blEnableOwnCookieManager');
    }

    /**
     * @return string
     */
    public function getCharsToReplaceInCategorTitles(): string
    {
        return (string) $this->d3GetModuleConfigParam('_sReplaceChars');
    }

    /**
     * @return bool
     */
    public function D3blShowGtmScript()
    {
        /** @var Config $oConfig */
        $oConfig = Registry::getConfig();

        if (false === $this->isGA4enabled()) {
            return false;
        }

        // No Cookie Manager in use
        if (false === $this->shallUseOwnCookieManager()) {
            return true;
        }

        $this->defineCookieManagerType();

        $sCookieID = trim($this->d3GetModuleConfigParam('_sControlParameter'));

        // Netensio Cookie Manager
        if ($this->sCookieManagerType === ManagerTypes::INTERNAL_NET_COOKIE_MANAGER) {
            $oSession = Registry::getSession();
            $aCookies = $oSession->getVariable("aCookieSel");

            return (is_array($aCookies) && array_key_exists($sCookieID, $aCookies) && $aCookies[$sCookieID] == "1");
        }

        // Aggrosoft Cookie Consent
        if ($this->sCookieManagerType === ManagerTypes::INTERNAL_AGCOOKIECOMPLIANCE) {
            if (method_exists($this, "isCookieCategoryEnabled")) {
                return $this->isCookieCategoryEnabled($sCookieID);
            }
        }

        if (
            in_array(
                $this->sCookieManagerType,
                (oxNew(ManagerTypes::class)->scriptTagDeliveredByDefaultArray())
            )
        ) {
            // Always needs the script-tags delivered to the DOM.
            return true;
        }

        // Cookie Manager not (yet) supported
        return false;
    }

    /**
     * Get additional attributes for script tags.
     * This is especially important for UserCentrics.
     * @return string
     */
    public function getGtmScriptAttributes(): string
    {
        $sControlParameter = trim($this->d3GetModuleConfigParam('_sControlParameter'));

        if (false === $this->shallUseOwnCookieManager() or ($sControlParameter === '')) {
            return "";
        }

        if (
            $this->sCookieManagerType === Usercentrics::sModuleIncludationInternalName
            or $this->sCookieManagerType === Usercentrics::sExternalIncludationInternalName
        ) {
            return 'data-usercentrics="' . $sControlParameter . '" type="text/plain" async=""';
        }

        if ($this->sCookieManagerType === ManagerTypes::INTERNAL_CONSENTMANAGER) {
            return $this->getConsentmanagerScriptAttributes();
        }

        if ($this->sCookieManagerType === ManagerTypes::INTERNAL_COOKIEFIRST) {
            return 'type="text/plain" data-cookiefirst-category="' . $sControlParameter .'"';
        }

        if ($this->sCookieManagerType === ManagerTypes::INTERNAL_COOKIEBOT){
            return 'type="text/javascript" data-cookieconsent="' . $sControlParameter .'"';
        }

        return "";
    }
	
	/**
	 * @return bool
	 */
	public function isConsentmanagerChosen() :bool
	{
		/** @var ManagerHandler $oManagerHandler */
		$oManagerHandler = oxNew(ManagerHandler::class);
		return (bool) ($oManagerHandler->getActManager() === ManagerTypes::INTERNAL_CONSENTMANAGER);
	}
	
	/**
	 * @return string
	 *
	 * This method is needed, because consentmanager offers two distinguished options to be included.
	 *
	 * Automatic: Via GTM (Soft)) - "Advanced Implementation" approach with Google Consent Mode
	 *  Which then does NOT allow to add - 'type="text/plain" class="cmplazyload" data-cmp-vendor="'.$sControlParameter.'"'
	 *  But needs only j.setAttribute("data-cmp-ab","1"); and  data-cmp-ab="1" to the script-node
	 *
	 * Manual: Hard - Block GTM entirely until consent
	 *  Which then allows/ needs - 'type="text/plain" class="cmplazyload" data-cmp-vendor="'.$sControlParameter.'"
	 *  As script-attribute in the script-node
	 */
	protected function getConsentmanagerScriptAttributes() :string
	{
		// Is Consentmanager automatic blocking active?
			// AUTO BLOCKING:
		if ($this->isConsentmanagerAutomaticBlocking()){
			return 'data-cmp-ab="1"';
		}else{
			// MANUAL BLOCKING:
			$sControlParameter = trim($this->d3GetModuleConfigParam('_sControlParameter'));
			return 'type="text/plain" class="cmplazyload" data-cmp-vendor="'.$sControlParameter.'"';
		}
	}
	
	/**
	 * @return bool
	 */
	public function isConsentmanagerAutomaticBlocking() :bool
	{
		return (bool)($this->getChosenConsentmanagerMode() === 'auto');
	}
	
	/**
	 * @return string
	 */
	public function getChosenConsentmanagerMode() :string
	{
		return $this->d3GetModuleConfigParam('_CONSENTMANAGER_MODE');
	}
	
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function isGA4enabled()
    {
        if ($this->blGA4enabled === null) {
            $this->blGA4enabled = $this->d3GetModuleConfigParam("_blEnableGa4");
        }

        return $this->blGA4enabled;
    }

    public function isGtmConsentModeSetActivated(): bool
    {
        return $this->d3GetModuleConfigParam("_blEnableConsentMode") ?: false;
    }

    public function getGtmDataLayer()
    {
        if (!$this->getGtmContainerId()) {
            return "[]";
        }

        $oConfig = Registry::getConfig();
        $oView   = $oConfig->getTopActiveView();
        /** @var User|false|null $oUser */
        $oUser = $oConfig->getUser();

        $cl         = $this->getTopActiveClassName();
        $aPageTypes = [
            "content"  => "cms",
            "details"  => "product",
            "alist"    => "listing",
            "search"   => "listing",
            "basket"   => "checkout",
            "user"     => "checkout",
            "payment"  => "checkout",
            "order"    => "checkout",
            "thankyou" => "checkout",
            "start"    => "start",
        ];

        $dataLayer = [
            'page'      => [
                'type'  => $aPageTypes[$cl] ?? "unknown",
                'title' => $oView->getTitle(),
                'cl'    => $cl,
            ],
            'userid'    => $oUser instanceof User ? $oUser->getId() : false,
            'sessionid' => session_id(),
            //'httpref'   => $_SERVER["HTTP_REFERER"] ?? "unknown"
        ];
		
		$dataLayer = $this->d3AdditionalGlobalAnalyticsVariables($dataLayer);

        return json_encode([$dataLayer], JSON_PRETTY_PRINT);
    }
	
	/**
	 * @param array $dataLayerGlobals
	 * @return array
	 */
	public function d3AdditionalGlobalAnalyticsVariables(array $dataLayerGlobals) :array
	{
		/** @var User $oUser */
		$oUser  = Registry::getSession()->getUser();
		if ($oUser and $oUser->getFieldData('OXUSERNAME')){
			$sUsername 	= $oUser->getFieldData('OXUSERNAME') ?: "";
			$iCustNr 			= $oUser->getFieldData('OXCUSTNR') ?: "";
			$iZipCode 		= $oUser->getFieldData('OXZIP') ?: "";
			
			return array_merge($dataLayerGlobals, [
				'custnr'		=> $iCustNr,
				'email' 		=> $sUsername,
				'zipcode' 	=> $iZipCode
			]);
		}
		return $dataLayerGlobals;
	}

    /**
     * @return bool
     */
    public function isDebugModeOn() :bool
    {
        return $this->d3GetModuleConfigParam("_blEnableDebug")?: false;
    }

    /**
     * @return bool
     */
    public function useRealCategoryTitles(): bool
    {
        return $this->d3GetModuleConfigParam("_blUseRealCategoyTitles") ?: false;
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getServerSidetaggingJsDomain(): string
    {
        return $this->d3GetModuleConfigParam("_sServersidetagging_js") ?: "";
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getServerSidetaggingNoJsDomain(): string
    {
        return $this->d3GetModuleConfigParam('_sServersidetagging_nojs') ?: "";
    }
	
	/**
	 * @param string $configParamName
	 * @param bool $displayThrowable
	 * @return bool|object|string
	 */
    public function d3GetModuleConfigParam(string $configParamName, bool $displayThrowable = false)
    {
		try {
			return $this->d3GetGa4ModuleConfigurationBridge()->getModuleSetting(Constants::OXID_MODULE_ID.$configParamName)->getValue();
		} catch (\Throwable $throwable) {
			if ($displayThrowable){
				Registry::getUtilsView()->addErrorToDisplay($throwable);
			}
			Registry::getLogger()->error($throwable->getMessage());
		}
    }
	
	/**
	 * @return \OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function d3GetGa4ModuleConfigurationBridge() :\OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration
	{
		/** @var \OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\DataObject\ModuleConfiguration $oModuleSettingsBridge */
		return ContainerFactory::getInstance()
			->getContainer()
			->get(ModuleConfigurationDaoBridgeInterface::class)->get(Constants::OXID_MODULE_ID);
	}
	
	/**
	 * @return array
	 */
	public function d3GetModuleSettingNameArray() :array
	{
		$tmp  = [];
		
		foreach ($this->d3GetGa4ModuleConfigurationBridge()->getModuleSettings() as $arrayEntry){
			$tmp[] = $arrayEntry->getName();
		}
		
		return $tmp;
	}
	
    /**
     * @return bool
     */
    public function d3IsUsercentricsCMPChosen(): bool
    {
        $sCMPPubName    = $this->d3GetModuleConfigParam('_HAS_STD_MANAGER');
        $aPossibleCMP   = (oxNew(ManagerTypes::class))->getManagerList();

        return (bool) ($sCMPPubName === Usercentrics::sExternalIncludationInternalName
            or $sCMPPubName === Usercentrics::sModuleIncludationInternalName);
    }

    /**
     * @return bool
     */
    public function d3IsModuleActive(string $sModuleId): bool
    {
        /** @var ModuleActivationBridgeInterface $moduleActivationBridge */
        $moduleActivationBridge = $this
            ->getContainer()
            ->get(ModuleActivationBridgeInterface::class);

        try {
            $isActiveBool = $moduleActivationBridge->isActive(
                $sModuleId,
                Registry::getConfig()->getShopId()
            );
        } catch (\Exception|ModuleConfigurationNotFoundException $e) {
            return false;
        }

        return (bool) $isActiveBool;
    }
	
	/**
	 * @return string
	 */
	public function getChosenCookieManagertype() :string
	{
		return $this->sCookieManagerType;
	}
}
