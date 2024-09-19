<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Modules\Application\Model;


use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\Registry;

class gtmPayment extends gtmPayment_parent
{
    /**
     * @return string
     */
    public function gtmGetSelectedPaymentName() :string
    {
        return $this->getFieldData('oxpayments__oxdesc')?: 'No payment name available';
    }
}