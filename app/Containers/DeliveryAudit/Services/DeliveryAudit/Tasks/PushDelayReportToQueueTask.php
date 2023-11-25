<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Ship\Adapter\Redis\RedisAdapter;

class PushDelayReportToQueueTask
{
    public function __construct(protected RedisAdapter $redisAdapter)
    {
    }

    public function run(DelayReport $delayReport): void
    {
        if (!$this->redisAdapter->isMember('report_queue_members', $delayReport->id)) {
            $this->redisAdapter->sadd('report_queue_members', $delayReport->id);
            $this->redisAdapter->rpush('report_queues', json_encode(['delay_report_id' => $delayReport->id]));
        }
    }
}
