<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Modules\Application\Model;

class gtmPayment extends gtmPayment_parent
{
    /**
     * @return string
     */
    public function gtmGetSelectedPaymentName() :string
    {
        return (string)$this->getFieldData('oxpayments__oxdesc')?: 'No payment name available';
    }
}