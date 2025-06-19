<?php

namespace CodesRen\Breezify\Providers;

use Illuminate\Support\ServiceProvider;
use CodesRen\Breezify\Commands\InstallCommand;

class BreezifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
                // Tell Laravel to load your package's migrations
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
            $this->publishes([

                 __DIR__.'/../../stubs/package.json' => base_path('package.json'),

                // Provider
                __DIR__.'/../../stubs/App/Providers/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
                
                // Controller (Now correctly publishes only the simple ProfileController)
                __DIR__.'/../../stubs/App/Http/Controllers/ProfileController.php' => app_path('Http/Controllers/ProfileController.php'),

                // App Layout
                __DIR__.'/../../stubs/App/View/Components/AppLayout.php' => app_path('View/Components/AppLayout.php'),
                
                //This is the guest layout
                __DIR__.'/../../stubs/App/View/Components/GuestLayout.php' => app_path('View/Components/GuestLayout.php'),

                // Routes (Publishes the dedicated auth.php file)
                __DIR__.'/../../stubs/routes/auth.php' => base_path('routes/auth.php'),
                
                // Views and Assets
                __DIR__.'/../../stubs/resources/views' => resource_path('views'),
                __DIR__.'/../../stubs/resources/css' => resource_path('css'),
                __DIR__.'/../../stubs/resources/js' => resource_path('js'),
                __DIR__.'/../../stubs/tailwind.config.js' => base_path('tailwind.config.js'),
                __DIR__.'/../../stubs/postcss.config.js' => base_path('postcss.config.js'),
                __DIR__.'/../../stubs/vite.config.js' => base_path('vite.config.js'),
                
            ], 'breezify');
        }
    }
}