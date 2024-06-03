<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Setup;


use D3\GoogleAnalytics4\Application\Model\Constants;
use OxidEsales\Eshop\Core\Registry;

class Actions
{
    /**
     * @param string $sVarType
     * @param string $sSettingName
     * @param string $sSettingValue
     * @return void
     */
    public function d3SaveDefaultSettings(string $sVarType, string $sSettingName, string $sSettingValue){
        $oConfig = Registry::getConfig();

        $oConfig->saveShopConfVar(
            $sVarType,
            Constants::OXID_MODULE_ID.$sSettingName,
            $sSettingValue,
            $oConfig->getShopId(),
            Constants::OXID_MODULE_ID
        );
    }
}