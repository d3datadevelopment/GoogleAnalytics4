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

        /** @var ViewConfig $oViewConfig */
        $oViewConfig = oxNew(ViewConfig::class);

        $aManagerList =  $oManagerTypes->getManagerList();

        foreach ($aManagerList as $managerName){
           if ($oViewConfig->isModuleActive($managerName)){
               return $managerName;
           }
        }

       return $this->getExplicitManager();
    }

    /**
     * @return string
     */
    public function getModuleSettingExplicitManagerSelectValue() :string
    {
        return Registry::get(ViewConfig::class)->d3GetModuleConfigParam('_HAS_STD_MANAGER');
    }

    /**
     * @return string
     */
    public function getExplicitManager() :string
    {
        $sPotentialManagerName = $this->getModuleSettingExplicitManagerSelectValue();

        /** @var ManagerTypes $oManagerTypes */
        $oManagerTypes = oxNew(ManagerTypes::class);
        return $oManagerTypes->isManagerInList($sPotentialManagerName)
            ? $sPotentialManagerName
            : "NONE";
    }
}