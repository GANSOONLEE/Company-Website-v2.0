<?php

namespace App\Domains\Cart\Models\Traits\Method;

// Model
use App\Domains\Product\Models\Product;

// Laravel Support
use Illuminate\Support\Facades\Storage;

trait CartMethod
{
    /**
     * Get product image path for cart
     * @return string
     */
    public function getImage(): string
    {
        $productCode = $this->productBrand()->first()->product_code;
        $product = Product::where('product_code', $productCode)->first();
        $category = $product->product_category;

        // Build directory path
        $disk = "public";
        $directory = "product/$category/$productCode";

        // Get all images
        $images = Storage::disk($disk)->files($directory);

        // Filter the image name with "cover"
        $key = array_filter($images, function ($image) use ($directory) {
            return strpos($image, "$directory/cover") !== false;
        });

        return "storage/$directory/" . basename(reset($key));

    }
}