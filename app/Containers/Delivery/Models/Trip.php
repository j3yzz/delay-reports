<?php

namespace App\Containers\Delivery\Models;

use App\Containers\Driver\Models\Driver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;
    // DELIVERED, PICKED, AT_VENDOR, ASSIGNED
    const STATUS_DELIVERED = 'DELIVERED';
    const STATUS_PICKED = 'PICKED';
    const STATUS_AT_VENDOR = 'AT_VENDOR';
    const STATUS_ASSIGNED = 'ASSIGNED';
    const STATUSES = [
        self::STATUS_DELIVERED,
        self::STATUS_PICKED,
        self::STATUS_AT_VENDOR,
        self::STATUS_ASSIGNED,
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id',
        'driver_id',
        'status',
        'start_time',
        'end_time',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
