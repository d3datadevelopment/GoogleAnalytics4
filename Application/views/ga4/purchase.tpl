[{strip}]
    <script>
      window.dataLayer = window.dataLayer || [];
      dataLayer.push({ ecommerce: null });
      dataLayer.push({
        [{assign var="oBasket" value=$order->getBasket()}]
        [{assign var="iVat" value=0}]

        'event':'purchase',
        'ecommerce':{
          'purchase':{
            'actionField':{
              'id': [{$order->getFieldData('oxordernr')}],
              'ordernr': [{$order->getFieldData('oxtotalordersum')}],
              'tax': [{$order->d3GetSumOrderVat()}],
              'shipping': [{$order->getFieldData('oxdelcost')}],
              'currency': "[{$order->getFieldData('oxcurrency')}]"
            },
            'products':[
              [{foreach from=$order->getOrderArticles() item=listItem}]
                  [{assign var="orderArticle" value=$listItem->getArticle()}]
              {
                'item_id':    "[{$listItem->getFieldData('oxartnum')}]",
                'item_name':  "[{$listItem->getFieldData('oxtitle')}]",
                'currency':   "[{$order->getFieldData('oxcurrency')}]",
                'articleVat':   [{$orderArticle->getArticleVat()}],
                'price':      [{$orderArticle->getBasePrice()}],
                'quantity':   [{$listItem->getFieldData('oxamount')}]
              },
              [{/foreach}]
            ]
          }
        }
      });
    </script>
[{/strip}]