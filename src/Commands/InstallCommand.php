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

        if (!File::exists($configPath)) {
            $this->error('Fortify configuration file not found at ' . $configPath);
            return;
        }

        // Define the desired Fortify features
        $features = [
            'Features::registration()',
            'Features::resetPasswords()',
            'Features::emailVerification()',
            'Features::updateProfileInformation()',
            'Features::updatePasswords()',
            'Features::twoFactorAuthentication()',
        ];

        // Read the existing config file
        $configContent = File::get($configPath);

        // Format the features array with proper indentation
        $featuresString = "[\n";
        foreach ($features as $index => $feature) {
            $featuresString .= "        $feature" . ($index < count($features) - 1 ? "," : "") . "\n";
        }
        $featuresString .= "    ]";

        // Replace the 'features' array in the config
        $newConfigContent = preg_replace(
            "/'features' => \[[^\]]*?\],/",
            "'features' => $featuresString,",
            $configContent
        );

        // If no replacement was made, inform the user
        if ($newConfigContent === $configContent) {
            $this->warn('Could not update Fortify features in config/fortify.php. Please manually add:');
            $this->line("'features' => $featuresString");
            return;
        }

        // Write the updated config file
        File::put($configPath, $newConfigContent);
        $this->info('Enabled Fortify features in config/fortify.php');
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
        $this->info('Installing npm dependencies...');
        
        // Run npm install and capture output
        $output = [];
        $returnCode = null;
        exec('npm install 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error('Failed to install npm dependencies. Output:');
            $this->line(implode("\n", $output));
            $this->info('Please run "npm install" manually in your project directory.');
            return;
        }

        $this->info('Compiling assets...');
        
        // Run npm run build and capture output
        $output = [];
        $returnCode = null;
        exec('npm run build 2>&1', $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error('Failed to compile assets. Output:');
            $this->line(implode("\n", $output));
            $this->info('Please run "npm run build" manually in your project directory.');
            return;
        }

        $this->info('Blade stack installed. Breezify UI is ready!');
    }
}