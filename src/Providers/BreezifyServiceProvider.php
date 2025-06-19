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

            $this->publishes([

                // Provider
                __DIR__.'/../../stubs/App/Providers/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
                
                // Controller (Now correctly publishes only the simple ProfileController)
                __DIR__.'/../../stubs/App/Http/Controllers/ProfileController.php' => app_path('Http/Controllers/ProfileController.php'),

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