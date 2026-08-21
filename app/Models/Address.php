<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'mobile',
        'division',
        'district',
        'upazila',
        'area',
        'address',
        'postal_code',
        'type',
        'default',
    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    public $timestamps = true;

    /**
     * Get user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
