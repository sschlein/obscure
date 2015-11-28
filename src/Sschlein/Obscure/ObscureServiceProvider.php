<?php namespace Sschlein\Obscure;

/**
 * This file is part of Obscure
 *
 * @license MIT
 * @package Obscure
 */

use Illuminate\Support\ServiceProvider;

class ObscureServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Publish Teamwork configuration
     */
    protected function publishConfig()
    {
        // Publish config files
        $this->publishes( [
            __DIR__ . '/../../config/config.php' => config_path( 'obscure.php' ),
        ] );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerObscure();
        $this->registerFacade();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    protected function registerObscure()
    {
        $this->app->bind('obscure', function($app) {
            return new Obscure($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Obscure', 'Sschlein\Obscure\Facades\Obscure');
        });
    }

    /**
     * Merges user's and teamwork's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'obscure'
        );
    }
}
