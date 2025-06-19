🌟 Breezify

Latest Version on Packagist
Total Downloads
License

Breezify is a Laravel package that combines the power of Laravel Fortify for robust backend authentication with the sleek, modern UI of Laravel Breeze using Blade and TailwindCSS. 🚀
Get a fully-featured authentication system with a polished frontend in minutes!
✨ Features

    🔐 Fortify Backend — Secure login, registration, password reset, email verification, 2FA, and profile/account management

    💨 Breeze UI — Blade templates + TailwindCSS = clean and responsive UI

    🛣️ Custom Routes

        /dashboard — Dashboard page

        /profile — Edit profile

    🧰 Fortify Routes

        /login, /register, /password/reset, etc.

        API routes: /user/profile-information (PATCH), /user/profile (DELETE)

    ⚙️ Easy Installation — Set up with a single Artisan command

    🎨 Customizable — Views, routes, controllers, and assets

    🪶 Lightweight — Minimal overhead

🛠️ Requirements

    PHP: >= 8.0

    Laravel: >= 9.0

    Laravel Fortify: >= 1.0

    Laravel Breeze: >= 1.0

    Node.js & npm: For asset compilation

🚀 Installation
Step 1: Install via Composer

Run this command in your Laravel project root:

composer require codesren/breezify

For local development with a path repository, update composer.json:

{
    "repositories": [
        {
            "type": "path",
            "url": "../path/to/codesren-breezify"
        }
    ],
    "require": {
        "codesren/breezify": "*"
    }
}

Then install again:

composer require codesren/breezify

Step 2: Run the Installation Command

php artisan breezify:install blade

This will:

    Scaffold Breeze's Blade views, styles, and assets

    Configure Fortify with all features

    Set up /dashboard and /profile

    Publish controllers, migrations, and route files

    Add require __DIR__.'/auth.php'; to routes/web.php

    Currently, only the Blade stack is supported. Livewire or Inertia support may come later. 🌈

Step 3: Compile Assets

npm install
npm run build

This uses Vite to compile TailwindCSS and JavaScript.
Step 4: Run Migrations

php artisan migrate

Step 5: Start the Development Server

php artisan serve

Visit http://localhost:8000 in your browser. You should see the authentication pages in action! ✨
🎯 Usage
🔒 Authentication Routes

    /login — Fortify login

    /register — User registration

    /password/reset — Reset password

    /email/verify — Email verification

    /two-factor-challenge — 2FA login

👤 User Routes

    /dashboard — Dashboard UI (Blade)

    /profile — Edit profile

    /user/profile-information (PATCH) — Update profile info

    /user/profile (DELETE) — Delete user account

🛠️ Customization

    Views: Edit files in resources/views/ (e.g., profile/edit.blade.php, dashboard.blade.php, auth/*.blade.php)

    Routes: Customize or add more in routes/auth.php

    Controllers: Modify or extend those in app/Http/Controllers/

    Assets: Customize styles/scripts in resources/css/ and resources/js/

To republish:

php artisan vendor:publish --tag=breezify

🧪 Testing Your Setup
✅ Check Routes

php artisan route:list

Look for /dashboard, /profile, /login, /register, etc.
✅ Register & Login

    Go to /register, then /login

    You’ll be redirected to /dashboard after login

✅ Test Profile Features

    Visit /profile to update name/email

    Submit to trigger /user/profile-information

    Delete account via /user/profile

✅ Verify Assets

    Confirm Tailwind styles are applied

    Check browser dev tools for JS errors

⚙️ Advanced Configuration

Edit config/fortify.php to enable/disable features:

'features' => [
    Features::registration(),
    Features::resetPasswords(),
    Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication(),
],

Comment out anything you don’t need.
🔌 Extending the Package

    New Routes: Add to routes/auth.php

    Controllers: Extend or add in Http/Controllers/

    Blade Views: Customize existing or create new

    Fortify Actions: Override by editing files in app/Actions/Fortify/

🤝 Contributing

Contributions are welcome!

    Fork the repo

    Create a feature branch:

git checkout -b feature/my-feature

Make your changes

Commit:

    git commit -m "Add my feature"

    Push and open a Pull Request

Please follow Laravel’s coding conventions and add tests if possible.
🐛 Issues & Support

Found a bug or need help? Open a GitHub issue with:

    A clear description

    Steps to reproduce

    Laravel, PHP, and Breezify version

We’ll get back to you quickly 😊
📝 License

Breezify is open-source software licensed under the MIT License.
Use it freely in personal or commercial projects.
🙏 Credits

    Author: Renish Siwakoti

    Built With: Laravel Fortify, Laravel Breeze, and ❤️

    Inspired by: The Laravel community

🎉 Get Started Today!

Ready to breeze through auth setup?
Install Breezify and build something amazing! 🚀

composer require codesren/breezify
php artisan breezify:install blade

Happy coding! 😄

Let me know if you'd like a version with screenshots, GitHub templates (like CONTRIBUTING.md), or Packagist submission help!