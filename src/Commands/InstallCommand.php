<?php

namespace CodesRen\Breezify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'breezify:install {stack=blade : The frontend stack (blade)}';
    protected $description = 'Install the Breezify package scaffolding';

    public function handle()
    {
        if ($this->argument('stack') !== 'blade') {
            $this->error('Only the Blade stack is currently supported.');
            return 1;
        }

        // 1. Publish all package resources (views, controllers, routes, and the new FortifyServiceProvider stub)
        Artisan::call('vendor:publish', ['--tag' => 'breezify', '--force' => true], $this->getOutput());
        
        // 2. Publish Fortify's own config and migration files
        Artisan::call('vendor:publish', ['--provider' => 'Laravel\\Fortify\\FortifyServiceProvider', '--force' => true], $this->getOutput());
        
        // 3. Register the published FortifyServiceProvider in config/app.php
        $this->registerFortifyServiceProvider();

        // 4. Enable all features in the published config/fortify.php
        $this->enableFortifyFeatures();

        // 5. Append dashboard/profile routes to routes/web.php
        $this->appendRoutes();

        // 6. Run database migrations
        $this->info('Running database migrations...');
        Artisan::call('migrate', [], $this->getOutput());
        
        // 7. Install and build Node dependencies
        $this->installNodeDependencies();

        $this->info('Breezify installed successfully! Please run "npm run dev" and visit your application.');

        return 0;
    }

    /**
     * Registers the FortifyServiceProvider in the application's config.
     */
    protected function registerFortifyServiceProvider()
    {
        $configFile = config_path('app.php');
        $content = File::get($configFile);

        if (Str::contains($content, 'App\\Providers\\FortifyServiceProvider::class')) {
            $this->line('FortifyServiceProvider already registered. Skipping.');
            return;
        }

        $this->info('Registering FortifyServiceProvider...');
        File::put($configFile, str_replace(
            "App\\Providers\\RouteServiceProvider::class,",
            "App\\Providers\\RouteServiceProvider::class,".PHP_EOL."        App\\Providers\\FortifyServiceProvider::class,",
            $content
        ));
    }

    /**
     * Replaces the 'features' array in the fortify.php config file.
     */
    protected function enableFortifyFeatures()
    {
        $this->info('Configuring Fortify features...');
        $configPath = config_path('fortify.php');

        if (!File::exists($configPath)) {
            $this->error('Fortify configuration file not found.');
            return;
        }

        $features = <<<PHP
'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirmPassword' => true,
        ]),
    ],
PHP;

        $content = File::get($configPath);
        $content = preg_replace("/'features' => \[.*?],/s", $features, $content, 1);
        File::put($configPath, $content);
    }
    
    /**
     * Appends required routes to the application's web routes file.
     */
    protected function appendRoutes()
    {
        $this->info('Adding dashboard and profile routes...');
        $routesContent = File::get(__DIR__.'/../../stubs/routes/web.php');
        
        if (!Str::contains(File::get(base_path('routes/web.php')), 'ProfileController')) {
            File::append(base_path('routes/web.php'), $routesContent);
        } else {
            $this->line('Dashboard/Profile routes already exist. Skipping.');
        }
    }

    /**
     * Installs and builds the frontend assets.
     */
    protected function installNodeDependencies()
    {
        $this->info('Installing and building Node dependencies...');

        if (File::exists(base_path('pnpm-lock.yaml'))) {
            $this->runProcess(['pnpm', 'install']);
            $this->runProcess(['pnpm', 'run', 'build']);
        } elseif (File::exists(base_path('yarn.lock'))) {
            $this->runProcess(['yarn', 'install']);
            $this->runProcess(['yarn', 'run', 'build']);
        } else {
            $this->runProcess(['npm', 'install']);
            $this->runProcess(['npm', 'run', 'build']);
        }
    }

    /**
     * Runs a command process and displays its output.
     */
    protected function runProcess(array $command)
    {
        $process = new Process($command, base_path());
        $process->setTimeout(null)->run(function ($type, $buffer) {
            $this->getOutput()->write($buffer);
        });
    }
}