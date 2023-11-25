<?php

namespace App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Exceptions\DelayReportNotExistsException;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Ship\Adapter\Redis\RedisAdapter;
use App\Ship\Exceptions\ModelNotFoundException;

class GetFirstDelayReportTask
{
    protected RedisAdapter $redisAdapter;

    protected DelayReportRepositoryInterface $delayReportRepository;

    public function __construct(RedisAdapter $redisAdapter, DelayReportRepositoryInterface $delayReportRepository)
    {
        $this->redisAdapter = $redisAdapter;
        $this->delayReportRepository = $delayReportRepository;
    }

    /**
     * @return DelayReport
     * @throws DelayReportNotExistsException
     */
    public function run(): DelayReport
    {
        $firstDelayReport = $this->redisAdapter->lindex('report_queues', 0);

        if (! $firstDelayReport) {
            throw new DelayReportNotExistsException();
        }

        $delayReportId = json_decode($firstDelayReport)->delay_report_id;

        $delayReport = $this->delayReportRepository->findPendingDelayReportWithNullAgent($delayReportId);

        if (! $delayReport) {
            throw (new ModelNotFoundException())->setModel(DelayReport::class);
        }

        return $delayReport;
    }
}
