<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Application\Model\CMP;


abstract class ConsentManagementPlatformBaseModel extends \OxidEsales\Eshop\Core\Model\BaseModel implements ConsentManagementPlatformInterface
{
    public string $sCMPName;

    /**
     * @return string
     */
    public function getCMPName(): string
    {
        return $this->sCMPName;
    }
}