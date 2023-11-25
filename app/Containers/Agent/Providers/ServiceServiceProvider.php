<?php

namespace App\Containers\Agent\Providers;

use App\Containers\Agent\Contracts\Services\Facade\AgentManagerInterface;
use App\Containers\Agent\Services\Facade\AgentManager;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(AgentManagerInterface::class, AgentManager::class);
    }
}
