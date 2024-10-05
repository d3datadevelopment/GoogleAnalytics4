[{if $oViewConf->D3blShowGtmScript()}]
    [{if $oViewConf->getGtmContainerId()}][{strip}]
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="[{$oViewConf->getServerSidetaggingNoJsDomain()}]?id=[{$oViewConf->getGtmContainerId()}]"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
<!-- End Google Tag Manager (noscript) -->
    [{/strip}][{/if}]
    [{/if}]

[{$smarty.block.parent}]