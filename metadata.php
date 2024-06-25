<?php

use D3\GoogleAnalytics4\Application\Controller\Admin\GA4AdminUserInterface_main as GA4AdminUserInterfaceMainController;
use D3\GoogleAnalytics4\Application\Model\Constants as Constants;
use D3\GoogleAnalytics4\Modules\Application\Component\d3GtmBasketComponentExtension;
use D3\GoogleAnalytics4\Modules\Application\Component\Widget\d3GtmWidgetArticleDetails as d3GtmWidgetArticleDetails;
use D3\GoogleAnalytics4\Modules\Application\Controller\ArticleDetailsController;
use D3\GoogleAnalytics4\Modules\Application\Controller\ArticleListController_AddToCartHelpMethods;
use D3\GoogleAnalytics4\Modules\Application\Controller\BasketController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmAccountNoticeListController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmAccountRecommlistController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmAccountWishlistController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmManufacturerListController as d3GtmManufacturerListController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmSearchController;
use D3\GoogleAnalytics4\Modules\Application\Controller\d3GtmStartController;
use D3\GoogleAnalytics4\Modules\Application\Controller\ThankYouController;
use D3\GoogleAnalytics4\Modules\Application\Model\Basket as Basket;
use D3\GoogleAnalytics4\Modules\Application\Model\Category as Category;
use D3\GoogleAnalytics4\Modules\Application\Model\Manufacturer as Manufacturer;
use D3\GoogleAnalytics4\Modules\Core\ViewConfig;
use OxidEsales\Eshop\Application\Component\BasketComponent as OEBasketComponent;
use OxidEsales\Eshop\Application\Component\Widget\ArticleDetails as OEArticleDetails;
use OxidEsales\Eshop\Application\Controller\AccountNoticeListController as OEAccountNoticeListController;
use OxidEsales\Eshop\Application\Controller\AccountRecommlistController as OEAccountRecommlistController;
use OxidEsales\Eshop\Application\Controller\AccountWishlistController as OEAccountWishlistController;
use OxidEsales\Eshop\Application\Controller\ArticleDetailsController as OEArticleDetailsController;
use OxidEsales\Eshop\Application\Controller\ArticleListController as OEArticleListController;
use OxidEsales\Eshop\Application\Controller\BasketController as OEBasketController;
use OxidEsales\Eshop\Application\Controller\ManufacturerListController as OEManufacturerListController;
use OxidEsales\Eshop\Application\Controller\SearchController as OESearchController;
use OxidEsales\Eshop\Application\Controller\StartController as OEStartController;
use OxidEsales\Eshop\Application\Controller\ThankYouController as OEThankYouController;
use OxidEsales\Eshop\Application\Model\Basket as OEBasket;
use OxidEsales\Eshop\Application\Model\Category as OECategory;
use OxidEsales\Eshop\Application\Model\Manufacturer as OEManufacturer;
use OxidEsales\Eshop\Core\ViewConfig as OEViewConfig;

