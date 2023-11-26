<?php

namespace App\Containers\DeliveryAudit\Services\AssignDelayReport;

use App\Containers\Agent\Models\Agent;
use App\Containers\DeliveryAudit\Adapter\AgentAdapter\AgentAdapter;
use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Contracts\Service\AssignDelayReportServiceInterface;
use App\Containers\DeliveryAudit\DataTransfers\AssignReportData;
use App\Containers\DeliveryAudit\Exceptions\AgentHasPendingDelayReportException;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks\AssignDelayReportToAgentTask;
use App\Containers\DeliveryAudit\Services\AssignDelayReport\Tasks\GetFirstDelayReportTask;
use App\Ship\Exceptions\ModelNotFoundException;
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
        $agent = (new AgentAdapter())->findAgentById($data->agentId);
        if (!$agent) {
            throw (new ModelNotFoundException())->setModel(Agent::class);
        }
        /// TODO: map Agent model ($agent) to Our module Agent entity

        if ($this->delayReportRepository->hasPendingDelayReportForAgent($data->agentId)) {
            throw new AgentHasPendingDelayReportException();
        }

        $delayReport = app(GetFirstDelayReportTask::class)->run();

        DB::beginTransaction();
        try {
            app(AssignDelayReportToAgentTask::class)->run($delayReport, $data->agentId);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }

        return $this->delayReportRepository->getDelayReportDetails($delayReport->id);
    }
}
