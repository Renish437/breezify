<div align="center">
🌟 Breezify

A Laravel package that makes user authentication simple and beautiful.
<p>Breezify combines Laravel Fortify for secure login features with Laravel Breeze for a sleek, modern look using Blade and TailwindCSS. 🚀 Set up a complete login system with a polished interface in minutes!</p>
<p>
<a href="https://packagist.org/packages/codesren/breezify"><img src="https://img.shields.io/packagist/v/codesren/breezify.svg?style=flat-square" alt="Latest Version on Packagist"></a>
<a href="https://packagist.org/packages/codesren/breezify"><img src="https://img.shields.io/packagist/dt/codesren/breezify.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://github.com/codesren/breezify/blob/main/LICENSE.md"><img src="https://img.shields.io/packagist/l/codesren/breezify.svg?style=flat-square" alt="License"></a>
</p>
</div>

Perfect for new or existing Laravel projects, Breezify gets you started with one command, giving you login, registration, profile management, and more—all styled elegantly. 😊
✨ Key Features

    Secure Authentication: Login, registration, password reset, email verification, two-factor authentication, profile updates, and account deletion.

    Modern UI: Clean, responsive pages styled with TailwindCSS.

    Main Pages: /dashboard user home page and /profile for editing.

    One-Command Setup: Install everything with a single Artisan command.

    Customizable: Easily tweak the design or add new features.

🛠️ Requirements

Before starting, ensure your project has:

    PHP 8.0 or higher

    Laravel 8.0 or higher

    Laravel Fortify 1.4 or higher

    Laravel Breeze 1.0 or higher

    Node.js and npm (for styling)

🚀 Get Started in 5 Easy Steps

Follow these steps to add Breezify to your Laravel project. You’ll have a fully working authentication system in no time! 🎉
Step 1: Install Breezify

In your Laravel project folder, run this command to add Breezify:
Generated bash

      
composer require codesren/breezify

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END

    Local Development: If you’re working on Breezify locally, add this to your project’s composer.json:
    Generated json

          
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

        

    IGNORE_WHEN_COPYING_START

    Use code with caution. Json
    IGNORE_WHEN_COPYING_END

    Then run composer require codesren/breezify.

Step 2: Run the Setup Command

Install Breezify’s files (pages, routes, and more) with this command:
Generated bash

      
php artisan breezify:install blade

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END

This will:

    Add Breeze’s styled pages and TailwindCSS.

    Set up Fortify’s secure login features.

    Create routes for /dashboard and /profile.

    Add database tables and routes to your project.

    Note: Only the blade style is supported now. More options may come later! 🌈

Step 3: Build the Styles

Set up and compile the styling files to make your pages look great:
Generated bash

      
npm install
npm run build

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END

This prepares TailwindCSS and JavaScript for a modern look.
Step 4: Set Up the Database

Create the necessary database tables (like users):
Generated bash

      
php artisan migrate

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END
Step 5: Start Your Project

Launch your Laravel server to see Breezify in action:
Generated bash

      
php artisan serve

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END

Open http://localhost:8000 in your browser to explore your new login system! ✨
🎯 Using Breezify

Once installed, Breezify gives you a ready-to-use authentication system.
🔐 Login Pages

    Login: /login

    Register: /register

    Password Reset: /password/reset

    Email Verification: /email/verify

    Two-Factor Authentication: /two-factor-challenge

👤 User Pages

    Dashboard: /dashboard (your home page)

    Profile: /profile (edit your name, email, or delete your account)

✂️ Customize It

Want to make it your own? You can change:

    Pages: Edit files in resources/views/ (e.g., dashboard.blade.php or auth/login.blade.php).

    Routes: Update routes/auth.php to add or change links.

    Styles: Modify resources/css/app.css or resources/js/app.js for custom designs.

To publish and update files later, run:
Generated bash

      
php artisan vendor:publish --tag=breezify

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END
🧪 Test Your Setup

Make sure everything works with these quick checks:

    See Available Pages:
    Generated bash

          
    php artisan route:list

        

    IGNORE_WHEN_COPYING_START

    Use code with caution. Bash
    IGNORE_WHEN_COPYING_END

    Look for /dashboard, /profile, /login, and /register.

    Try Signing Up:

        Go to /register to create an account.

        Log in at /login and check if you land on /dashboard.

    Update Your Profile:

        Visit /profile to change your name or email.

        Try deleting your account to test the functionality.

    Check the Design:

        Open your browser’s developer tools (F12) to ensure the styles look good on different screen sizes.

        Look for any errors in the console.

🔧 Extra Options
Change Login Features

Breezify sets up all Fortify features in config/fortify.php. To turn some off, comment out any features you don’t want:
Generated php

      
// config/fortify.php

'features' => [
    Features::registration(),
    Features::resetPasswords(),
    // Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication(),
],

    

IGNORE_WHEN_COPYING_START
Use code with caution. PHP
IGNORE_WHEN_COPYING_END
Add More Features

    New Pages: Add links in routes/auth.php.

    Custom Code: Update app/Http/Controllers/ProfileController.php or add new files.

    Custom Designs: Change Blade files in resources/views/ or create new ones.

🤝 How to Help

Want to improve Breezify? We’d love your help! 😊

    Visit the GitHub repository.

    Create a new branch: git checkout -b my-cool-feature

    Save your changes: git commit -m 'Add my cool feature'

    Share your work: git push origin my-cool-feature

    Submit a Pull Request on GitHub.

🐞 Need Help?

If something’s not working, open an issue on GitHub with:

    A clear description of what’s wrong.

    Steps to recreate the problem.

    Your Laravel, PHP, and Breezify versions.

We’ll help you out quickly! 🙌
📜 License

Breezify is free to use under the MIT License. Feel free to use it in your projects!
🙏 Thanks To

    Author: Renish Siwakoti

    Powered by: Laravel Fortify and Laravel Breeze

    Inspired by: The amazing Laravel community

<div align="center">
🎉 Start Now!

Ready to add a secure and stylish login system to your Laravel project?
Generated bash

      
composer require codesren/breezify
php artisan breezify:install blade

    

IGNORE_WHEN_COPYING_START
Use code with caution. Bash
IGNORE_WHEN_COPYING_END

Happy coding! 😄
</div>