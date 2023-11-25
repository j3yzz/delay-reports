<?php

namespace App\Containers\DeliveryAudit\Adapter\AgentAdapter;

use App\Containers\Agent\Facades\Agent;

class AgentAdapter
{
    public function findAgentById(int $agentId)
    {
        return Agent::findAgentById($agentId);
    }
}
