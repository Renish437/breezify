🌟 Breezify

## A Laravel package that makes user authentication simple and beautiful.

Breezify combines Laravel Fortify (for backend security) with Laravel Breeze (for beautiful UI using Blade and TailwindCSS).
Get a complete login + profile management system up and running in minutes! 🚀

Latest Version
Total Downloads
License
✨ Features

    🔐 Secure Authentication (Fortify): Login, register, password reset, email verification, 2FA, profile updates, account deletion

    💨 Clean UI (Breeze): Tailwind-styled Blade templates

    🛣️ Default Routes: /login, /register, /dashboard, /profile, etc.

    ⚙️ One-Command Setup

    🎨 Customizable: Views, routes, and controllers

    🪶 Lightweight: Simple but powerful

🛠 Requirements

    PHP >= 8.0

    Laravel >= 8.0

    Laravel Fortify >= 1.4

    Laravel Breeze >= 1.0

    Node.js & npm (for compiling assets)

🚀 Installation – 5 Simple Steps
✅ Step 1: Install Breezify

Open your terminal and run:

composer require codesren/breezify

    🧪 For local development, update your composer.json:

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

Then run:

    composer require codesren/breezify

✅ Step 2: Run Breezify Installer

This sets up Breeze UI, Fortify config, and custom routes:

    php artisan breezify:install blade

✔️ What it does:

    Installs Blade + Tailwind views

    Sets up Fortify authentication

    Adds /dashboard and /profile

    Adds Fortify features and migrations

    Appends auth.php to routes/web.php

    Currently supports only the Blade stack. Livewire/Inertia may be added later!

✅ Step 3: Compile Assets (Tailwind + JS)

    npm install
    npm run build

This uses Vite to bundle your TailwindCSS and JavaScript.
✅ Step 4: Run Migrations

    php artisan migrate

Creates necessary tables (users, password_resets, etc.).
✅ Step 5: Start Laravel Development Server

    php artisan serve

Visit: http://localhost:8000
You should now see the login screen with Breezify in action! ✨
🎯 Routes & Usage
🔐 Auth Routes (Fortify-powered)

    /login

    /register

    /password/reset

    /email/verify

    /two-factor-challenge

👤 User Pages (Custom UI)

    /dashboard – User dashboard

    /profile – Edit profile (update name/email or delete account)

✏️ Customization

Make it your own:

    Views:
    resources/views/dashboard.blade.php, auth/login.blade.php, etc.

    Routes:
    routes/auth.php

    Styles/Scripts:
    resources/css/app.css, resources/js/app.js

Re-publish assets anytime:

php artisan vendor:publish --tag=breezify

🧪 Test Checklist

    Check Routes:

php artisan route:list

Make sure you see /login, /register, /dashboard, /profile, etc.

    Register a User:

        Go to /register

        Log in via /login

        You should be redirected to /dashboard

    Update Profile:

        Visit /profile

        Try changing your name or email

        Use the delete option to remove account

    Verify Styles:

        Open dev tools (F12)

        Check Tailwind is working

        Console should be clean (no JS errors)

⚙️ Optional Config: Fortify Features

Edit config/fortify.php to toggle features:

    'features' => [
    Features::registration(),
    Features::resetPasswords(),
    // Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication(),
    ],

Comment out anything you don’t want.
➕ Extend It Further

Add new routes in routes/auth.php
Add custom controllers in app/Http/Controllers
Extend Fortify actions in app/Actions/Fortify/
Create additional views in resources/views

🤝 Contribute

We welcome your ideas and improvements!

    git checkout -b feature/my-feature
    git commit -m "Add amazing feature"
    git push origin feature/my-feature

Then open a Pull Request on GitHub 🚀
🐞 Need Support?

Open an issue with:

    Problem description

    Steps to reproduce

    Laravel, PHP, and Breezify version

👉 GitHub Issues Page
📜 License

Breezify is open-sourced under the MIT license.
🙏 Credits

    Author: Renish Siwakoti

    Powered by: Laravel Fortify + Laravel Breeze

    Inspired by: The amazing Laravel community ❤️

🎉 Get Started Now

composer require codesren/breezify
php artisan breezify:install blade

Happy coding! 😄