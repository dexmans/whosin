<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any necessary services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\DateEntry::observe(new \App\Observers\DateEntryObserver);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
