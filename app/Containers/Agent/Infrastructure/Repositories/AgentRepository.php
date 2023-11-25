<?php

namespace App\Containers\Agent\Infrastructure\Repositories;

use App\Containers\Agent\Contracts\Repositories\AgentRepositoryInterface;
use App\Containers\Agent\Models\Agent;

class AgentRepository implements AgentRepositoryInterface
{

    public function findById(int $agentId): ?Agent
    {
        return Agent::query()
            ->where('id', $agentId)
            ->first();
    }
}
