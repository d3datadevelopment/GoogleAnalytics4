<?php

namespace D3\GoogleAnalytics4\Modules\Application\Model;

use OxidEsales\Eshop\Application\Model\Payment;

class Basket extends Basket_parent
{
    /**
     * @return string
     */
    public function getPaymentOnPaymentId(string $paymentId) :string
    {
        if ($paymentId){
            $oPayment = oxNew(Payment::class);
            if ($oPayment->load($paymentId)){
	            $sPaymentName = $oPayment->getFieldData('oxdesc');
				if($sPaymentName){
					return $sPaymentName;
				}else{
				return $paymentId;
				}
            }else{
	            return "No Payment loadable with paymentID -".$paymentId;
            }
        }

        return "No paymentID";
    }
}