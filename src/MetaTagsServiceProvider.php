<?php

namespace SimonMarcelLinden\LaravelMetaTags;

use Illuminate\Support\ServiceProvider;

class MetaTagsServiceProvider extends ServiceProvider {
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void {
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
    public function register(): void {
        $this->mergeConfigFrom(__DIR__ . '/../config/metatags.php', 'metatags');

        // Register the service the package provides.
        $this->app->singleton('metatag', function ($app) {
            return new MetaTag(
                $app['request'],
                $app['config']['metatags'],
                $app['config']->get('app.locale')
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['metatag'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/metatags.php' => config_path('metatags.php'),
        ], 'metatags.config');
    }
}
