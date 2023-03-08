<?php
use D3\GoogleAnalytics4\Modules\Core\ViewConfig;
use OxidEsales\Eshop\Core\ViewConfig as OEViewConfig;

$sMetadataVersion = '2.1';
$aModule          = [
    'id'          => 'd3googleanalytics4',
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
    'version'     => '1.2.1',
    'author'      => 'Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'https://www.oxidmodule.com/',
    'extend'      => [
        OEViewConfig::class => ViewConfig::class
    ],
    'templates'   => [
        // GA4 events
        'ga4_add_payment_info.tpl' => 'd3/googleanalytics4/Application/views/ga4/add_payment_info.tpl',
        'add_shipping_info.tpl'    => 'd3/googleanalytics4/Application/views/ga4/add_shipping_info.tpl',
        'ga4_add_to_cart.tpl'      => 'd3/googleanalytics4/Application/views/ga4/add_to_cart.tpl',
        'ga4_begin_checkout.tpl'   => 'd3/googleanalytics4/Application/views/ga4/begin_checkout.tpl',
        'ga4_generate_lead.tpl'    => 'd3/googleanalytics4/Application/views/ga4/generate_lead.tpl',
        'ga4_login.tpl'            => 'd3/googleanalytics4/Application/views/ga4/login.tpl',
        'ga4_purchase.tpl'         => 'd3/googleanalytics4/Application/views/ga4/purchase.tpl',
        'ga4_remove_from_cart.tpl' => 'd3/googleanalytics4/Application/views/ga4/remove_from_cart.tpl',
        'ga4_search.tpl'           => 'd3/googleanalytics4/Application/views/ga4/search.tpl',
        'ga4_select_content.tpl'   => 'd3/googleanalytics4/Application/views/ga4/select_content.tpl',
        'ga4_select_item.tpl'      => 'd3/googleanalytics4/Application/views/ga4/select_item.tpl',
        'ga4_select_promotion.tpl' => 'd3/googleanalytics4/Application/views/ga4/select_promotion.tpl',
        'ga4_sign_up.tpl'          => 'd3/googleanalytics4/Application/views/ga4/sign_up.tpl',
        'ga4_view_cart.tpl'        => 'd3/googleanalytics4/Application/views/ga4/view_cart.tpl',
        'ga4_view_item.tpl'        => 'd3/googleanalytics4/Application/views/ga4/view_item.tpl',
        'ga4_view_item_list.tpl'   => 'd3/googleanalytics4/Application/views/ga4/view_item_list.tpl',
        'ga4_view_promotion.tpl'   => 'd3/googleanalytics4/Application/views/ga4/view_promotion.tpl',
    ],
    'blocks'      => [
        // tag manager js
        [
            'template' => 'layout/base.tpl',
            'block'    => 'head_meta_robots',
            'file'     => '/Application/views/blocks/_gtm_js.tpl'
        ],
        // tag manager nojs
        [
            'template' => 'layout/base.tpl',
            'block'    => 'theme_svg_icons',
            'file'     => '/Application/views/blocks/_gtm_nojs.tpl'
        ],
        // widget_product_list
        [
            'template' => 'widget/product/list.tpl',
            'block'    => 'widget_product_list',
            'file'     => '/Application/views/blocks/widget_product_list.tpl'
        ],
        // details
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block'    => 'details_productmain_title',
            'file'     => '/Application/views/blocks/detail.tpl',
            'position' => 150
        ],
        // checkout
        [
            'template' => 'page/checkout/basket.tpl',
            'block'    => 'checkout_basket_main',
            'file'     => '/Application/views/blocks/checkout_s1.tpl'
        ],
        [
            'template' => 'form/user_checkout_change.tpl',
            'block'    => 'user_checkout_change',
            'file'     => '/Application/views/blocks/checkout_s2.tpl'
        ],
        [
            'template' => 'form/user_checkout_register.tpl',
            'block'    => 'user_checkout_register',
            'file'     => '/Application/views/blocks/checkout_s2.tpl'
        ],
        [
            'template' => 'form/user_checkout_noregister.tpl',
            'block'    => 'user_checkout_noregister',
            'file'     => '/Application/views/blocks/checkout_s2.tpl'
        ],
        [
            'template' => 'page/checkout/payment.tpl',
            'block'    => 'checkout_payment_main',
            'file'     => '/Application/views/blocks/checkout_s3.tpl'
        ],
        [
            'template' => 'page/checkout/order.tpl',
            'block'    => 'checkout_order_main',
            'file'     => '/Application/views/blocks/checkout_s4.tpl'
        ],
        [
            'template' => 'page/checkout/thankyou.tpl',
            'block'    => 'checkout_thankyou_main',
            'file'     => '/Application/views/blocks/checkout_s5.tpl'
        ],
        // Lists
        // view_item_list
        [
            'template' => 'widget/product/list.tpl',
            'block'    => 'd3Ga4_view_item_list',
            'file'     => '/Application/views/ga4/view_item_list.tpl',
            'position' => 150
        ],
        // view_search_result
        [
            'template' => 'page/search/search.tpl',
            'block'    => 'search_results',
            'file'     => '/Application/views/ga4/search.tpl',
            'position' => 150
        ],
        // add_to_cart
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block'    => 'details_productmain_tobasket',
            'file'     => '/Application/views/ga4/add_to_cart.tpl',
            'position' => 150
        ]
    ],
    'settings'    => [
        [
            'group'    => 'd3_gtm_settings',
            'name'     => 'd3_gtm_sContainerID',
            'type'     => 'str',
            'value'    => 'GTM-',
            'position' => 0
        ],
        [
            'group'    => 'd3_gtm_settings',
            'name'     => 'd3_gtm_blGA4enab',
            'type'     => 'bool',
            'value'    => true,
            'position' => 1
        ],
        [
            'group'    => 'd3_gtm_settings',
            'name'     => 'd3_gtm_blEnableDebug',
            'type'     => 'bool',
            'value'    => false,
            'position' => 999
        ],
        [
            'group'    => 'd3_gtm_settings_cookiemanager',
            'name'     => 'd3_gtm_settings_hasOwnCookieManager',
            'type'     => 'bool',
            'value'    => false,
            'position' => 999
        ],
        [
            'group'    => 'd3_gtm_settings_cookiemanager',
            'name'     => 'd3_gtm_settings_blEnableUserCentrics',
            'type'     => 'bool',
            'value'    => false,
            'position' => 999
        ],
        [
            'group'    => 'd3_gtm_settings_cookiemanager',
            'name'     => 'd3_gtm_settings_cookieName',
            'type'     => 'str',
            'value'    => 'example',
            'position' => 999
        ],
    ]
];