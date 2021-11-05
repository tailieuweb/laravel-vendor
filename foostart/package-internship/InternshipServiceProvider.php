<?php

namespace Foostart\Internship;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL,
    Route;
use Illuminate\Http\Request;

class InternshipServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {

        //generate context key
//        $this->generateContextKey();

        // load view
        $this->loadViewsFrom(__DIR__ . '/Views', 'package-internship');

        // include view composers
        require __DIR__ . "/composers.php";

        // publish config
        $this->publishConfig();

        // publish lang
        $this->publishLang();

        // publish views
        //$this->publishViews();

        // publish assets
        $this->publishAssets();

        // publish migration
        $this->publishMigrations();

        // public seeders
        $this->publishSeeders(__DIR__);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/Routes/internship.php';
    }

    /**
     * Public config to system
     * @source: vendor/foostart/package-internship/config
     * @destination: config/
     */
    protected function publishConfig() {
        $this->publishes([
            __DIR__ . '/config/package-internship.php' => config_path('package-internship.php'),
                ], 'config');
    }

    /**
     * Public language to system
     * @source: vendor/foostart/package-internship/lang
     * @destination: resources/lang
     */
    protected function publishLang() {
        $this->publishes([
            __DIR__ . '/lang' => base_path('resources/lang'),
        ]);
    }

    /**
     * Public view to system
     * @source: vendor/foostart/package-internship/Views
     * @destination: resources/views/vendor/package-internship
     */
    protected function publishViews() {

        $this->publishes([
            __DIR__ . '/Views' => base_path('resources/views/vendor/package-internship'),
        ]);
    }

    protected function publishAssets() {
        $this->publishes([
            __DIR__ . '/public' => public_path('packages/foostart/package-internship'),
        ]);
    }

    protected function publishMigrations()
    {

        $this->publishes([
                                 __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations',
                         ]);
    }

    /**
     * Publish seeders
     * @source: foostart/package-internship/database/seeders
     * @destination: database/seeders
     */
    protected function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/database/seeders' => $this->app->databasePath() . '/seeders',
        ]);
    }

}
