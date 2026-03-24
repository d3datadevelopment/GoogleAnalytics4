[{assign var="gtmProduct" value=$oView->getProduct()}]
[{assign var="gtmCategory" value=$gtmProduct->getCategory()}]
[{assign var="gtmManufacturer" value=$gtmProduct->getManufacturer()}]

[{block name="d3_ga4_view_item_block"}]
    [{capture name="d3_ga4_view_item"}]
        [{strip}]
            dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */

            dataLayer.push({
                'event': 'view_item',
                'eventLabel':'Product View',
                'ecommerce':
                {
                    'currency': '[{$currency->name}]',
                    'items':
                        [
                            {
                                'item_oxid':    '[{$gtmProduct->getFieldData("oxid")}]',
                                'item_name':    '[{$gtmProduct->getFieldData("oxtitle")|escape:'quotes'}]',
                                'item_id':      '[{$gtmProduct->getFieldData("oxartnum")}]',
                                'item_brand':   '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
                                'item_variant': '[{if $gtmProduct->getFieldData("oxvarselect")}][{$gtmProduct->getFieldData("oxvarselect")|escape:'quotes'}][{/if}]',
                                [{if $gtmCategory}]
                                'item_category':    '[{$gtmCategory->getSplitCategoryArray(0, true)|escape:'quotes'}]',
                                'item_category2':   '[{$gtmCategory->getSplitCategoryArray(1, true)|escape:'quotes'}]',
                                'item_category3':   '[{$gtmCategory->getSplitCategoryArray(2, true)|escape:'quotes'}]',
                                'item_category4':   '[{$gtmCategory->getSplitCategoryArray(3, true)|escape:'quotes'}]',
                                'item_list_name':   '[{$gtmCategory->getSplitCategoryArray()}]',
                                [{/if}]
                                [{assign var="d3PriceObject" value=$gtmProduct->getPrice()}]
                                'price': [{$d3PriceObject->getPrice()}]
                            }
                            [{if $oViewConf->d3GetModuleConfigParam('_blViewItemAddVariants')}],
                                [{foreach from=$gtmProduct->getVariants() item="oVariant"}]
                                {
                                    'item_name':    '[{$oVariant->getFieldData("oxtitle")|escape:'quotes'}]',
                                    'item_id':      '[{$oVariant->getFieldData("oxartnum")}]',
                                    'item_brand':   '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
                                    'item_variant': '[{if $oVariant->getFieldData("oxvarselect")}][{$oVariant->getFieldData("oxvarselect")}][{/if}]',
                                    [{if $gtmCategory}]
                                        'item_category':    '[{$gtmCategory->getSplitCategoryArray(0, true)|escape:'quotes'}]',
                                        'item_category2':   '[{$gtmCategory->getSplitCategoryArray(1, true)|escape:'quotes'}]',
                                        'item_category3':   '[{$gtmCategory->getSplitCategoryArray(2, true)|escape:'quotes'}]',
                                        'item_category4':   '[{$gtmCategory->getSplitCategoryArray(3, true)|escape:'quotes'}]',
                                        'item_list_name':   '[{$gtmCategory->getSplitCategoryArray()}]',
                                    [{/if}]
                                    [{assign var="d3PriceObject" value=$oVariant->getPrice()}]
                                    'price': [{$d3PriceObject->getPrice()}]
                                },
                            [{/foreach}]
                        [{/if}]
                        ]
                }[{if $oViewConf->isDebugModeOn()}],
                'debug_mode': 'true'
                [{/if}]
            });
        [{/strip}]
    [{/capture}]
    [{oxscript add=$smarty.capture.d3_ga4_view_item}]
[{/block}]