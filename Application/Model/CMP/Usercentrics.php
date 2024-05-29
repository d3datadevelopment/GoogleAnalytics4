<?php

declare(strict_types=1);

namespace D3\GoogleAnalytics4\Application\Model\CMP;


use D3\GoogleAnalytics4\Application\Model\ManagerTypes;

class Usercentrics extends ConsentManagementPlatformBaseModel
{
    const sCMPName = ManagerTypes::USERCENTRICS_MANUALLY;
    const sAlternatename = ManagerTypes::USERCENTRICS_MODULE;
}