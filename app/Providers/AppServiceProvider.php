<?php

namespace App\Providers;

use App\Models\Candidature;
use App\Models\Mission;
use App\Models\Review;
use App\Observers\ReviewObserver;
use App\Policies\CandidaturePolicy;
use App\Policies\MissionPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    protected $policies = [
        Mission::class => MissionPolicy::class,
        Candidature::class => CandidaturePolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Review::observe(ReviewObserver::class);
    }
}
