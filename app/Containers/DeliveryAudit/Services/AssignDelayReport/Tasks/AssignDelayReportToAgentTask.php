<?php

namespace App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Ship\Adapter\Redis\RedisAdapter;

class AssignDelayReportToAgentTask
{
    protected DelayReportRepositoryInterface $delayReportRepository;

    protected RedisAdapter $redisAdapter;

    public function __construct(DelayReportRepositoryInterface $delayReportRepository, RedisAdapter $redisAdapter)
    {
        $this->delayReportRepository = $delayReportRepository;
        $this->redisAdapter = $redisAdapter;
    }

    /**
     * @param DelayReport $delayReport
     * @param int $agentId
     * @return void
     */
    public function run(DelayReport $delayReport, int $agentId): void
    {
        $this->delayReportRepository->assignAgent($delayReport->id, $agentId);

        $this->redisAdapter->lpop('report_queues');
        $this->redisAdapter->srem('report_queue_members', $delayReport->id);
    }
}
