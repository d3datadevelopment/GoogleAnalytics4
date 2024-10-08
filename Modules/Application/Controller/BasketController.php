<?php

namespace D3\GoogleAnalytics4\Modules\Application\Controller;

use OxidEsales\Eshop\Application\Component\BasketComponent;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\ArticleList;
use OxidEsales\Eshop\Core\Registry;
use oxSystemComponentException;

class BasketController extends BasketController_parent
{
    /**
     * @return string
     */
    public function render()
    {
        $return = parent::render();

        $this->d3GA4getRemovedArticlesListObject();

        return $return;
    }

    /**
     * @return void
     * @throws oxSystemComponentException
     */
    public function d3GA4getRemovedArticlesListObject() :void
    {
        $this->addTplParam('hasBeenReloaded', false);
        // collecting items to add
        $aProducts = Registry::getRequest()->getRequestEscapedParameter('aproducts');

        // collecting specified item
        $sProductId = Registry::getRequest()->getRequestEscapedParameter('aid');
        if ($sProductId) {
            // additionally fetching current product info
            $dAmount = Registry::getRequest()->getRequestEscapedParameter('am');

            // select lists
            $aSel = Registry::getRequest()->getRequestEscapedParameter('sel');

            /** @var BasketComponent $oBasketComponent */
            $oBasketComponent = $this->getComponent('oxcmp_basket');

            $aPersParam = $oBasketComponent->__call('getPersistedParameters', []);

            $sBasketItemId = Registry::getRequest()->getRequestEscapedParameter('bindex');

            $aProducts[$sProductId] = [
                'am'           => $dAmount,
                'sel'          => $aSel,
                'persparam'    => $aPersParam,
                'basketitemid' => $sBasketItemId
            ];
        }

        if (is_array($aProducts) && count($aProducts)) {
            $toRemoveArticleIdList = [];
            $artIdOnArtAmountList = [];

            if ($this->isArticleRemovedState($aProducts)) {
                //setting amount to 0 if removing article from basket
                foreach ($aProducts as $sProductId => $aProduct) {
                    if ((isset($aProduct['remove']) && $aProduct['remove']) or intval($aProduct['am']) === 0) {
                        if (!in_array($aProduct, $toRemoveArticleIdList)) {
                            $toRemoveArticleIdList[] = $aProduct['aid'];
                            $artIdOnArtAmountList[$aProduct['aid']] = $aProduct['am'];
                        }

                        $aProducts[$sProductId]['am'] = 0;
                        #for GA4 Event
                        $this->addTplParam('hasBeenReloaded', true);
                    } else {
                        unset($aProducts[$sProductId]);
                    }
                }
            }

            $oArtList = oxNew(ArticleList::class);
            $oArtList->loadIds($toRemoveArticleIdList);

            #dumpVar($this->getBasketArticles());

            /** @var Article $item */
            foreach ($oArtList->getArray() as $item){
                foreach ($artIdOnArtAmountList as $artId => $artAmount){
                    if ($item->getId() === $artId){
                        $item->assign(['d3AmountThatGotRemoved' => $artAmount]);
                    }
                }
            }

            $this->addTplParam('toRemoveArticles', $oArtList);
        }
    }

    /**
     * @return bool
     *
     * checks, if we're in the short state of "an Article has been removed"
     * We check by looking for the "'removeBtn' is not null", as a sign for it has been triggered/ clicked
     * if that doesn't work, we check if there's an Article in the Products array, that has "'am' = 0"
     * Which also shows we're in that state rn
     */
    protected function isArticleRemovedState(array $productsArray) :bool
    {
        if (Registry::getRequest()->getRequestEscapedParameter('removeBtn')
            or Registry::getRequest()->getRequestEscapedParameter('updateBtn')
        ){
            return true;
        }else{
            foreach ($productsArray as $aProduct) {
                if (intval($aProduct['am']) === 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
