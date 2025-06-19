<?php

  namespace CodesRen\Breezify\Providers;

  use Illuminate\Support\ServiceProvider;
  use Laravel\Fortify\Fortify;
  use CodesRen\Breezify\Actions\Fortify\CreateNewUser;
  use CodesRen\Breezify\Actions\Fortify\ResetUserPassword;
  use CodesRen\Breezify\Actions\Fortify\UpdateUserPassword;
  use CodesRen\Breezify\Actions\Fortify\UpdateUserProfileInformation;
  use Illuminate\Cache\RateLimiting\Limit;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\RateLimiter;
  use Illuminate\Support\Str;

  class BreezifyServiceProvider extends ServiceProvider
  {
      public function register()
      {
          // Register any bindings or configurations
      }

      public function boot()
      {
          // Publish resources
          $this->publishes([
              __DIR__.'/../../resources/views' => resource_path('views'),
              __DIR__.'/../../resources/css' => resource_path('css'),
              __DIR__.'/../../resources/js' => resource_path('js'),
              __DIR__.'/../../vite.config.js' => base_path('vite.config.js'),
              __DIR__.'/../../routes' => base_path('routes'),
              __DIR__.'/../../app/Http/Controllers' => app_path('Http/Controllers'),
              __DIR__.'/../../database/migrations' => database_path('migrations'),
          ], 'breezify');

          

          // Load views
          $this->loadViewsFrom(__DIR__.'/../../resources/views', 'breezify');

          // Register Fortify actions and views
          $this->configureFortify();

          // Register Artisan command
          if ($this->app->runningInConsole()) {
              $this->commands([
                  \CodesRen\Breezify\Commands\InstallCommand::class,
              ]);
          }
      }

      protected function configureFortify()
      {
          Fortify::createUsersUsing(CreateNewUser::class);
          Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
          Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
          Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

          RateLimiter::for('login', function (Request $request) {
              $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
              return Limit::perMinute(5)->by($throttleKey);
          });

          RateLimiter::for('two-factor', function (Request $request) {
              return Limit::perMinute(5)->by($request->session()->get('login.id'));
          });

          Fortify::loginView(function () {
              return view('breezify::auth.login');
          });

          Fortify::registerView(function () {
              return view('breezify::auth.register');
          });

          Fortify::requestPasswordResetLinkView(function () {
              return view('breezify::auth.forgot-password');
          });

          Fortify::resetPasswordView(function ($request) {
              return view('breezify::auth.reset-password', ['request' => $request]);
          });

          Fortify::verifyEmailView(function () {
              return view('breezify::auth.verify-email');
          });

          Fortify::confirmPasswordView(function () {
              return view('breezify::auth.confirm-password');
          });

          Fortify::twoFactorChallengeView(function (Request $request) {
              $recovery = $request->get('recovery', false);
              return view('breezify::auth.two-factor-challenge', compact('recovery'));
          });
      }
  }