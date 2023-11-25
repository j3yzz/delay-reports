<?php

namespace App\Containers\Agent\Providers;

use App\Containers\Agent\Contracts\Repositories\AgentRepositoryInterface;
use App\Containers\Agent\Infrastructure\Repositories\AgentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(AgentRepositoryInterface::class, AgentRepository::class);
    }
}
