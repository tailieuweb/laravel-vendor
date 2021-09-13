<?php namespace Foostart\Crawler;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL,
    Route;
use Illuminate\Http\Request;
use Foostart\Crawler\Commands\JobCommand;

class CrawlerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {

        //generate context key
//        $this->generateContextKey();

        // load view
        $this->loadViewsFrom(__DIR__ . '/Views', 'package-crawler');

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

        // public migrations
        $this->publishMigrations();

        // public seeders
        $this->publishSeeders();

        // Register commands
        $this->registerCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/Routes/crawlers.php';
        include __DIR__ . '/Routes/stackoverflow.php';
        include __DIR__ . '/Routes/works_jobs.php';
        include __DIR__ . '/Routes/works_categories.php';
    }

    /**
     * Public config to system
     * @source: vendor/foostart/package-crawler/config
     * @destination: config/
     */
    protected function publishConfig() {
        $this->publishes([
            __DIR__ . '/config/package-crawler.php' => config_path('package-crawler.php'),
                ], 'config');
    }

    /**
     * Public language to system
     * @source: vendor/foostart/package-crawler/lang
     * @destination: resources/lang
     */
    protected function publishLang() {
        $this->publishes([
            __DIR__ . '/lang' => base_path('resources/lang'),
        ]);
    }

    /**
     * Public view to system
     * @source: vendor/foostart/package-crawler/Views
     * @destination: resources/views/vendor/package-crawler
     */
    protected function publishViews() {

        $this->publishes([
            __DIR__ . '/Views' => base_path('resources/views/vendor/package-crawler'),
        ]);
    }

    protected function publishAssets() {
        $this->publishes([
            __DIR__ . '/public' => public_path('packages/foostart/package-crawler'),
        ]);
    }

    /**
     * Publish migrations
     * @source: foostart/package-crawler/database/migrations
     * @destination: database/migrations
     */
    protected function publishMigrations() {
        $this->publishes([
            __DIR__ . '/database/migrations' => $this->app->databasePath() . '/migrations',
        ]);
    }

    /**
     * Publish seeders
     * @source: foostart/package-crawler/database/seeders
     * @destination: database/seeders
     */
    protected function publishSeeders() {
        $this->publishes([
            __DIR__ . '/database/seeders' => $this->app->databasePath() . '/seeders',
        ]);
    }

    public function registerCommands() {
        $this->app->singleton('crawler.job', function ($app) {
            return new JobCommand;
        });

        $this->commands('crawler.job');
    }

}
