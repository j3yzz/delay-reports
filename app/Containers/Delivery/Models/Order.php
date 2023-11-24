<?php

namespace App\Containers\Delivery\Models;

use App\Containers\User\Models\User;
use App\Containers\Vendor\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING_VENDOR_APPROVAL = 'PENDING_VENDOR_APPROVAL';
    const STATUS_PENDING = 'PENDING';
    const STATUS_DELIVERED = 'DELIVERED';
    const STATUS_DELAYED = 'DELAYED';
    const STATUSES = [
        self::STATUS_PENDING_VENDOR_APPROVAL,
        self::STATUS_DELAYED,
        self::STATUS_PENDING,
        self::STATUS_DELIVERED
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'vendor_id',
        'ordered_at',
        'delivery_time',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
