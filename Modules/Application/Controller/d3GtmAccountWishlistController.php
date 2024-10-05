<?php

namespace D3\GoogleAnalytics4\Modules\Application\Controller;

class d3GtmAccountWishlistController extends d3GtmAccountWishlistController_parent
{
    protected $_sThisTemplate = '@' . Constants::OXID_MODULE_ID . '/page/account/d3gtmwishlist.tpl';

    public function render()
    {
        $return = parent::render();

        $this->addTplParam('d3CmpBasket', $this->getComponent('oxcmp_basket'));

        return $return;
    }
}