<?php

namespace SimonMarcelLinden\LaravelMetaTags;

use Illuminate\Support\ServiceProvider;

class LaravelMetaTagsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simonmarcellinden');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'simonmarcellinden');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelmetatags.php', 'laravelmetatags');

        // Register the service the package provides.
        $this->app->singleton('laravelmetatags', function ($app) {
            return new LaravelMetaTags;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelmetatags'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelmetatags.php' => config_path('laravelmetatags.php'),
        ], 'laravelmetatags.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/simonmarcellinden'),
        ], 'laravelmetatags.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/simonmarcellinden'),
        ], 'laravelmetatags.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/simonmarcellinden'),
        ], 'laravelmetatags.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
