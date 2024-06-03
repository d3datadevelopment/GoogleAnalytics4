<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Setup;


class Events
{
    /**
     * @return void
     */
    public static function onActivate()
    {
        $oActions = oxNew(Actions::class);
        $oActions->d3SaveDefaultSettings(
            'str',
            '_sServersidetagging_js',
            'https://www.googletagmanager.com/gtm.js'
        );
        $oActions->d3SaveDefaultSettings(
            'str',
            '_sServersidetagging_js',
            'https://www.googletagmanager.com/ns.html'
        );
        $oActions->d3SaveDefaultSettings(
            'str',
            '_sContainerID',
            'GTM-'
        );
    }

    /**
     * @return void
     */
    public static function onDeactivate(){}
}