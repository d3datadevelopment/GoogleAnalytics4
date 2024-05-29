[{* Always prepare the data layer to avoid errors *}]
<script>
  var dataLayer = [{$oViewConf->getGtmDataLayer()}] || [];
</script>

[{assign var="d3GtmContainerIdString" value=$oViewConf->getGtmContainerId()}]

[{if $oViewConf->isGA4enabled() and $oViewConf->D3blShowGtmScript()}]
    [{if $d3GtmContainerIdString}]
        [{strip}]

            [{if $oViewConf->isGtmConsentModeSetActivated()}]
                <script type="text/javascript">
                [{if $oViewConf->d3IsUsercentricsCMPChosen() and $oViewConf->d3GetModuleConfigParam('_blEnableMeasurementCapabilities')}]
                        [{$oViewConf->d3GetModuleConfigParam('_sMeasurementCapabilities')|strip}]
                [{else}]
                    function gtag() {
                        dataLayer.push(arguments);
                    }

                    gtag("consent", "default", {
                        ad_user_data: "denied",
                        ad_personalization: "denied",
                        ad_storage: "denied",
                        analytics_storage: "denied",
                        wait_for_update: 2000
                    });
                [{/if}]
                </script>
            [{/if}]

            [{if $oViewConf->d3IsUsercentricsCMPChosen() and $oViewConf->d3GetModuleConfigParam('_blEnableUsercentricsConsentModeApi')}]
                <script type="text/javascript">
                    [{$oViewConf->d3GetModuleConfigParam('_sUsercentricsConsentModeApi')|strip}]
                </script>
            [{/if}]

            <!-- Google Tag Manager -->
            <script [{$oViewConf->getGtmScriptAttributes()}]>
              (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = '[{$oViewConf->getServerSidetaggingJsDomain()}]?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
              })(window, document, 'script', 'dataLayer', '[{$d3GtmContainerIdString}]');
            </script>
            <!-- End Google Tag Manager -->
        [{/strip}]
    [{/if}]
[{/if}]

[{$smarty.block.parent}]