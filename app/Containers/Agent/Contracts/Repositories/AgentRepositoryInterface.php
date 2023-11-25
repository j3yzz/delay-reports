<?php

namespace App\Containers\Agent\Contracts\Repositories;

use App\Containers\Agent\Models\Agent;

interface AgentRepositoryInterface
{
    public function findById(int $agentId): ?Agent;
}
