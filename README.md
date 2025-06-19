🌟 Breezify

A Laravel package that makes user authentication simple and beautiful.

Breezify combines Laravel Fortify for secure login features with Laravel Breeze for a sleek, modern look using Blade and TailwindCSS. 🚀
Set up a complete login system with a polished interface in minutes!

Latest Version on Packagist
Total Downloads
License

Perfect for new or existing Laravel projects, Breezify gets you started with one command—giving you login, registration, profile management, and more—all styled elegantly. 😊
✨ Key Features

    Secure Authentication: Login, registration, password reset, email verification, two-factor authentication, profile updates, and account deletion

    Modern UI: Clean, responsive pages styled with TailwindCSS

    Main Pages: /dashboard (user homepage) and /profile (edit)

    One-Command Setup: Install everything with a single Artisan command

    Customizable: Easily tweak the design or add new features

🛠️ Requirements

Before starting, ensure your project has:

    PHP 8.0 or higher

    Laravel 8.0 or higher

    Laravel Fortify 1.4 or higher

    Laravel Breeze 1.0 or higher

    Node.js and npm (for styling and scripts)

🚀 Get Started in 5 Easy Steps
Step 1: Install Breezify

In your Laravel project folder, run:

composer require codesren/breezify

Local Development (Optional):

If developing locally, add this to your composer.json:

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

Step 2: Run the Setup Command

php artisan breezify:install blade

This will:

    Add Breeze’s styled pages and TailwindCSS

    Set up Fortify’s secure backend

    Create routes for /dashboard and /profile

    Add migrations, controllers, and views

    Note: Currently supports only the blade stack. More stacks may come soon! 🌈

Step 3: Build the Styles

npm install
npm run build

This compiles TailwindCSS and JavaScript assets using Vite.
Step 4: Set Up the Database

php artisan migrate

Step 5: Start Your Laravel Project

php artisan serve

Visit http://localhost:8000 to view your app. 🎉
🎯 Using Breezify
🔐 Authentication Pages

    /login — Login

    /register — Register

    /password/reset — Reset password

    /email/verify — Email verification

    /two-factor-challenge — Two-factor auth

👤 User Pages

    /dashboard — User homepage

    /profile — Edit name/email, delete account

✂️ Customize It

You can modify:

    Views:
    Edit files in resources/views/ (e.g., dashboard.blade.php, auth/login.blade.php)

    Routes:
    Update routes/auth.php

    Styles and Scripts:
    Modify resources/css/app.css or resources/js/app.js

To republish Breezify's assets:

php artisan vendor:publish --tag=breezify

🧪 Test Your Setup
1. View Available Routes:

php artisan route:list

Look for /dashboard, /profile, /login, /register, etc.
2. Try Signing Up:

    Go to /register and create an account

    Login at /login and ensure you're redirected to /dashboard

3. Test Profile:

    Visit /profile to change name/email

    Try deleting your account

4. Design Check:

    Use browser dev tools to ensure styles load correctly

    Check for errors in the console

🔧 Extra Options
Customize Fortify Features

Edit config/fortify.php:

'features' => [
    Features::registration(),
    Features::resetPasswords(),
    // Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication(),
],

Comment out any feature you don’t need.
Add More Features

    New Pages: Add to routes/auth.php

    Controllers: Update app/Http/Controllers/ProfileController.php or create your own

    Blade Views: Modify or create new views in resources/views/

🤝 How to Help

Want to improve Breezify? We’d love your help!

git checkout -b my-cool-feature
git commit -m "Add my cool feature"
git push origin my-cool-feature

Then submit a Pull Request on GitHub.
🐞 Need Help?

Open a GitHub issue with:

    A clear description of the problem

    Steps to reproduce

    Laravel, PHP, and Breezify versions

We’ll help you out as soon as possible! 🙌
📜 License

Breezify is open-source software licensed under the MIT License.
You’re free to use it in personal or commercial projects.
🙏 Thanks To

    Author: Renish Siwakoti

    Powered by: Laravel Fortify and Laravel Breeze

    Inspired by: The amazing Laravel community

🎉 Start Now!

Ready to add a secure and stylish login system to your Laravel project?

composer require codesren/breezify
php artisan breezify:install blade

Happy coding! 😄

