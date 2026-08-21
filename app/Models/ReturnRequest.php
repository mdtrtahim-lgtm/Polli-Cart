<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReturnRequest extends Model
{
    protected $fillable = [
        'order_item_id',
        'user_id',
        'reason',
        'description',
        'images',
        'status',
        'approved_by',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public $timestamps = true;

    /**
     * Get order item
     */
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * Get user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get approved by user
     */
    public function approvedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get refund
     */
    public function refund(): HasOne
    {
        return $this->hasOne(Refund::class);
    }
}
