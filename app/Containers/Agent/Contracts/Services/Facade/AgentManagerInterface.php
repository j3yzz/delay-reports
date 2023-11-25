<?php

namespace App\Containers\Agent\Contracts\Services\Facade;


use App\Containers\Agent\Models\Agent;

interface AgentManagerInterface
{
    public function findAgentById(int $agentId): ?Agent;

}
