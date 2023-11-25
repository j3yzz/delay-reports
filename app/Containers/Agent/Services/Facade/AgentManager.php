<?php

namespace App\Containers\Agent\Services\Facade;

use App\Containers\Agent\Contracts\Repositories\AgentRepositoryInterface;
use App\Containers\Agent\Contracts\Services\Facade\AgentManagerInterface;
use App\Containers\Agent\Models\Agent;

class AgentManager implements AgentManagerInterface
{
    protected AgentRepositoryInterface $agentRepository;

    public function __construct(AgentRepositoryInterface $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    public function findAgentById(int $agentId): ?Agent
    {
        return $this->agentRepository->findById($agentId);
    }
}
