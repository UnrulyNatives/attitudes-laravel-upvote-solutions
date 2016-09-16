<?php
namespace Unrulynatives\Attitudes;
// namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AttitudesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'attitudes');


        $this->publishes([

        // publish  migrations to the app's app/Http/Controllers folder
            __DIR__.'/attitudes_model' => base_path('app/Models'),


        // publish  controllers to the app's app/Http/Controllers folder
            __DIR__.'/attitudes_controller' => base_path('app/Http/Controllers'),



        ], 'app');



        // publishing the basic views
        $this->publishes([
        // publish  templates to your `resources/views` location
            __DIR__.'/attitudes_views' => base_path('resources/views/userattitudes'),

            __DIR__.'/views' => base_path('resources/views/vendor/unrulynatives/attitudes'),
        ], 'views');






        $this->publishes([
        // publish migrations for all registered packages 
            __DIR__.'/attitudes_migrations' => base_path('database/migrations')


        ], 'migrations');


        $this->publishes([
            // publish seeds for all registered packages 
            __DIR__.'/attitudes_seeds' => base_path('database/seeds'),
        ], 'seeds');


        $this->publishes([
        // publish  public folder content: css and js
        // Public
            __DIR__.'/../public' => public_path(''),
        ], 'publicassets');







    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Unrulynatives\Attitudes\AttitudesController');
    }
}
