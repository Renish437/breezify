<?php

namespace CodesRen\Breezify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'breezify:install {stack=blade : The frontend stack (blade)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Breezify package scaffolding';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('stack') !== 'blade') {
            $this->error('Only the Blade stack is currently supported.');
            return 1;
        }

        // 1. Publish all package resources first
        $this->info('Publishing Breezify resources (views, configs, controllers)...');
        Artisan::call('vendor:publish', ['--provider' => 'CodesRen\\Breezify\\Providers\\BreezifyServiceProvider', '--tag' => 'breezify', '--force' => true], $this->getOutput());
        
        $this->info('Publishing Fortify resources...');
        Artisan::call('vendor:publish', ['--provider' => 'Laravel\\Fortify\\FortifyServiceProvider', '--force' => true], $this->getOutput());
        
        // 2. Update configs and routes
        $this->registerFortifyServiceProvider();
        $this->enableFortifyFeatures();
        $this->appendRoutes();
        $this->updateGitignore();

        // 3. Install Node dependencies (This MUST happen before building)
        $this->info('Installing Node dependencies...');
        $this->runProcess($this->npmCommand().' install');

        // 4. Run database migrations
        $this->info('Running database migrations...');
        Artisan::call('migrate', [], $this->getOutput());
        
        // 5. Build assets (This MUST happen last)
        $this->info('Compiling frontend assets...');
        $this->runProcess($this->npmCommand().' run build');

        $this->line('');
        $this->info('Breezify installed successfully!');
        $this->comment('Please run "npm run dev" to start the Vite development server.');

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

        // Use a more robust string replacement that is less prone to formatting errors
        $fortifyConfig = file_get_contents($configPath);
        $featuresReplacement = "'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirmPassword' => true,
        ]),
    ],";

        $fortifyConfig = preg_replace("/'features' => \[.*?],/s", $featuresReplacement, $fortifyConfig, 1);
        file_put_contents($configPath, $fortifyConfig);
    }
    
    /**
     * Appends required routes to the application's web routes file.
     */
    protected function appendRoutes()
    {
        $this->info('Adding auth routes...');
        $authRoutes = "require __DIR__.'/auth.php';";
        
        if (!Str::contains(File::get(base_path('routes/web.php')), $authRoutes)) {
            File::append(base_path('routes/web.php'), "\n".$authRoutes);
        } else {
            $this->line('Auth routes already included. Skipping.');
        }
    }

    /**
     * Determines which NPM client to use.
     *
     * @return string
     */
    protected function npmCommand(): string
    {
        if (file_exists(base_path('pnpm-lock.yaml'))) {
            return 'pnpm';
        }
        if (file_exists(base_path('yarn.lock'))) {
            return 'yarn';
        }
        return 'npm';
    }

    /**
     * Runs a command process from a string.
     *
     * @param string $command
     * @return void
     */
    protected function runProcess(string $command)
    {
        $process = Process::fromShellCommandline($command, base_path(), null, null, null);
        
        $process->run(function ($type, $buffer) {
            $this->getOutput()->write($buffer);
        });
    }

    /**
     * Update the .gitignore file.
     *
     * @return void
     */
    protected function updateGitignore()
    {
        $gitignorePath = base_path('.gitignore');
        if (!file_exists($gitignorePath)) {
            return;
        }

        $content = file_get_contents($gitignorePath);

        if (!Str::contains($content, '/public/build')) {
            file_put_contents($gitignorePath, $content.PHP_EOL.'/public/build'.PHP_EOL);
        }
    }
}