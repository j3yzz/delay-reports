<?php

namespace App\Containers\DeliveryAudit\Tests\Unit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\IsDeliveryTimePassTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IsDeliveryTimePassTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @var IsDeliveryTimePassTask */
    protected $isDeliveryTimePassTask;

    protected function setUp(): void
    {
        parent::setUp();

        $this->isDeliveryTimePassTask = new IsDeliveryTimePassTask();
    }

    /** @test */
    public function it_should_throw_exception_when_delivery_time_not_past()
    {
        $this->expectException(\App\Containers\DeliveryAudit\Exceptions\DeliveryTimeNotPastException::class);

        $this->isDeliveryTimePassTask->run(now()->subMinutes(50), 55);
    }

    /** @test */
    public function it_should_not_throw_exception_when_delivery_time_past()
    {
        $this->isDeliveryTimePassTask->run(now()->subMinutes(50), 45);
        $this->assertTrue(true);
    }
}
