<?php

namespace App\Containers\DeliveryAudit\Tests\Unit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Entities\Order;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\CheckUnfinishedQueueDelayReportTask;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\GenerateDelayReportTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateDelayReportTaskTest extends TestCase
{
    use RefreshDatabase;

    protected $delayReportRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->delayReportRepositoryMock = $this->createMock(DelayReportRepositoryInterface::class);
    }

    /** @test */
    public function it_should_generate_delay_report()
    {
        $this->delayReportRepositoryMock->expects($this->once())
            ->method('unfinishedDelayReportByOrderId')
            ->willReturn(null);

        $this->delayReportRepositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new DelayReport());

        $order = new Order(1, 1, 2, now()->subMinutes(50)->toDateTimeString(), 45, \App\Containers\Delivery\Models\Order::STATUS_PENDING);

        $generateDelayReportTask = new GenerateDelayReportTask($this->delayReportRepositoryMock);
        $result = $generateDelayReportTask->run($order, DelayReport::APPROACH_RETURN_NEW_ESTIMATION);

        $this->assertInstanceOf(DelayReport::class, $result);
    }
}
