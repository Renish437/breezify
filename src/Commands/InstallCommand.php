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

        // Append routes to web.php
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
            $this->error('Fortify configuration file not found at ' . $configPath . '. Ensure Laravel Fortify is installed.');
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

        // Load the existing config as a PHP array
        $config = require $configPath;

        // Update the features array
        $config['features'] = array_map(function ($feature) {
            return substr($feature, 0, -2); // Remove '()' for eval
        }, $features);

        // Generate the new config content
        $newConfigContent = "<?php\n\nuse Laravel\\Fortify\\Features;\n\nreturn " . $this->arrayToPhp($config) . ";\n";

        // Write the updated config file
        if (File::put($configPath, $newConfigContent)) {
            $this->info('Enabled Fortify features in config/fortify.php');
        } else {
            $this->error('Failed to write to config/fortify.php. Please manually add:');
            $this->line("'features' => [\n        " . implode(",\n        ", $features) . "\n    ]");
        }
    }

    /**
     * Convert a PHP array to a formatted PHP string.
     *
     * @param array $array
     * @param int $level
     * @return string
     */
    protected function arrayToPhp($array, $level = 0)
    {
        $indent = str_repeat('    ', $level);
        $lines = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $lines[] = $indent . "'" . addslashes($key) . "' => [\n" . $this->arrayToPhp($value, $level + 1) . $indent . "],";
            } elseif (is_string($value) && strpos($value, 'Features::') === 0) {
                $lines[] = $indent . "'" . addslashes($key) . "' => $value,";
            } else {
                $lines[] = $indent . "'" . addslashes($key) . "' => " . var_export($value, true) . ",";
            }
        }

        return implode("\n", $lines);
    }

    protected function appendToWebRoutes()
    {
        $webRoutesPath = base_path('routes/web.php');
        $packageRoutesPath = __DIR__.'/../../routes/web.php';

        if (!File::exists($packageRoutesPath)) {
            $this->error('Package routes file not found at ' . $packageRoutesPath);
            return;
        }

        $packageRoutes = File::get($packageRoutesPath);

        // Check if routes are already appended
        if (File::exists($webRoutesPath) && !str_contains(File::get($webRoutesPath), $packageRoutes)) {
            File::append($webRoutesPath, "\n" . $packageRoutes);
            $this->info('Appended Breezify routes to routes/web.php');
        } else {
            $this->info('Breezify routes already included in routes/web.php');
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