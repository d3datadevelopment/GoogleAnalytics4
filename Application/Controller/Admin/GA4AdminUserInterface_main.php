<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Application\Controller\Admin;

use D3\GoogleAnalytics4\Application\Model\Constants;
use D3\GoogleAnalytics4\Application\Model\ManagerHandler;
use D3\GoogleAnalytics4\Application\Model\ManagerTypes;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig;

class GA4AdminUserInterface_main extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
    protected $_sThisTemplate = '@' . Constants::OXID_MODULE_ID . '/admin/d3ga4uimain';

    public function render()
    {
        $return = parent::render();

        $this->addTplParam('d3ViewObject', $this);
        $this->addTplParam('d3ViewConfObject', Registry::get(ViewConfig::class));
        $this->addTplParam('d3ManagerTypeArray', oxNew(ManagerTypes::class)->getManagerList());
        $this->addTplParam('d3CurrentCMP', oxNew(ManagerHandler::class)->getCurrManager());

        return $return;
    }

    public function save()
    {
        parent::save();

        $aParams = Registry::getRequest()->getRequestEscapedParameter('editval');

        $aCheckBoxParams = [
            '_blEnableGa4',
            '_blEnableDebug',
            '_blEnableConsentMode',
            '_blEnableOwnCookieManager',
            '_blEnableMeasurementCapabilities',
            '_blEnableUsercentricsConsentModeApi',
        ];

        foreach ($aCheckBoxParams as $checkBoxName){
            if (isset($aParams['bool'][$checkBoxName])){
                $aParams['bool'][$checkBoxName] = true;
            }else{
                $aParams['bool'][$checkBoxName] = false;
            }
        }

        $this->d3SaveShopConfigVars($aParams);
    }

    /**
     * @param array $aParams
     * @return void
     */
    protected function d3SaveShopConfigVars(array $aParams)
    {
        $oConfig = Registry::getConfig();
        foreach ($aParams as $sConfigType => $aConfigParams) {
            foreach ($aConfigParams as $sParamName => $sParamValue){
                if($this->d3GetModuleConfigParam($sParamName) !== $sParamValue){
                    $oConfig->saveShopConfVar(
                        $sConfigType,
                        Constants::OXID_MODULE_ID.$sParamName,
                        $sParamValue,
                        $oConfig->getShopId(),
                        Constants::OXID_MODULE_ID
                    );
                }
            }
        }
    }

    /**
     * @param string $configParamName
     * @return mixed
     */
    public function d3GetModuleConfigParam(string $configParamName)
    {
        return Registry::get(ViewConfig::class)->d3GetModuleConfigParam($configParamName);
    }
}