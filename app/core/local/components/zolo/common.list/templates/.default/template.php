<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo "<pre>";
//echo print_r($arResult);
?>
<script>
    const IBLOCK_ID = <?=$arResult['IBLOCK_ID']?>;
    let offset = <?=$arResult['OFFSET']?>;
    window.onload = function () {
        loadElementsButton.onclick = function() {
            BX.ajax.runComponentAction('zolo:common.list', 'load', {
                mode: 'class',
                data: {
                    offset: offset,
                    iblock_id: IBLOCK_ID
                }
            }).then(function (response) {
                add(response['data']['ITEMS']);
                offset = response['data']['OFFSET'];
            }, function (response) {
                alert(response['status']);
            });
        };
    }

    function add(items) {
        let s = 'ghbdtn';
        items.forEach(function(item, i, ar) {
            (Object.keys(item)).forEach(function (key, j, row) {
                s += key + '->' + Object.values(i);
            });
            s += '<br>';
        });
        document.getElementById('items').innerHTML += s;
    }
</script>

<button id="loadElementsButton" type="button">Показать еще</button>
<div id="items">
    <pre>
    <?=print_r($arResult['ITEMS'],true);?>
</div>


