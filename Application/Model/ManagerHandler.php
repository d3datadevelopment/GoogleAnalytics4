<?php

namespace D3\GoogleAnalytics4\Application\Model;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;

class ManagerHandler
{
    /**
     * Gets current chosen Manager
     *
     * @return string
     */
    public function getCurrManager() :string
    {
        /** @var ManagerTypes $oManagerTypes */
        $oManagerTypes = oxNew(ManagerTypes::class);

        /** @var ViewConfig|\D3\GoogleAnalytics4\Modules\Core\ViewConfig $oViewConfig */
        $oViewConfig = oxNew(ViewConfig::class);

        $aManagerList =  $oManagerTypes->getManagerList();

        if ($this->getModuleSettingExplicitManagerSelectValue()){
            return $this->getExplicitManager();
        }

        foreach ($aManagerList as $shopModuleId => $publicCMPName){
           if ($oViewConfig->d3IsModuleActive($shopModuleId)){
               $this->d3SaveShopConfVar($shopModuleId);
               return $shopModuleId;
           }
        }

        return "";
    }

    /**
     * @param string $sParam
     * @return void
     */
    public function d3SaveShopConfVar(string $sParam){
        Registry::getConfig()->saveShopConfVar(
            'select',
            Constants::OXID_MODULE_ID."_HAS_STD_MANAGER",
            $sParam,
            Registry::getConfig()->getShopId(),
            Constants::OXID_MODULE_ID
        );
    }

    /**
     * @return string
     */
    public function getModuleSettingExplicitManagerSelectValue() :string
    {
        return Registry::get(ViewConfig::class)->d3GetModuleConfigParam('_HAS_STD_MANAGER')?:"";
    }

    /**
     * @return string
     */
    public function getExplicitManager() :string
    {
        $sPotentialManagerName = $this->getModuleSettingExplicitManagerSelectValue();

        /** @var ManagerTypes $oManagerTypes */
        $oManagerTypes = oxNew(ManagerTypes::class);
        $sCMPName = $oManagerTypes->isManagerInList($sPotentialManagerName)
            ? $sPotentialManagerName
            : "NONE";

        $this->d3SaveShopConfVar($sCMPName);

        return $sCMPName;
    }
}