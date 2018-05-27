<?php

namespace Bantenprov\HasilSeleksi;

use Illuminate\Support\ServiceProvider;
use Bantenprov\HasilSeleksi\Console\Commands\HasilSeleksiCommand;

/**
 * The HasilSeleksiServiceProvider class
 *
 * @package Bantenprov\HasilSeleksi
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class HasilSeleksiServiceProvider extends ServiceProvider
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
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
        $this->publicHandle();
        $this->seedHandle();
        $this->publishHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hasil-seleksi', function ($app) {
            return new HasilSeleksi;
        });

        $this->app->singleton('command.hasil-seleksi', function ($app) {
            return new HasilSeleksiCommand;
        });

        $this->commands('command.hasil-seleksi');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'hasil-seleksi',
            'command.hasil-seleksi',
        ];
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle($publish = '')
    {
        $packageConfigPath = __DIR__.'/config';
        $appConfigPath     = config_path('bantenprov/hasil-seleksi');

        $this->mergeConfigFrom($packageConfigPath.'/hasil-seleksi.php', 'hasil-seleksi');

        $this->publishes([
            $packageConfigPath.'/hasil-seleksi.php' => $appConfigPath.'/hasil-seleksi.php',
        ], $publish ? $publish : 'hasil-seleksi-config');
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle($publish = '')
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'hasil-seleksi');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/hasil-seleksi'),
        ], $publish ? $publish : 'hasil-seleksi-lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle($publish = '')
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'hasil-seleksi');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/hasil-seleksi'),
        ], $publish ? $publish : 'hasil-seleksi-views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle($publish = '')
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => resource_path('assets'),
        ], $publish ? $publish : 'hasil-seleksi-assets');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle($publish = '')
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], $publish ? $publish : 'hasil-seleksi-migrations');
    }

    /**
     * Publishing package's publics (JavaScript, CSS, images...)
     *
     * @return void
     */
    public function publicHandle($publish = '')
    {
        $packagePublicPath = __DIR__.'/public';

        $this->publishes([
            $packagePublicPath => base_path('public')
        ], $publish ? $publish : 'hasil-seleksi-public');
    }

    /**
     * Publishing package's seeds
     *
     * @return void
     */
    public function seedHandle($publish = '')
    {
        $packageSeedPath = __DIR__.'/database/seeds';

        $this->publishes([
            $packageSeedPath => base_path('database/seeds')
        ], $publish ? $publish : 'hasil-seleksi-seeds');
    }

    /**
     * Publishing package's all files
     *
     * @return void
     */
    public function publishHandle()
    {
        $publish = 'hasil-seleksi-publish';

        $this->routeHandle($publish);
        $this->configHandle($publish);
        $this->langHandle($publish);
        $this->viewHandle($publish);
        $this->assetHandle($publish);
        // $this->migrationHandle($publish);
        $this->publicHandle($publish);
        // $this->seedHandle($publish);
    }
}
