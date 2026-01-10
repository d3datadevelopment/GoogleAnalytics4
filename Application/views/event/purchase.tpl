[{block name="d3_ga4_purchase_block"}]
    [{capture name="d3_ga4_purchase"}]
        [{strip}]
            dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */
            [{assign var="gtmOrder"         value=$oView->getOrder()}]
            [{assign var="gtmBasket"         value=$oView->getBasket()}]
            [{assign var="gtmArticles"      value=$gtmOrder->getOrderArticles()}]
            [{assign var="gtmOrderVouchers"  value=$gtmOrder->getVoucherNrList()}]

            dataLayer.push({
                'event': 'purchase',
                'eventLabel':'Checkout Step 5',
                'ecommerce':
                {
                    'transaction_id': '[{$gtmOrder->getFieldData("oxordernr")}]',
                    'affiliation':    '[{$oxcmp_shop->getFieldData("oxname")}]',
                    'value':          [{$gtmOrder->getTotalOrderSum()}],
                    'tax':            [{math equation="x+y" x=$gtmOrder->getFieldData("oxartvatprice1") y=$gtmOrder->getFieldData("oxartvatprice2") }],
                    'shipping':       [{$gtmOrder->getFieldData("oxdelcost")}],
                    'currency':       '[{$gtmOrder->getFieldData('oxcurrency')}]',
                    'coupon':         '[{foreach from=$gtmOrderVouchers item="gtmOrderVoucher" name="gtmOrderVoucherIteration"}][{$gtmOrderVoucher}][{if !$smarty.foreach.gtmOrderVoucherIteration.last}], [{/if}][{/foreach}]',
                    'paymentType':    '[{$gtmBasket->getPaymentOnPaymentId($gtmOrder->getFieldData("oxpaymenttype"))|escape:'quotes'}]',
                    'items':
                    [
                        [{foreach from=$gtmArticles item="gtmBasketItem" name="gtmArticles"}]
                        [{assign var="gtmPurchaseItemPriceObject"   value=$gtmBasketItem->getPrice()}]
                        [{assign var="gtmPurchaseItem"              value=$gtmBasketItem->getArticle()}]
                        [{assign var="gtmPurchaseItemCategory"      value=$gtmPurchaseItem->getCategory()}]
                        [{assign var="gtmManufacturer"              value=$gtmPurchaseItem->getManufacturer()}]

                        {
                            'item_oxid':        '[{$gtmBasketItem->getFieldData("oxid")}]',
                            'item_id':          '[{$gtmBasketItem->getFieldData("oxartnum")}]',
                            'item_name':        '[{$gtmBasketItem->getFieldData("oxtitle")|escape:'quotes'}]',
                            'affiliation':      '[{$gtmBasketItem->getFieldData("oxtitle")}]',
                            'coupon':           '[{foreach from=$gtmOrderVouchers item="gtmOrderVoucher" name="gtmOrderVoucherIteration"}][{$gtmOrderVoucher}][{if !$smarty.foreach.gtmOrderVoucherIteration.last}], [{/if}][{/foreach}]',
                            'item_variant':     '[{$gtmBasketItem->getFieldData("oxselvariant")|escape:'quotes'}]',
                            'item_brand': '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
                            [{if $gtmPurchaseItemCategory}]
                            'item_category':    '[{$gtmPurchaseItemCategory->getSplitCategoryArray(0, true)|escape:'quotes'}]',
                            'item_category2':   '[{$gtmPurchaseItemCategory->getSplitCategoryArray(1, true)|escape:'quotes'}]',
                            'item_category3':   '[{$gtmPurchaseItemCategory->getSplitCategoryArray(2, true)|escape:'quotes'}]',
                            'item_category4':   '[{$gtmPurchaseItemCategory->getSplitCategoryArray(3, true)|escape:'quotes'}]',
                            'item_list_name':   '[{$gtmPurchaseItemCategory->getSplitCategoryArray()}]',
                            [{/if}]
                            [{oxhasrights ident="SHOWARTICLEPRICE"}]'price':            [{$gtmPurchaseItemPriceObject->getPrice()}],[{/oxhasrights}]
                            'quantity':         [{$gtmBasketItem->getFieldData("oxamount")}],
                            'position':         [{$smarty.foreach.gtmArticles.iteration}]
                        }[{if !$smarty.foreach.gtmArticles.last}],[{/if}]
                        [{/foreach}]
                    ]
                }[{if $oViewConf->isDebugModeOn()}],
                'debug_mode': 'true'
                [{/if}]
            });
        [{/strip}]
    [{/capture}]
    [{oxscript add=$smarty.capture.d3_ga4_purchase}]
[{/block}]