<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

namespace D3\GoogleAnalytics4\Modules\Core{
    class ViewConfig_parent extends \OxidEsales\Eshop\Core\ViewConfig{}
}

namespace D3\GoogleAnalytics4\Modules\Application\Model{

    use OxidEsales\Eshop\Application\Model\Payment;

    class Category_parent extends \OxidEsales\Eshop\Application\Model\Category {}
    class Basket_parent extends \OxidEsales\Eshop\Application\Model\Basket {}
    class Manufacturer_parent extends \OxidEsales\Eshop\Application\Model\Manufacturer {}

    class gtmPayment_parent extends Payment {}
}

namespace D3\GoogleAnalytics4\Modules\Application\Controller{

    use OxidEsales\Eshop\Application\Controller\AccountNoticeListController;
    use OxidEsales\Eshop\Application\Controller\AccountRecommlistController;
    use OxidEsales\Eshop\Application\Controller\AccountWishlistController;
    use OxidEsales\Eshop\Application\Controller\Admin\ManufacturerController;
    use OxidEsales\Eshop\Application\Controller\ArticleListController;
    use OxidEsales\Eshop\Application\Controller\SearchController;
    use OxidEsales\Eshop\Application\Controller\StartController;

    class BasketController_parent extends \OxidEsales\Eshop\Application\Controller\BasketController {}
    class ThankYouController_parent extends \OxidEsales\Eshop\Application\Controller\ThankYouController {}

    class ArticleListController_AddToCartHelpMethods_parent extends ArticleListController {}

    class ArticleDetailsController_parent extends \OxidEsales\Eshop\Application\Controller\ArticleDetailsController {}

    class d3GtmAccountNoticeListController_parent extends AccountNoticeListController {}

    class d3GtmAccountRecommlistController_parent extends AccountRecommlistController {}

    class d3GtmAccountWishlistController_parent extends AccountWishlistController {}

    class d3GtmStartController_parent extends StartController {}

    class d3GtmSearchController_parent extends SearchController {}

    class d3GtmManufacturerListController_parent extends ManufacturerController {}
}

namespace D3\GoogleAnalytics4\Modules\Application\Component{

    use OxidEsales\Eshop\Application\Component\BasketComponent;

    class d3GtmBasketComponentExtension_parent extends BasketComponent {}
}

namespace D3\GoogleAnalytics4\Modules\Application\Component\Widget{

    use OxidEsales\Eshop\Application\Component\Widget\ArticleDetails;

    class d3GtmWidgetArticleDetails_parent extends ArticleDetails {}
}