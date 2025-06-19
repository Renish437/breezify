# Breezify 🌀

**Breezify** is a Laravel authentication scaffolding package that combines the clean UI approach of **Laravel Breeze** with the powerful backend features of **Laravel Fortify**. It offers out-of-the-box authentication views, profile management, email verification, and two-factor authentication — all ready to go.

> Built and maintained by [Renish Siwakoti](https://github.com/renishsiwakoti)

---

## 📦 Installation

### 1. Require the Package via Composer


    composer require codesren/breezify:dev-main

2. Publish the Breezify Assets

    php artisan vendor:publish --tag=breezify or php artisan install:breezify blade

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





