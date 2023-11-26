<?php

namespace App\Containers\DeliveryAudit\Tests\Unit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Exceptions\OrderHasUnfinishedDelayReportException;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\CheckUnfinishedQueueDelayReportTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckUnfinishedQueueDelayReportTaskTest extends TestCase
{
    use RefreshDatabase;

    protected $delayReportRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->delayReportRepositoryMock = $this->createMock(DelayReportRepositoryInterface::class);
    }

    /** @test */
    public function it_should_throw_exception_when_unfinished_delay_report_exists()
    {
        $this->expectException(OrderHasUnfinishedDelayReportException::class);

        $this->delayReportRepositoryMock->expects($this->once())
            ->method('unfinishedDelayReportByOrderId')
            ->willReturn(new DelayReport());

        $checkUnfinishedDelayReportTask = new CheckUnfinishedQueueDelayReportTask($this->delayReportRepositoryMock);
        $checkUnfinishedDelayReportTask->run(1);
    }

    /** @test */
    public function it_should_not_throw_exception_when_no_unfinished_delay_report_exists()
    {
        $this->delayReportRepositoryMock->expects($this->once())
            ->method('unfinishedDelayReportByOrderId')
            ->willReturn(null);

        $checkUnfinishedDelayReportTask = new CheckUnfinishedQueueDelayReportTask($this->delayReportRepositoryMock);
        $checkUnfinishedDelayReportTask->run(1);

        $this->assertTrue(true);
    }
}
