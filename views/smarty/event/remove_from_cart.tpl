[{block name="d3_ga4_remove_from_cart_block"}]
    [{if $hasBeenReloaded}]
        [{assign var="d3BasketPrice" value=$oxcmp_basket->getPrice()}]
        [{capture name="d3_ga4_remove_from_cart"}]
            [{strip}]
                dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */
                dataLayer.push({
                    'isRemoveFromCart': true,
                    'event': 'remove_from_cart',
                    'eventLabel':'remove_from_cart',
                    'ecommerce': {
                        'actionField': "step: 1",
                        'currency': "[{$currency->name}]",
                        'value': [{$d3BasketPrice->getPrice()}],
                        'coupon':         '[{foreach from=$oxcmp_basket->getVouchers() item=sVoucher key=key name=Voucher}][{$sVoucher->sVoucherNr}][{if !$smarty.foreach.Voucher.last}], [{/if}][{/foreach}]',
                        'items': [
                            [{foreach from=$toRemoveArticles->getArray() name=gtmRemovedItems item=rmItem  key=rmItemindex}]
                            [{assign var="d3oItemPrice" value=$rmItem->getPrice()}]
                            [{assign var="gtmBasketItemCategory" value=$rmItem->getCategory()}]
                            {
                            'item_id':          '[{$rmItem->getFieldData('oxartnum')}]',
                            'item_name':        '[{$rmItem->getFieldData('oxtitle')}]',
                            'item_variant':     '[{$rmItem->getFieldData('oxvarselect')}]',
                            [{if $gtmBasketItemCategory}]
                            'item_category':    '[{$gtmBasketItemCategory->getSplitCategoryArray(0, true)}]',
                            'item_category_2':  '[{$gtmBasketItemCategory->getSplitCategoryArray(1, true)}]',
                            'item_category_3':  '[{$gtmBasketItemCategory->getSplitCategoryArray(2, true)}]',
                            'item_category_4':  '[{$gtmBasketItemCategory->getSplitCategoryArray(3, true)}]',
                            'item_list_name':   '[{$gtmBasketItemCategory->getSplitCategoryArray()}]',
                            [{/if}]
                            'price':            [{$d3oItemPrice->getPrice()}],
                            'coupon':           '[{foreach from=$oxcmp_basket->getVouchers() item=sVoucher key=key name=Voucher}][{$sVoucher->sVoucherNr}][{if !$smarty.foreach.Voucher.last}], [{/if}][{/foreach}]',
                            'quantity':         '[{$rmItem->getFieldData('d3AmountThatGotRemoved')}]',
                            'position':         [{$smarty.foreach.gtmRemovedItems.index}]
                            }[{if !$smarty.foreach.gtmRemovedItems.last}],[{/if}]
                            [{/foreach}]
                        ]
                    }[{if $oViewConf->isDebugModeOn()}],
                    'debug_mode': 'true'
                    [{/if}]
                });
            [{/strip}]
        [{/capture}]
        [{oxscript add=$smarty.capture.d3_ga4_remove_from_cart}]
    [{/if}]
[{/block}]