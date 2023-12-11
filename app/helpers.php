<?php

use App\Domains\Product\Models\Product;



//     require_once app_path('Helpers/Global/GeneralHelper.php');
//     require_once app_path('Helpers/Global/HtmlHelper.php');
//     require_once app_path('Helpers/Global/LocaleHelper.php');
//     require_once app_path('Helpers/Global/SystemHelper.php');
//     require_once app_path('Helpers/Global/TimezoneHelper.php');
//     require_once app_path('Helpers/Global/UrlDecodeHelper.php');


if (!function_exists('product')) {
    function product() {
        return new Product();
    }
}