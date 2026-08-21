<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'brand',
        'short_description',
        'description',
        'price',
        'sale_price',
        'cost_price',
        'stock',
        'low_stock_threshold',
        'unit',
        'weight',
        'featured',
        'best_seller',
        'new_product',
        'flash_sale',
        'status',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'best_seller' => 'boolean',
        'new_product' => 'boolean',
        'flash_sale' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
    ];

    /**
     * Get the category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get product images
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get variations
     */
    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Get reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get cart items
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get wishlist items
     */
    public function wishlistItems(): HasMany
    {
        return $this->hasMany(WishlistItem::class);
    }

    /**
     * Get active products
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Get best sellers
     */
    public function scopeBestSeller($query)
    {
        return $query->where('best_seller', true);
    }

    /**
     * Get new products
     */
    public function scopeNew($query)
    {
        return $query->where('new_product', true);
    }

    /**
     * Get average rating
     */
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    /**
     * Get display price (sale or regular)
     */
    public function getDisplayPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
}
