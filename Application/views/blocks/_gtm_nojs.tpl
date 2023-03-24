[{if $oViewConf->D3blShowGtmScript() && !$oViewConf->getCookieManagerType()}]
    [{if $oViewConf->getGtmContainerId()}][{strip}]
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=[{$oViewConf->getGtmContainerId()}]"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    [{/strip}][{/if}]
[{/if}]

[{$smarty.block.parent}]