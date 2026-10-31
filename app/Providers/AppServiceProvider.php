<?php

namespace App\Providers;

use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Policies\ApplicationPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\VacancyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        Gate::policy(JobCategory::class, CategoryPolicy::class);
        Gate::policy(JobVacancy::class, VacancyPolicy::class);
        Gate::policy(JobApplication::class,ApplicationPolicy::class);
    }
}
