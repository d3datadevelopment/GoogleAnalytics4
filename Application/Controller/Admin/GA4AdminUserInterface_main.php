<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Application\Controller\Admin;

use D3\GoogleAnalytics4\Application\Model\Constants;
use D3\GoogleAnalytics4\Application\Model\ManagerHandler;
use D3\GoogleAnalytics4\Application\Model\ManagerTypes;
use OxidEsales\Eshop\Application\Controller\Admin\ModuleConfiguration;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Str;
use OxidEsales\Eshop\Core\ViewConfig;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidSupport\ModulePerformance\Internal\Framework\Module\Facade\ModuleSettingService as oxSupportModuleSettingService;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;

class GA4AdminUserInterface_main extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
    protected $_sThisTemplate = '@' . Constants::OXID_MODULE_ID . '/admin/d3ga4uimain';
	protected $GA4ModuleSettingNameArray = [];
	
	public function init()
	{
		parent::init();
		
		/*if (empty($this->GA4ModuleSettingNameArray) or count($this->GA4ModuleSettingNameArray) === 0){
			$this->GA4ModuleSettingNameArray = $this->d3GetModuleSettingNameArray();
		}*/
	}
	
	public function render()
    {
        $return = parent::render();

        $this->addTplParam('d3ViewObject', $this);
        $this->addTplParam('d3ViewConfObject', Registry::get(ViewConfig::class));
        $this->addTplParam('d3ManagerTypeArray', oxNew(ManagerTypes::class)->getManagerList());
        $this->addTplParam('d3CurrentCMP', oxNew(ManagerHandler::class)->getActManager());
		
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
            '_blUseRealCategoyTitles',
            '_blEnableMeasurementCapabilities',
            '_blEnableUsercentricsConsentModeApi',
            '_blViewItemAddVariants',
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
     * @return ModuleSettingService|oxSupportModuleSettingService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function d3GetModuleSettings() :ModuleSettingService|oxSupportModuleSettingService
    {
        return ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingServiceInterface::class);
    }

    /**
     * @param string $sSettingName
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function d3SettingExists(string $sSettingName) :bool
    {
        return $this->d3GetModuleSettings()
            ->exists(Constants::OXID_MODULE_ID.$sSettingName, Constants::OXID_MODULE_ID);
    }
	
	/**
	 * @param array $aParams
	 * @return void
	 */
    protected function d3SaveShopConfigVars(array $aParams)
    {
        foreach ($aParams as $sConfigType => $aConfigParams) {
            foreach ($aConfigParams as $sSettingName => $sSettingValue){
                try {
                    //if($this->d3GetModuleConfigParam($sSettingName) !== $sSettingValue){}
                    if ($this->d3SettingExists($sSettingName)){
                        $sSettingName = Constants::OXID_MODULE_ID.$sSettingName;

                        // converting select to str
                        if ($sConfigType === "select"){
                            $sConfigType = "str";
                        }

                        switch ($sConfigType){
                           case 'str':
                               $this->d3GetModuleSettings()->saveString($sSettingName, $sSettingValue,Constants::OXID_MODULE_ID);
                               break;
                           case 'bool':
                               $this->d3GetModuleSettings()->saveBoolean($sSettingName, $sSettingValue,Constants::OXID_MODULE_ID);
                               break;
                           default:
                               Registry::getLogger()->error(
                                   'No given datatype defined!',
                                   [Constants::OXID_MODULE_ID." -> ".__METHOD__.": ".__LINE__." with '".$sSettingName."'"]
                               );
                       }
                }
                } catch (\Throwable $throwable) {
                    Registry::getUtilsView()->addErrorToDisplay($throwable);
                    Registry::getLogger()->error($throwable->getMessage());
                }

            }
        }
    }
	
	/**
	 * @param string $configParamName
	 * @param bool $displayThrowable
	 * @return mixed
	 */
    public function d3GetModuleConfigParam(string $configParamName, bool $displayThrowable = false)
    {
        return Registry::get(ViewConfig::class)->d3GetModuleConfigParam($configParamName, $displayThrowable);
    }
}