<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Modules\Application\Model;

use OxidEsales\Eshop\Core\Registry;

class gtmPayment extends gtmPayment_parent
{
    /**
     * @return string
     */
    public function gtmGetSelectedPaymentName() :string
    {
        return (string)$this->getFieldData('oxpayments__oxdesc')?: 'No payment name available';
    }
	
	/**
	 * @return string
	 */
	public function gtmGetSelectedShippingName() :string
	{
		$sActShipSet = Registry::getConfig()->getRequestParameter('sShipSet');
		if (!$sActShipSet) {
			$sActShipSet = Registry::getSession()->getVariable('sShipSet');
		}
		
		return (string)$sActShipSet ? $sActShipSet : '';
	}
}