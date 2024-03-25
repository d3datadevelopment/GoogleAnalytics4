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

use D3\GoogleAnalytics4\Application\Model\Constants;
use D3\GoogleAnalytics4\Application\Model\ManagerHandler;
use D3\GoogleAnalytics4\Application\Model\ManagerTypes;
use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Application\Model\User;use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ViewConfig extends ViewConfig_parent
{

    // Google Tag Manager Container ID
    private $sContainerId = null;
    private $sCookieManagerType = null;

    public function getGtmContainerId()
    {
        if ($this->sContainerId === null)
        {
            $this->sContainerId = ContainerFactory::getInstance()
                                                  ->getContainer()
                                                  ->get(ModuleSettingBridgeInterface::class)
                                                  ->get('d3_gtm_sContainerID', Constants::OXID_MODULE_ID);
        }
        return $this->sContainerId;
    }

    /**
     * @return void
     */
    public function defineCookieManagerType() :void
    {
        if ($this->sCookieManagerType === null)
        {
            /** @var ManagerHandler $oManagerHandler */
            $oManagerHandler = oxNew(ManagerHandler::class);
            $this->sCookieManagerType = $oManagerHandler->getCurrManager();
        }
    }

    /**
     * @return bool
     */
    public function shallUseOwnCookieManager() :bool
    {
        return (bool) Registry::getConfig()->getConfigParam('d3_gtm_settings_hasOwnCookieManager');
    }

    /**
     * @return bool
     */
    public function D3blShowGtmScript()
    {
        /** @var Config $oConfig */
        $oConfig = Registry::getConfig();

        // No Cookie Manager in use
        if (!$this->shallUseOwnCookieManager()) {
            return true;
        }

        $this->defineCookieManagerType();

        $sCookieID = trim($oConfig->getConfigParam('d3_gtm_settings_controlParameter'));

        // Netensio Cookie Manager
        if ($this->sCookieManagerType === ManagerTypes::NET_COOKIE_MANAGER) {
            $oSession = Registry::getSession();
            $aCookies = $oSession->getVariable("aCookieSel");

            return (is_array($aCookies) && array_key_exists($sCookieID, $aCookies) && $aCookies[$sCookieID] == "1");
        }

        // Aggrosoft Cookie Consent
        if ($this->sCookieManagerType === ManagerTypes::AGCOOKIECOMPLIANCE) {
            if (method_exists($this, "isCookieCategoryEnabled")) {
                return $this->isCookieCategoryEnabled($sCookieID);
            }
        }

        // UserCentrics or consentmanager
        if (
            $this->sCookieManagerType       === ManagerTypes::USERCENTRICS_MODULE
            or $this->sCookieManagerType    === ManagerTypes::USERCENTRICS_MANUALLY
            or $this->sCookieManagerType    === ManagerTypes::CONSENTMANAGER
            or $this->sCookieManagerType    === ManagerTypes::COOKIEFIRST
            or $this->sCookieManagerType    === ManagerTypes::COOKIEBOT
            or $this->sCookieManagerType    === ManagerTypes::EXTERNAL_SERVICE
        )
        {
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
    public function getGtmScriptAttributes() :string
    {
        $sControlParameter = trim(Registry::getConfig()->getConfigParam('d3_gtm_settings_controlParameter'));

        if (false === $this->shallUseOwnCookieManager() or ($sControlParameter === '')){
            return "";
        }

        if (
            $this->sCookieManagerType === ManagerTypes::USERCENTRICS_MODULE
            or $this->sCookieManagerType === ManagerTypes::USERCENTRICS_MANUALLY
        )
        {
            return 'data-usercentrics="' . $sControlParameter . '" type="text/plain" async=""';
        }

        if ($this->sCookieManagerType === ManagerTypes::CONSENTMANAGER)
        {
            return 'type="text/plain" class="cmplazyload" data-cmp-vendor="'.$sControlParameter.'"';
        }

        if ($this->sCookieManagerType === ManagerTypes::COOKIEFIRST){
            return 'type="text/plain" data-cookiefirst-category="' . $sControlParameter .'"';
        }

        if ($this->sCookieManagerType === ManagerTypes::COOKIEBOT){
            return 'type="text/plain" data-cookieconsent="' . $sControlParameter .'"';
        }

        return "";
    }

    private $blGA4enabled = null;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function isGA4enabled()
    {
        if ($this->blGA4enabled === null)
        {
            $this->sContainerId = ContainerFactory::getInstance()
                                                  ->getContainer()
                                                  ->get(ModuleSettingBridgeInterface::class)
                                                  ->get('d3_gtm_blEnableGA4', Constants::OXID_MODULE_ID);
        }

        return $this->blGA4enabled;
    }

    public function getGtmDataLayer()
    {
        if (!$this->getGtmContainerId()) return "[]";

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

        return json_encode([$dataLayer], JSON_PRETTY_PRINT);
    }

    public function isDebugModeOn() :bool
    {
        return Registry::getConfig()->getConfigParam('d3_gtm_blEnableDebug');
    }

    public function isPromotionList($listId)
    {
        $oConfig           = Registry::getConfig();
        $aPromotionListIds = $oConfig->getConfigParam("") ?? ['bargainItems', 'newItems', 'topBox', 'alsoBought', 'accessories', 'cross'];
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getServerSidetaggingJsDomain() :string
    {
        return ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class)
            ->get('d3_gtm_settings_serversidetagging_js', Constants::OXID_MODULE_ID);
    }

    /**
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getServerSidetaggingNoJsDomain() :string
    {
        return ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class)
            ->get('d3_gtm_settings_serversidetagging_nojs', Constants::OXID_MODULE_ID);
    }
}