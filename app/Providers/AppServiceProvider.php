<?php

namespace App\Providers;

use App\Http\Interfaces\CardRepositoryInterface;
use App\Http\Interfaces\CardServiceInterface;
use App\Http\Interfaces\CommanderRepositoryInterface;
use App\Http\Interfaces\CommanderServiceInterface;
use App\Http\Interfaces\NewsletterRepositoryInterface;
use App\Http\Interfaces\NewsletterServiceInterface;
use App\Http\Interfaces\StapleRepositoryInterface;
use App\Http\Interfaces\StapleServiceInterface;
use App\Http\Repositories\CardRepository;
use App\Http\Repositories\CommanderRepository;
use App\Http\Repositories\NewsletterRepository;
use App\Http\Repositories\StapleRepository;
use App\Http\Services\CardService;
use App\Http\Services\CommanderService;
use App\Http\Services\NewsletterService;
use App\Http\Services\StapleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StapleRepositoryInterface::class, StapleRepository::class);
        $this->app->bind(StapleServiceInterface::class, StapleService::class);

        $this->app->bind(CommanderRepositoryInterface::class, CommanderRepository::class);
        $this->app->bind(CommanderServiceInterface::class, CommanderService::class);

        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(CardServiceInterface::class, CardService::class);

        $this->app->bind(NewsletterRepositoryInterface::class, NewsletterRepository::class);
        $this->app->bind(NewsletterServiceInterface::class, NewsletterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
