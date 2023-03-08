<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\GoogleAnalytics4\Modules\Core;

use OxidEsales\Eshop\Application\Controller\FrontendController;
use OxidEsales\Eshop\Core\Registry;

class ViewConfig extends ViewConfig_parent
{

    // Google Tag Manager Container ID
    private $sContainerId = null;

    public function getGtmContainerId()
    {
        if ($this->sContainerId === null)
        {

            $this->sContainerId = $this->getConfig()->getConfigParam('d3_gtm_sContainerID');
        }
        return $this->sContainerId;
    }

    /**
     * @param $sCookieID
     * @return bool
     */
    public function D3blAcceptedCookie($sCookieID)
    {
        $oSession = Registry::getSession();
        $aCookies = $oSession->getVariable("aCookieSel");

        if (!is_null($aCookies) && is_array($aCookies) && array_key_exists($sCookieID, $aCookies) && $aCookies[$sCookieID] == "1") {
            return true;
        }

        // Aggrosoft Cookie Consent
        if (method_exists($this, "isCookieCategoryEnabled")) {
            return $this->isCookieCategoryEnabled("ANALYTICS");
        }

        return false;
    }

    private $blGA4enabled = null;

    public function isGA4enabled()
    {
        if ($this->blGA4enabled === null)
        {
            $this->sContainerId = $this->getConfig()->getConfigParam('d3_gtm_blEnableGA4');
        }

        return $this->blGA4enabled;
    }

    public function getGtmDataLayer()
    {
        if (!$this->getGtmContainerId()) return "[]";

        $oConfig = Registry::getConfig();
        $oView   = $oConfig->getTopActiveView();
        /** @var FrontendController $oShop */

        $oUser = $oConfig->getUser();

        $cl         = $this->getTopActionClassName();
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
        ];

        $dataLayer = [
            'page'      => [
                'type'  => $aPageTypes[$cl] ?? "unknown",
                'title' => $oView->getTitle(),
                'cl'    => $cl,
            ],
            'userid'    => ($oUser ? $oUser->getId() : false),
            'sessionid' => session_id() ?? false,
            //'httpref'   => $_SERVER["HTTP_REFERER"] ?? "unknown"
        ];

        return json_encode([$dataLayer], JSON_PRETTY_PRINT);
    }

    public function isPromotionList($listId)
    {
        $oConfig           = Registry::getConfig();
        $aPromotionListIds = $oConfig->getConfigParam("") ?? ['bargainItems', 'newItems', 'topBox', 'alsoBought', 'accessories', 'cross'];
    }
}