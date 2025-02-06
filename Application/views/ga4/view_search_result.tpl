[{$smarty.block.parent}]

[{assign var="gtmProducts" value=$oView->getArticleList()}]

[{block name="d3_ga4_view_search_result_block"}]
  [{if $gtmProducts}]
    [{capture assign=d3_ga4_view_search_result}]
      [{strip}]
        dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */
        dataLayer.push({
          'event': 'view_search_result',
          'eventLabel':'view_search_result[{if $oViewConf->isDebugModeOn()}]_test[{/if}]',
          'ecommerce': {
            'search_term': '[{$searchparamforhtml}]',
            'items': [
              [{foreach from=$gtmProducts name="gtmProducts" item="gtmProduct"}]
              [{assign var="d3PriceObject" value=$gtmProduct->getPrice()}]
              [{assign var="gtmManufacturer" value=$gtmProduct->getManufacturer()}]
              [{assign var="gtmCategory" value=$gtmProduct->getCategory()}]
              {
                'item_id': '[{$gtmProduct->getFieldData("oxartnum")}]',
                'item_name': '[{$gtmProduct->getRawFieldData("oxtitle")}]',
                [{oxhasrights ident="SHOWARTICLEPRICE"}]'price': [{$d3PriceObject->getPrice()}],[{/oxhasrights}]
                'item_brand': '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
                [{if $gtmCategory}]
                'item_category':  '[{$gtmCategory->getSplitCategoryArray(0)}]',
                'item_category2':'[{$gtmCategory->getSplitCategoryArray(1)}]',
                'item_category3':'[{$gtmCategory->getSplitCategoryArray(2)}]',
                'item_category4':'[{$gtmCategory->getSplitCategoryArray(3)}]',
                'item_list_name':'[{$gtmCategory->getSplitCategoryArray()}]',
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
    [{oxscript add=$d3_ga4_view_search_result}]
  [{/if}]
[{/block}]