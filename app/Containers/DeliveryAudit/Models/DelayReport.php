<?php

namespace App\Containers\DeliveryAudit\Models;

use App\Containers\Delivery\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Containers\DeliveryAudit\Database\factories\DelayReportFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelayReport extends Model
{
    use HasFactory;

    const APPROACH_ADD_TO_QUEUE = 'ADD_TO_QUEUE';
    const APPROACH_RETURN_NEW_ESTIMATION = 'RETURN_NEW_ESTIMATION';
    const APPROACH_TYPES = [self::APPROACH_ADD_TO_QUEUE, self::APPROACH_RETURN_NEW_ESTIMATION];

    const STATUS_FINISHED = 'FINISHED';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_PENDING = 'PENDING';
    const STATUSES = [self::STATUS_FINISHED, self::STATUS_IN_PROGRESS, self::STATUS_PENDING];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id',
        'approach_type',
        'status',
        'agent_id',
        'agent_description',
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
}
