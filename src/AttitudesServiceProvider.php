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
            __DIR__.'/views' => base_path('resources/views/vendor/unrulynatives/attitudes'),

        // publish  migrations to the app's app/Http/Controllers folder
            __DIR__.'/attitudes_model' => base_path('app/Models'),

        // publish  migrations to the app's app/Http/Controllers folder
            __DIR__.'/attitudes_controller' => base_path('app/Http/Controller'),

        // publish  Models to the app's app/Http/Controllers folder
            __DIR__.'/attitudes_migrations' => base_path('database/migrations'),
        ]);



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
