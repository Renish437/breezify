# Breezify is Laravel Breeze and Fortify Mashup  🌀

**Breezify** is a Laravel authentication scaffolding package that combines the clean UI approach of **Laravel Breeze** with the powerful backend features of **Laravel Fortify**. It offers out-of-the-box authentication views, profile management, email verification, and two-factor authentication — all ready to go.

> Built and maintained by [Renish Siwakoti](https://github.com/renishsiwakoti)

---

## 📦 Installation

### 1. Require the Package via Composer

    composer require codesren/breezify:dev-main

2. Publish the Breezify Assets

    php artisan vendor:publish --tag=breezify & php artisan install:breezify blade



This will publish:

    Views (resources/views/auth)

    Controllers

    Layouts (AppLayout, GuestLayout)

    Routes (routes/auth.php)

    Tailwind / Vite configs

    FortifyServiceProvider

    JS / CSS scaffolding

3. Register the Fortify Service Provider

Ensure the following is added to config/app.php:

    App\Providers\FortifyServiceProvider::class,

⚙️ Configuration
Enable Fortify Views

In config/fortify.php:

    'views' => true,

Enable Features

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
        
In make sure to have these View in Providers/FortifyServiceProvider.php   
        
        # Register view
        Fortify::registerView(function () {
            return view('auth.register');
        });
        # Login view
        Fortify::loginView(function () {
            return view('auth.login');
        });
        # Forgot Password view
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        # Reset Password view
        Fortify::resetPasswordView(function (Request $request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        # Email verification view
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        # Password confirmation view
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
        
        # Two factor authentication
        Fortify::twoFactorChallengeView(function (Request $request) {
            $recovery = $request->get('recovery',false);
            return view('auth.two-factor-challenge',compact('recovery'));
        });

📁 Routes

Make sure to include the published route file in routes/web.php:

    require __DIR__.'/auth.php';

🧑‍💻 User Model Setup

Ensure your User model uses necessary traits and interfaces:

    use Laravel\Fortify\TwoFactorAuthenticatable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;

    class User extends Authenticatable implements MustVerifyEmail
    {
        use HasFactory, Notifiable, TwoFactorAuthenticatable;

        protected $fillable = ['name', 'email', 'password'];
    }

🛡️ Features Included

  ✅ Registration & Login
  ✅ Email Verification
  ✅ Forgot & Reset Password
  ✅ Profile Update
  ✅ Password Confirmation
  ✅ Two-Factor Authentication
  ✅ Tailwind CSS UI
  ✅ Vite + PostCSS Ready
  🚀 Build Frontend Assets

After publishing:

    npm install
    npm run dev

    Ensure you have Node.js, npm, and Vite configured.

🧪 Run Migrations

    php artisan migrate

🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
📧 Support

    Email: renishsiwakoti437@gmail.com

    Issues: GitHub Issues

📄 License

The MIT License (MIT). See LICENSE for details.





