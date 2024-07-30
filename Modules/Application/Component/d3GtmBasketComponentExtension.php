<?php

namespace D3\GoogleAnalytics4\Modules\Application\Component;

use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Core\Registry;

class d3GtmBasketComponentExtension extends d3GtmBasketComponentExtension_parent
{
    /**
     * @param $sProductId
     * @param $dAmount
     * @param $aSel
     * @param $aPersParam
     * @param $blOverride
     * @return mixed|string
     * @throws \Exception
     */
    public function toBasket($sProductId = null, $dAmount = null, $aSel = null, $aPersParam = null, $blOverride = false)
    {
        $return = parent::toBasket($sProductId, $dAmount, $aSel, $aPersParam, $blOverride);

        Registry::getSession()->setVariable('d3GtmAddToBasketTrigger', true);

        $iAmountArticlesAddedToCart = (int) Registry::getRequest()->getRequestEscapedParameter('am');

        if ($iAmountArticlesAddedToCart){
            Registry::getSession()->setVariable('d3GtmAddToCartAmountArticles', $iAmountArticlesAddedToCart);
        }else{
            Registry::getSession()->setVariable('d3GtmAddToCartAmountArticles', 1);
        }

        return $return;
    }

    /**
     * @return int
     */
    public function getD3GtmAddToCartAmountArticles() :int
    {
        $iAmount = Registry::getSession()->getVariable('d3GtmAddToCartAmountArticles');

        Registry::getSession()->deleteVariable('d3GtmAddToCartAmountArticles');

        return (int) $iAmount;
    }

    /**
     * @return bool
     */
    public function getAddToBasketDecision() :bool
    {
        $decision = Registry::getSession()->getVariable('d3GtmAddToBasketTrigger');

        Registry::getSession()->setVariable('d3GtmAddToBasketTrigger', false);

        return (bool) $decision;
    }

    public function getRemoveFromBasketDecision() :bool
    {
        $decision = Registry::getSession()->getVariable('d3GtmRemoveFromBasketTrigger');

        Registry::getSession()->setVariable('d3GtmRemoveFromBasketTrigger', false);

        return (bool) $decision;
    }

    protected function _getItems($sProductId = null, $dAmount = null, $aSel = null, $aPersParam = null, $blOverride = false)
    {
        $aProducts = parent::_getItems($sProductId, $dAmount, $aSel, $aPersParam, $blOverride);

        if (is_array($aProducts) && count($aProducts)) {
            Registry::getSession()->setVariable('d3GtmRemoveFromBasketTrigger', true);
        }

        return $return;
    }

    /**
     * @return Article|null
     */
    public function d3GtmRequestedArticleLoadedByAnid()
    {
        $sAnid = Registry::getRequest()->getRequestEscapedParameter('anid');

        $oArticle = null;

        if ($sAnid){
            /** @var Article $oArticle */
            $oArticle = oxNew(Article::class);
            $oArticle->load($sAnid);
        }

        return $oArticle;
    }
}