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
        \App\Models\User::observe(new \App\Observers\UserObserver(
            app(\Illuminate\Contracts\Hashing\Hasher::class)
        ));
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
