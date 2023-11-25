<?php

namespace App\Containers\DeliveryAudit\Services\AssignDelayReport;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Contracts\Service\AssignDelayReportServiceInterface;
use App\Containers\DeliveryAudit\DataTransfers\AssignReportData;
use App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks\AssignDelayReportToAgentTask;
use App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks\GetFirstDelayReportTask;
use Illuminate\Support\Facades\DB;

class AssignDelayReportService implements AssignDelayReportServiceInterface
{

    protected DelayReportRepositoryInterface $delayReportRepository;

    public function __construct(DelayReportRepositoryInterface $delayReportRepository)
    {
        $this->delayReportRepository = $delayReportRepository;
    }

    public function execute(AssignReportData $data)
    {
        /// check agent is existing?

        $delayReport = app(GetFirstDelayReportTask::class)->run();

        DB::beginTransaction();
        try {
            app(AssignDelayReportToAgentTask::class)->run($delayReport, $data->agentId);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }

        return $this->delayReportRepository->getDelayReportDetails(21);
    }
}
