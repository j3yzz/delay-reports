<?php

namespace App\Containers\DeliveryAudit\Infrastructure\Repositories;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Models\DelayReport;

class DelayReportRepository implements DelayReportRepositoryInterface
{

    public function create(array $attributes = []): DelayReport
    {
        return DelayReport::query()->create($attributes);
    }

    public function unfinishedDelayReportByOrderId(int $orderId): ?DelayReport
    {
        return DelayReport::query()
            ->where('order_id', $orderId)
            ->where('status', '!=', DelayReport::STATUS_FINISHED)
            ->orderBy('id', 'DESC')
            ->first();

    }

    public function firstUnfinishedQueueDelayReport(int $orderId): ?DelayReport
    {
        return DelayReport::query()
            ->where([
                'approach_type' => DelayReport::APPROACH_ADD_TO_QUEUE,
                'order_id' => $orderId,
                ['status', '!=', DelayReport::STATUS_FINISHED],
            ])->first();
    }

    public function findPendingDelayReportWithNullAgent(int $delayReportId): ?DelayReport
    {
        return DelayReport::query()->where([
            'id' => $delayReportId,
            'agent_id' => null,
            'status' => DelayReport::STATUS_PENDING,
        ])->first();
    }

    public function assignAgent(int $delayReportId, int $agentId)
    {
        return DelayReport::query()
            ->where([
                'id' => $delayReportId,
            ])
            ->update([
                'agent_id' => $agentId,
                'status' => DelayReport::STATUS_IN_PROGRESS,
            ]);
    }

    public function getDelayReportDetails(int $delayReportId)
    {
        return DelayReport::query()
            ->select([
                "delay_reports.id     as delay_report_id",
                "delay_reports.status as delay_report_status",
                "delay_reports.agent_description",
                "users.id             as user_id",
                "users.name           as user_name",
                "users.phone_number   as user_phone_number",
                "vendors.id           as vendor_id",
                "vendors.phone_number as vendor_phone_number",
                "trips.status         as trip_status",
                "trips.driver_id      as trip_driver_id",
                "drivers.phone_number as driver_phone_number",
            ])
            ->where([
                'delay_reports.id' => $delayReportId,
            ])
            ->join('orders', 'orders.id', '=', 'delay_reports.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('vendors', 'vendors.id', '=', 'orders.vendor_id')
            ->leftJoin('trips', 'trips.order_id', '=', 'orders.id')
            ->leftJoin('drivers', 'drivers.id', '=', 'trips.driver_id')
            ->first();
    }
}
