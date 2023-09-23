<?php

use App\Models\Product;

if (!function_exists('product')) {
    function product() {
        return new Product();
    }
}
