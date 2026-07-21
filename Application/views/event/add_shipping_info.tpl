[{*$oxcmp_basket|get_class_methods|dumpvar*}]

[{assign var="gtmBasketPrice" value=$oxcmp_basket->getPrice()}]
[{assign var="gtmBasketObject" value=$oxcmp_basket}]
[{assign var='gtmCartArticles' value=$gtmBasketObject->getBasketArticles()}]
[{assign var="gtmPaymentObject" value=$oView->getPayment()}]

[{block name="gtm_ga4_add_shipping_info_block"}]
    [{capture name="gtm_ga4_add_shipping_info"}]
        [{strip}]
            dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */
            dataLayer.push({
            'event': 'add_shipping_info',
            'eventLabel':'Checkout - Shipping info',
            'shipping_tier': '[{$gtmPaymentObject->gtmGetSelectedShippingName()}]',
            'ecommerce':
            {
                'actionField': "Shipping-Info",
                'currency': "[{$currency->name}]",
                'value': [{$gtmBasketPrice->getPrice()}],
                'coupon':         '[{foreach from=$oxcmp_basket->getVouchers() item=sVoucher key=key name=Voucher}][{$sVoucher->sVoucherNr}][{if !$smarty.foreach.Voucher.last}], [{/if}][{/foreach}]',
                'items':
                [
                    [{foreach from=$oxcmp_basket->getContents() item=basketitem name=gtmCartContents  key=basketindex}]
                        [{assign var="gtmItemPriceObject" value=$basketitem->getPrice()}]
                        [{assign var="gtmBasketItem" value=$basketitem->getArticle()}]
                        [{assign var="gtmBasketItemCategory" value=$gtmBasketItem->getCategory()}]
                        {
                        'item_oxid':        '[{$gtmCartArticles[$basketindex]->getFieldData('oxid')}]',
                        'item_id':          '[{$gtmCartArticles[$basketindex]->getFieldData('oxartnum')}]',
                        'item_name':        '[{$gtmCartArticles[$basketindex]->getFieldData('oxtitle')|escape:'quotes'}]',
                        'item_variant':     '[{$gtmCartArticles[$basketindex]->getFieldData('oxvarselect')|escape:'quotes'}]',
                        'item_brand': '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value|escape:'quotes'}][{/if}]',
                        [{if $gtmBasketItemCategory}]
                        'item_category':    '[{$gtmBasketItemCategory->getSplitCategoryArray(0, true)|escape:'quotes'}]',
                        'item_category2':   '[{$gtmBasketItemCategory->getSplitCategoryArray(1, true)|escape:'quotes'}]',
                        'item_category3':  '[{$gtmBasketItemCategory->getSplitCategoryArray(2, true)|escape:'quotes'}]',
                        'item_category4':  '[{$gtmBasketItemCategory->getSplitCategoryArray(3, true)|escape:'quotes'}]',
                        'item_list_name':   '[{$gtmBasketItemCategory->getSplitCategoryArray()}]',
                        [{/if}]
                        [{oxhasrights ident="SHOWARTICLEPRICE"}]'price':            [{$gtmItemPriceObject->getPrice()}],[{/oxhasrights}]
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
    [{oxscript add=$smarty.capture.gtm_ga4_add_shipping_info}]
    [{/block}]