[{strip}]
    [{* variable $gtmProduct is passed from parent tempalte *}]
    [{assign var="gtmCurrency" value=$oView->getActCurrency()}]
    [{assign var="gtmManufacturer" value=$gtmProduct->getManufacturer()}]
    [{assign var="gtmCategory" value=$gtmProduct->getCategory()}]
    <script>
        dataLayer.push({ecommerce: null});
        dataLayer.push({
            'event':'GA4_event',
            'event_name': 'view_item',
            'ecommerce': {
                'items': [
                    {
                        'item_id': '[{$gtmProduct->getFieldData("oxartnum")}]',
                        'item_name': '[{$gtmProduct->getFieldData("oxtitle")}]',
                        'item_variant': '[{if $gtmProduct->oxarticles__oxvarselect->value}][{$gtmProduct->oxarticles__oxvarselect->value}][{/if}]',
                        'price': [{$gtmProduct->oxarticles__oxprice->value|default:0}],
                        'item_brand': '[{if $gtmManufacturer}][{$gtmManufacturer->oxmanufacturers__oxtitle->value}][{/if}]',
                        'item_category': '[{if $gtmCategory}][{$gtmCategory->getLink()|parse_url:5|ltrim:"/"|rtrim:"/"}][{else}]-[{/if}]',
                        'quantity': '1'
                    }
                ]
            }
        });
    </script>
[{/strip}]