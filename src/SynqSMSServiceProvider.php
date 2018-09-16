<?php

namespace CraftedSystems\Synq;

use Illuminate\Support\ServiceProvider;

class SynqSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/Config/synq.php' => config_path('synq.php'),
        ], 'synq_config');

        $this->app->singleton(SynqSMS::class, function () {
            return new SynqSMS(config('synq'));
        });

        $this->app->alias(SynqSMS::class, 'synq-sms');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/synq.php', 'synq-sms'
        );
    }
}
