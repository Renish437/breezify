<?php

namespace CodesRen\Breezify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'breezify:install {stack=blade : The frontend stack (blade)}';
    protected $description = 'Install the Breezify package scaffolding';

    public function handle()
    {
        $stack = $this->argument('stack');

        if ($stack !== 'blade') {
            $this->error('Only the Blade stack is currently supported.');
            return 1;
        }

        // Publish package resources
        Artisan::call('vendor:publish', [
            '--tag' => 'breezify',
            '--force' => true,
        ]);

        // Publish Fortify configuration
        Artisan::call('vendor:publish', [
            '--provider' => 'Laravel\\Fortify\\FortifyServiceProvider',
            '--force' => true,
        ]);

        // Enable Fortify features
        $this->enableFortifyFeatures();

        // Append route include to web.php
        $this->appendToWebRoutes();

        // Install Blade stack
        $this->installBladeStack();

        // Run migrations
        Artisan::call('migrate');

        $this->info('Breezify installed successfully!');

        return 0;
    }

    protected function enableFortifyFeatures()
    {
        $configPath = config_path('fortify.php');
        if (File::exists($configPath)) {
            $config = File::get($configPath);
            // Enable features like profile updates and account deletion
            $features = [
                'Features::registration()',
                'Features::resetPasswords()',
                'Features::emailVerification()',
                'Features::updateProfileInformation()',
                'Features::updatePasswords()',
                'Features::twoFactorAuthentication()',
            ];
            $featuresString = '[' . implode(', ', $features) . ']';
            $config = preg_replace(
                "/'features' => \[[^\]]*\]/",
                "'features' => $featuresString",
                $config
            );
            File::put($configPath, $config);
            $this->info('Enabled Fortify features in config/fortify.php');
        }
    }

    protected function appendToWebRoutes()
    {
        $webRoutesPath = base_path('routes/web.php');
        $routeInclude = "\nrequire __DIR__.'/auth.php';\n";

        // Check if the include statement already exists
        if (File::exists($webRoutesPath) && !str_contains(File::get($webRoutesPath), "require __DIR__.'/auth.php';")) {
            File::append($webRoutesPath, $routeInclude);
            $this->info('Added auth routes to routes/web.php');
        } else {
            $this->info('Auth routes already included in routes/web.php');
        }
    }

    protected function installBladeStack()
    {
        $this->info('Installing npm dependencies and compiling assets...');
        exec('npm install && npm run build');
        $this->info('Blade stack installed. Breezify UI is ready!');
    }
}