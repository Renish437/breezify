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
                // Publish the FortifyServiceProvider stub
                __DIR__.'/../../stubs/App/Providers/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),

                // Publish Controllers
                __DIR__.'/../../stubs/App/Http/Controllers' => app_path('Http/Controllers'),

                // Publish Auth routes
                __DIR__.'/../../stubs/routes/auth.php' => base_path('routes/auth.php'),
                
                // Publish Views
                __DIR__.'/../../stubs/resources/views' => resource_path('views'),
                
                // Publish frontend assets
                __DIR__.'/../../stubs/resources/css' => resource_path('css'),
                __DIR__.'/../../stubs/resources/js' => resource_path('js'),
                __DIR__.'/../../stubs/tailwind.config.js' => base_path('tailwind.config.js'),
                __DIR__.'/../../stubs/postcss.config.js' => base_path('postcss.config.js'),
                __DIR__.'/../../stubs/vite.config.js' => base_path('vite.config.js'),
                
            ], 'breezify');
        }
    }
}