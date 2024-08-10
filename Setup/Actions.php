<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Setup;


use D3\GoogleAnalytics4\Application\Model\Constants;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;

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

        if ($this->d3GetModuleConfigParam($sSettingName) and (trim($this->d3GetModuleConfigParam($sSettingName)) !== trim($sSettingValue))){
            $sSettingValue = trim($this->d3GetModuleConfigParam($sSettingName));
        }

        $oConfig->saveShopConfVar(
            $sVarType,
            Constants::OXID_MODULE_ID.$sSettingName,
            $sSettingValue,
            $oConfig->getShopId(),
            Constants::OXID_MODULE_ID
        );
    }

    /**
     * @param string $configParamName
     * @return mixed
     */
    public function d3GetModuleConfigParam(string $configParamName)
    {
        return Registry::getConfig()->getShopConfVar(Constants::OXID_MODULE_ID.$configParamName, null, Constants::OXID_MODULE_ID);
    }
}