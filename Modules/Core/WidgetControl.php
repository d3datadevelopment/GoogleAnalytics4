<?php

namespace D3\GoogleAnalytics4\Modules\Core;

use OxidEsales\EshopCommunity\Core\Registry;

class WidgetControl extends WidgetControl_parent{
    protected function _getStartController() // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
    {
        /*
         * array (
          'force_sid' => '2pistlaubiq58qtg3moudei0la',
          'lang' => '0',
          'actcontrol' => 'details',
          'anid' => '064471',
          'cl' => 'oxwarticledetails',
          'cnid' => '159dd0f2fb2bd6e24ace53a0f1913797',
          'listtype' => 'list',
          'nocookie' => '1',
          'oxwparent' => 'details',
          'sid' => '2pistlaubiq58qtg3moudei0la',
          'stoken' => 'A22D0F9E',
          'varselid' =>
          array (
            0 => 'b842982bf522aa839bd88221f562fce8',
          ),
        )
         */

        $aParameter = $_GET;
        if( is_null($aParameter['actcontrol'])
            && is_null($aParameter['actcontrol'])
            && is_null($aParameter['actcontrol'])
        )
        {
            return 'D3\GoogleAnalytics4\Application\Component\Widget\d3GtmStartWidget';
        }

        return $this->getStartControllerKey();
    }

    protected function getStartControllerKey()
    {
        $controllerKey = Registry::getConfig()->getRequestControllerId();

        // Use default route in case no controller id is given
        if (!$controllerKey) {
            $session = \OxidEsales\Eshop\Core\Registry::getSession();
            if ($this->isAdmin()) {
                $controllerKey = $session->getVariable("auth") ? 'admin_start' : 'login';
            } else {
                $controllerKey = $this->getFrontendStartControllerKey();
            }
            $session->setVariable('cl', $controllerKey);
        }

        return $controllerKey;
    }
}