$sMetadataVersion = '2.1';
$aModule          = [
    'id'          => Constants::OXID_MODULE_ID,
    'title'       => 'Google Analytics 4',
    'description' => "Dieses Modul bietet die Möglichkeit in Ihrem OXID eShop (6.x) die neue 'Property' 
                      Google Analytics 4 (GA4) von Google zu integrieren.<br>
                      Hierfür stehen Ihnen verschiedene 'templates' zur verfügung, 
                      mit denen Sie bestimmte Events tracken können.<br>
                      Beispiele dafür sind: view_item, add_to_basket, purchase, ...<br><br>
                      Die Integration und Verbindung zu Google wird mithilfe des gtag (Google Tag Manager) realisiert.<br><br>
                      Weiterführende Informationen: https://developers.google.com/analytics/devguides/collection/ga4<br>
                      <hr>
                      Die Entwicklung basiert auf einem Fork von Marat Bedoev - <a href='https://github.com/vanilla-thunder/oxid-module-gtm'>Github-Link</a>
                      ",
    'thumbnail'   => 'thumbnail.png',
    'version'     => '2.18.2',
    'author'      => 'Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'https://www.oxidmodule.com/',
    'controllers' => [
        'd3googleanalytics4_main' => GA4AdminUserInterfaceMainController::class
    ],
    'extend'      => [
        // Core
        OEViewConfig::class                     => ViewConfig::class,

        // Model
        OECategory::class                       => Category::class,
        OEBasket::class                         => Basket::class,
        OEManufacturer::class                   => Manufacturer::class,

        // Controller
        OEBasketController::class               => BasketController::class,
        OEThankYouController::class             => ThankYouController::class,
        OEArticleListController::class          => ArticleListController_AddToCartHelpMethods::class,
        OEArticleDetailsController::class       => ArticleDetailsController::class,
        OEAccountNoticeListController::class    => d3GtmAccountNoticeListController::class,
        OEAccountRecommlistController::class    => d3GtmAccountRecommlistController::class,
        OEAccountWishlistController::class      => d3GtmAccountWishlistController::class,
        OEStartController::class                => d3GtmStartController::class,
        OESearchController::class               => d3GtmSearchController::class,
        OEManufacturerListController::class     => d3GtmManufacturerListController::class,

        // Component
        OEArticleDetails::class                 => d3GtmWidgetArticleDetails::class,
        OEBasketComponent::class                => d3GtmBasketComponentExtension::class,
    ],
    'templates'   => [
        // Event files that store the GA4 Event-Information
        'event/add_to_cart.tpl'                     => 'd3/googleanalytics4/Application/views/event/add_to_cart.tpl',
        'event/view_item.tpl'                       => 'd3/googleanalytics4/Application/views/event/view_item.tpl',
        'event/view_cart.tpl'                       => 'd3/googleanalytics4/Application/views/event/view_cart.tpl',
        'event/purchase.tpl'                        => 'd3/googleanalytics4/Application/views/event/purchase.tpl',
        'event/view_item_list.tpl'                  => 'd3/googleanalytics4/Application/views/event/view_item_list.tpl',
        'event/view_search_result.tpl'              => 'd3/googleanalytics4/Application/views/event/view_search_result.tpl',
        'event/remove_from_cart.tpl'                => 'd3/googleanalytics4/Application/views/event/remove_from_cart.tpl',

        // complete overwritten file of OXID-Originals
        // the path of the template-name is the original path to the file in OXID-context from tpl/->
        'page/account/d3gtmnoticelist.tpl'          => 'd3/googleanalytics4/Application/views/tpl/page/account/d3gtmnoticelist.tpl',
        'page/account/d3gtmrecommendationlist.tpl'  => 'd3/googleanalytics4/Application/views/tpl/page/account/d3gtmrecommendationlist.tpl',
        'page/account/d3gtmwishlist.tpl'            => 'd3/googleanalytics4/Application/views/tpl/page/account/d3gtmwishlist.tpl',

        // Admin Templates
        'ga4/admin/d3ga4uimain.tpl'                 => 'd3/googleanalytics4/Application/views/admin/tpl/d3googleanalytics4_main.tpl',
        'ga4/admin/d3ga4uiheaditem.tpl'             => 'd3/googleanalytics4/Application/views/admin/tpl/d3googleanalytics4_headitem.tpl',
    ],
    'blocks'      => [
        // tag manager js
        [
            'template' => 'layout/base.tpl',
            'block'    => 'head_meta_robots',
            'file'     => '/Application/views/blocks/_gtm_js.tpl',
            'position' => 150
        ],
        // tag manager nojs
        [
            'template' => 'layout/base.tpl',
            'block'    => 'theme_svg_icons',
            'file'     => '/Application/views/blocks/_gtm_nojs.tpl'
        ],
        // details
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block'    => 'details_productmain_title',
            'file'     => '/Application/views/blocks/view_item.tpl',
            'position' => 150
        ],
        // checkout
        [
            'template' => 'page/checkout/basket.tpl',
            'block'    => 'checkout_basket_main',
            'file'     => '/Application/views/blocks/view_cart.tpl'
        ],
        [
            'template' => 'page/checkout/thankyou.tpl',
            'block'    => 'checkout_thankyou_main',
            'file'     => '/Application/views/blocks/purchase.tpl'
        ],
        // Lists
        // view_item_list
        [
            'template' => 'page/list/list.tpl',
            'block'    => 'page_list_productlist',
            'file'     => '/Application/views/blocks/view_item_list.tpl',
            'position' => 150
        ],
        // view_search_result
        [
            'template' => 'page/search/search.tpl',
            'block'    => 'search_results',
            'file'     => '/Application/views/blocks/view_search_result.tpl',
            'position' => 150
        ],
        // add_to_cart
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block'    => 'details_productmain_tobasket',
            'file'     => '/Application/views/blocks/details_productmain_tobasket.tpl',
            'position' => 150
        ],
        [
            'template' => 'page/list/list.tpl',
            'block'    => 'page_list_listbody',
            'file'     => '/Application/views/blocks/page_list_listbody.tpl',
            'position' => 150
        ],
        [
            'template' => 'page/shop/start.tpl',
            'block'    => 'start_welcome_text',
            'file'     => '/Application/views/blocks/start_welcome_text.tpl',
            'position' => 150
        ],
        // remove_from_cart
        [
            'template' => 'page/checkout/basket.tpl',
            'block'    => 'checkout_basket_main',
            'file'     => '/Application/views/blocks/remove_from_cart.tpl',
            'position' => 150
        ]
    ],
    'events'      => [
        'onActivate'    => '\D3\GoogleAnalytics4\Setup\Events::onActivate',
        'onDeactivate'  => '\D3\GoogleAnalytics4\Setup\Events::onDeactivate',
    ],
];