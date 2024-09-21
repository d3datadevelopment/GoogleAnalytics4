
[{if $d3CmpBasket && $d3CmpBasket->getAddToBasketDecision() && $d3CmpBasket->d3GtmRequestedArticleLoadedByAnid() !== null}]
  [{assign var="oGtmProduct"              value=$d3CmpBasket->d3GtmRequestedArticleLoadedByAnid()}]
  [{assign var="oGtmAmountArticlesAdded"  value=$d3CmpBasket->getD3GtmAddToCartAmountArticles()}]
  [{*$smarty.block.parent*}]
  [{* variable $oGtmProduct is passed from parent tempalte *}]
  [{assign var="d3PriceObject"    value=$oGtmProduct->getPrice()}]
  [{assign var="gtmCurrency"      value=$oView->getActCurrency()}]
  [{assign var="gtmManufacturer"  value=$oGtmProduct->getManufacturer()}]
  [{assign var="gtmCategory"      value=$oGtmProduct->getCategory()}]

  [{block name="d3_ga4_add_to_cart_list_block"}]
    [{capture name="d3_ga4_add_to_cart_listtpl"}]
      [{strip}]
      dataLayer.push({"event": null, "eventLabel": null, "ecommerce": null});  /* Clear the previous ecommerce object. */

      [{*** Debug cases ***}]
      [{*event.preventDefault();*}]

      let iArtQuantity = $("[{$htmlIdAmountOfArticles}]").val();
      let iArtQuantityAdded = [{$oGtmAmountArticlesAdded}];

      if(!iArtQuantity && (iArtQuantityAdded === 1)){
        iArtQuantity = 1;
      }else{
        iArtQuantity = iArtQuantityAdded;
      }

      dataLayer.push({
        'isAddToBasket': true,
        'event':'add_to_cart',
        'eventLabel': 'add_to_cart',
        'ecommerce': {
          'currency':   "[{$currency->name}]",
          'value':      iArtQuantity*[{$d3PriceObject->getPrice()}],
          'items':      [
            {
              'item_id':        '[{$oGtmProduct->getFieldData('oxartnum')}]',
              'item_name':      '[{$oGtmProduct->getFieldData('oxtitle')}]',
              'price':          [{$d3PriceObject->getPrice()}],
              'item_brand':     '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
              'item_variant':   '[{if $oGtmProduct->getFieldData('oxvarselect')}][{$oGtmProduct->getFieldData('oxvarselect')}][{/if}]',
              [{if $gtmCategory}]
              'item_category':  '[{$gtmCategory->getSplitCategoryArray(0, true)}]',
              'item_category_2':'[{$gtmCategory->getSplitCategoryArray(1, true)}]',
              'item_category_3':'[{$gtmCategory->getSplitCategoryArray(2, true)}]',
              'item_category_4':'[{$gtmCategory->getSplitCategoryArray(3, true)}]',
              'item_list_name':'[{$gtmCategory->getSplitCategoryArray()}]',
              [{/if}]
              'quantity': iArtQuantity
            }
          ]
        }[{if $oViewConf->isDebugModeOn()}],
        'debug_mode': 'true'
        [{/if}]
      });
      [{/strip}]
    [{/capture}]
    [{oxscript add=$smarty.capture.d3_ga4_add_to_cart_listtpl}]
  [{/block}]
[{/if}]