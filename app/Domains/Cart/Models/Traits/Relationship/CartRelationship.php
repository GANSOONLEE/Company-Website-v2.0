<?php

namespace App\Domains\Cart\Models\Traits\Relationship;

// Model
use App\Domains\Auth\Models\User;
use App\Domains\Product\Models\Product;

// Laravel Support
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB;

trait CartRelationship
{
    
    /**
     * Get user relationship for user instance
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'user_email');
    }

    /**
     * Get product relationship for product instance
     * @return EloquentBuilder
     */
    public function product(): EloquentBuilder
    {
        return Product::where('product_code', $this->productBrand()->first()->product_code);
    }

    /**
     * Get product name relationship for product instance
     * @return Builder
     */
    public function productName(): Builder
    {
        $productCode = $this->productBrand()->first()->product_code;
        return DB::table('products_name')
            ->where('product_code', $productCode);
    }

    /**
     * Get product brand relationship for product instance
     * @return Builder
     */
    public function productBrand(): Builder
    {
        return DB::table('products_brand')
                ->where('code', $this->sku_id);
    }

}