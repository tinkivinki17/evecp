<?php
function validateGet()
{
    $keys = array(
        'regionFrom',
        'regionTo',
        'shipVolume',
        'minProfit',
        'tax',
        'limit',
        'itemProfit',
        'minPrice',
        'maxPrice',
        'clearPrices'
    );

    foreach ($keys as $key) {
        if (!isset($_GET[$key])) {
            return false;
        }
    }

    return true;
}

function fVal($value)
{
    return number_format($value, 2) . ' ISK';
}