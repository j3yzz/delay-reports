<?php

namespace App\Containers\Agent\Facades;

use App\Containers\Agent\Contracts\Services\Facade\AgentManagerInterface;
use App\Ship\Facades\Facade;

/**
 *
 * @method static findAgentById(int $agentId)
 *
 * @see AgentManagerInterface
 */
class Agent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AgentManagerInterface::class;
    }
}
