<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock',
        'unit',
    ];

    public $timestamps = true;

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
