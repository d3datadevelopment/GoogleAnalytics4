[{*$oxcmp_basket|get_class_methods|dumpvar*}]

[{assign var="d3BasketPrice" value=$oxcmp_basket->getPrice()}]
[{assign var='gtmCartArticles' value=$oView->getBasketArticles()}]

[{block name="d3_ga4_view_cart_block"}]
    [{capture name="d3_ga4_view_cart"}]
        [{strip}]
            dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */
            dataLayer.push({
                'event': 'view_cart',
                'eventLabel':'Checkout Step 1',
                'ecommerce':
                {
                    'actionField': "step: 1",
                    'currency': "[{$currency->name}]",
                    'value': [{$d3BasketPrice->getPrice()}],
                    'coupon':         '[{foreach from=$oxcmp_basket->getVouchers() item=sVoucher key=key name=Voucher}][{$sVoucher->sVoucherNr}][{if !$smarty.foreach.Voucher.last}], [{/if}][{/foreach}]',
                    'items':
                    [
                        [{foreach from=$oxcmp_basket->getContents() item=basketitem name=gtmCartContents  key=basketindex}]
                        [{assign var="d3oItemPrice" value=$basketitem->getPrice()}]
                        [{assign var="gtmBasketItem" value=$basketitem->getArticle()}]
                        [{assign var="gtmBasketItemCategory" value=$gtmBasketItem->getCategory()}]
                        {
                            'item_id':          '[{$gtmCartArticles[$basketindex]->getFieldData('oxartnum')}]',
                            'item_name':        '[{$gtmCartArticles[$basketindex]->getFieldData('oxtitle')}]',
                            'item_variant':     '[{$gtmCartArticles[$basketindex]->getFieldData('oxvarselect')}]',
                            [{if $gtmBasketItemCategory}]
                            'item_category':    '[{$gtmBasketItemCategory->getSplitCategoryArray(0, true)}]',
                            'item_category_2':  '[{$gtmBasketItemCategory->getSplitCategoryArray(1, true)}]',
                            'item_category_3':  '[{$gtmBasketItemCategory->getSplitCategoryArray(2, true)}]',
                            'item_category_4':  '[{$gtmBasketItemCategory->getSplitCategoryArray(3, true)}]',
                            'item_list_name':   '[{$gtmBasketItemCategory->getSplitCategoryArray()}]',
                            [{/if}]
                            'price':            [{$d3oItemPrice->getPrice()}],
                            'coupon':           '[{foreach from=$oxcmp_basket->getVouchers() item=sVoucher key=key name=Voucher}][{$sVoucher->sVoucherNr}][{if !$smarty.foreach.Voucher.last}], [{/if}][{/foreach}]',
                            'quantity':         [{$basketitem->getAmount()}],
                            'position':         [{$smarty.foreach.gtmCartContents.index}]
                        }[{if !$smarty.foreach.gtmCartContents.last}],[{/if}]
                        [{/foreach}]
                    ]
                }[{if $oViewConf->isDebugModeOn()}],
                'debug_mode': 'true'
                [{/if}]
            });
        [{/strip}]
    [{/capture}]
    [{oxscript add=$smarty.capture.d3_ga4_view_cart}]
[{/block}]