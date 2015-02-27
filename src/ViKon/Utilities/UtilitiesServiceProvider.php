<?php namespace ViKon\Utilities;

use Illuminate\Support\ServiceProvider;

class UtilitiesServiceProvider extends ServiceProvider {

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
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'utilities');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }
}
