[{* Always prepare the data layer to avoid errors *}]
<script>
  var dataLayer = [{$oViewConf->getGtmDataLayer()}] || [];
</script>

[{if $oViewConf->D3blShowGtmScript()}]
    [{if $oViewConf->getGtmContainerId()}]
        [{strip}]

            [{if $oViewConf->isGtmConsentModeSetActivated()}]
            <script type="text/javascript">
                // create dataLayer
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }

                // set „denied" as default for both ad and analytics storage, as well as ad_user_data and ad_personalization,
                gtag("consent", "default", {
                    ad_user_data: "denied",
                    ad_personalization: "denied",
                    ad_storage: "denied",
                    analytics_storage: "denied",
                    wait_for_update: 2000 // milliseconds to wait for update
                });

                // Enable ads data redaction by default [optional]
                gtag("set", "ads_data_redaction", true);
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
              })(window, document, 'script', 'dataLayer', '[{$oViewConf->getGtmContainerId()}]');
            </script>
            <!-- End Google Tag Manager -->
        [{/strip}]
    [{/if}]
[{/if}]

[{$smarty.block.parent}]