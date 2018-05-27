<?php namespace Bantenprov\HasilSeleksi;

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
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
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
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('hasil-seleksi.php');

        $this->mergeConfigFrom($packageConfigPath, 'hasil-seleksi');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'hasil-seleksi');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/hasil-seleksi'),
        ], 'lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/views';

        $this->loadViewsFrom($packageViewsPath, 'hasil-seleksi');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/hasil-seleksi'),
        ], 'views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/resources/assets';

        $this->publishes([
            $packageAssetsPath => public_path('vendor/hasil-seleksi'),
        ], 'public');
    }
}
