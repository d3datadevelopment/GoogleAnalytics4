[{assign var="gtmProducts" value=$oView->getArticleList()}]
[{assign var="gtmCategory" value=$oView->getActiveCategory()}]

[{assign var="breadCrumb" value=''}]

[{block name="d3_ga4_view_item_list_block"}]
    [{if $gtmProducts|@count}]
        [{capture name="d3_ga4_view_item_list"}]
            [{strip}]
                dataLayer.push({ecommerce: null});
                dataLayer.push({
                    'event':'view_item_list',
                    'event_name': 'view_item_list',
                    'ecommerce': {
                        'item_list_id': '[{$oView->getCategoryId()}]',
                        'item_list_name': '[{foreach from=$oView->getBreadCrumb() item=sCrum}][{if $sCrum.title }][{$breadCrumb|cat:$sCrum.title|cat:" > "|escape:'quotes'}][{/if}][{/foreach}]',
                        'items': [
                            [{foreach from=$gtmProducts name="gtmProducts" item="gtmProduct"}]
                            [{assign var="d3PriceObject" value=$gtmProduct->getPrice()}]
                            [{assign var="gtmManufacturer" value=$gtmProduct->getManufacturer()}]
                            [{if !$gtmCategory}][{assign var="gtmCategory" value=$gtmProduct->getCategory()}][{/if}]
                            {
                                'item_oxid': '[{$gtmProduct->getFieldData("oxid")}]',
                                'item_id': '[{$gtmProduct->getFieldData("oxartnum")}]',
                                'item_name': '[{$gtmProduct->getFieldData("oxtitle")|escape:'quotes'}]',
                                [{oxhasrights ident="SHOWARTICLEPRICE"}]'price': [{$d3PriceObject->getPrice()}],[{/oxhasrights}]
                                'item_brand': '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value|escape:'quotes'}][{/if}]',
                                [{if $gtmCategory}]
                                'item_category':    '[{$gtmCategory->getSplitCategoryArray(0, true)|escape:'quotes'}]',
                                'item_category2':   '[{$gtmCategory->getSplitCategoryArray(1, true)|escape:'quotes'}]',
                                'item_category3':   '[{$gtmCategory->getSplitCategoryArray(2, true)|escape:'quotes'}]',
                                'item_category4':   '[{$gtmCategory->getSplitCategoryArray(3, true)|escape:'quotes'}]',
                                [{/if}]
                                'quantity': 1
                            }[{if !$smarty.foreach.gtmProducts.last}],[{/if}]
                            [{/foreach}]
                        ]
                    }[{if $oViewConf->isDebugModeOn()}],
                    'debug_mode': 'true'
                    [{/if}]
                });
            [{/strip}]
        [{/capture}]
        [{oxscript add=$smarty.capture.d3_ga4_view_item_list}]
    [{/if}]
[{/block}]