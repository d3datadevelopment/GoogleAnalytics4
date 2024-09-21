<?php

namespace D3\GoogleAnalytics4\Modules\Application\Controller;

class d3GtmAccountNoticeListController extends d3GtmAccountNoticeListController_parent
{
    protected $_sThisTemplate = '@' . Constants::OXID_MODULE_ID . '/page/account/d3gtmnoticelist.tpl';

    public function render()
    {
        $return = parent::render();

        $this->addTplParam('d3CmpBasket', $this->getComponent('oxcmp_basket'));

        return $return;
    }
}