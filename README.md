# 🌟 Breezify

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codesren/breezify.svg?style=flat-square)](https://packagist.org/packages/codesren/breezify)
[![Total Downloads](https://img.shields.io/packagist/dt/codesren/breezify.svg?style=flat-square)](https://packagist.org/packages/codesren/breezify)
[![License](https://img.shields.io/packagist/l/codesren/breezify.svg?style=flat-square)](https://github.com/codesren/breezify/blob/main/LICENSE)

**Breezify** is a Laravel package that combines the power of **Laravel Fortify** for robust backend authentication with the sleek, modern UI of **Laravel Breeze** using Blade and TailwindCSS. 🚀 Get a fully-featured authentication system with a polished frontend in minutes!

Whether you're building a new Laravel project or upgrading an existing one, Breezify simplifies setup with a single Artisan command, delivering login, registration, profile management, and more—all styled beautifully. 😎

---

## ✨ Features

- **Fortify Backend**: Secure authentication with login, registration, password reset, email verification, two-factor authentication, profile updates, and account deletion.
- **Breeze UI**: Modern, responsive Blade templates styled with TailwindCSS for a clean user experience.
- **Custom Routes**:
  - `/dashboard`: User dashboard
  - `/profile`: Profile edit page (Breeze UI, Fortify backend)
- **Fortify Routes**:
  - `/login`, `/register`, `/password/reset`, and more
  - `/user/profile-information` (PATCH): Update profile
  - `/user/profile` (DELETE): Delete account
- **Easy Installation**: One Artisan command to scaffold everything.
- **Customizable**: Publish views, routes, controllers, and assets to tailor the experience.
- **Lightweight**: Minimal footprint with maximum functionality.

---

## 🛠️ Requirements

Before diving in, ensure your project meets these requirements:

- **PHP**: >= 8.0
- **Laravel**: >= 9.0
- **Laravel Fortify**: >= 1.0
- **Laravel Breeze**: >= 1.0
- **Node.js & npm**: For compiling assets

---

## 🚀 Installation

Follow these simple steps to get Breezify up and running in your Laravel project! 🎉

### Step 1: Install via Composer

Add Breezify to your project using Composer. Run this command in your Laravel project’s root directory:

```bash
composer require codesren/breezify



Note: If you’re developing locally, use a path repository in your project’s composer.json:

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

Then run composer require codesren/breezify.

Step 2: Run the Installation Command

Scaffold your project with Breezify’s authentication system using the Artisan command. This sets up views, routes, controllers, migrations, and Fortify configuration:

php artisan breezify:install blade

This command:





Publishes Breeze’s Blade views, TailwindCSS styles, and JavaScript assets.



Sets up Fortify’s backend with all authentication features enabled.



Publishes custom routes (/dashboard, /profile) and controllers.



Copies migrations for the users table and more.



Appends require __DIR__.'/auth.php'; to routes/web.php.



Note: Currently, only the blade stack is supported. More stacks (e.g., Livewire, Inertia) may be added in future releases! 🌈

Step 3: Compile Assets

Install npm dependencies and compile your assets to bring the Breeze UI to life:

npm install
npm run build

This uses Vite to compile TailwindCSS and JavaScript, ensuring a modern, responsive frontend.

Step 4: Run Migrations

Apply the database migrations to create the necessary tables (e.g., users):

php artisan migrate

Step 5: Start Your Server

Fire up Laravel’s development server and explore your new authentication system:

php artisan serve

Visit http://localhost:8000 in your browser to see the magic! ✨



🎯 Usage

Once installed, Breezify provides a fully functional authentication system. Here’s what you get out of the box:

🔒 Authentication Routes





Login: /login (Fortify)



Register: /register (Fortify)



Password Reset: /password/reset (Fortify)



Email Verification: /email/verify (Fortify)



Two-Factor Authentication: /two-factor-challenge (Fortify)

👤 User Routes





Dashboard: /dashboard (Custom, displays Breeze UI)



Profile Edit: /profile (Custom, displays Breeze UI with Fortify backend)



Profile Update: /user/profile-information (PATCH, Fortify)



Account Deletion: /user/profile (DELETE, Fortify)

🛠️ Customization

Want to tweak the UI or logic? Breezify makes it easy to customize:





Views: Published to resources/views/. Edit profile/edit.blade.php, dashboard.blade.php, or auth/*.blade.php to match your brand.



Routes: Published to routes/auth.php. Modify or add routes as needed.



Controllers: Published to app/Http/Controllers/. Customize ProfileController.php or add new controllers.



Assets: Published to resources/css/ and resources/js/. Adjust TailwindCSS or JavaScript in app.css or app.js.

Run php artisan vendor:publish --tag=breezify to republish assets if needed.



🧰 Testing Your Setup

To ensure everything’s working, try these steps:





Check Routes:

php artisan route:list

Look for /dashboard, /profile, /login, /register, /user/profile-information, and /user/profile.



Register a User:





Visit /register to create a new account.



Log in at /login and verify you’re redirected to /dashboard.



Test Profile Management:





Go to /profile to edit your profile (name, email).



Submit the form to update via /user/profile-information.



Use the delete account form to test account deletion via /user/profile.



Verify Assets:





Open your browser’s dev tools to confirm TailwindCSS styles are applied.



Check for JavaScript errors in the console.



📚 Advanced Configuration

Fortify Features

Breezify enables all Fortify features by default in config/fortify.php. To customize, edit the published configuration:

'features' => [
    Features::registration(),
    Features::resetPasswords(),
    Features::emailVerification(),
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication(),
],

Disable any features you don’t need by commenting them out.

Extending the Package





Add New Routes: Edit routes/auth.php to add custom authenticated routes.



Custom Controllers: Extend ProfileController or create new controllers in app/Http/Controllers/.



Custom Views: Modify Blade templates in resources/views/ or create new ones.



Fortify Actions: Override Fortify’s actions (e.g., CreateNewUser) by publishing and editing files in app/Actions/Fortify/.



🤝 Contributing

Love Breezify? Want to make it even better? Contributions are welcome! 🙌





Fork the repository on GitHub.



Create a new branch (git checkout -b feature/awesome-feature).



Make your changes and commit (git commit -m 'Add awesome feature').



Push to your branch (git push origin feature/awesome-feature).



Open a Pull Request.

Please include tests and follow Laravel’s coding standards.



🐛 Issues & Support

Found a bug or need help? Open an issue on GitHub with:





A clear description of the problem.



Steps to reproduce.



Your Laravel, PHP, and Breezify versions.

We’ll get back to you as soon as possible! 😊



📝 License

Breezify is open-source software licensed under the MIT License. Feel free to use, modify, and distribute it in your projects.



🙏 Credits





Author: Renish Siwakoti



Built with: Laravel Fortify, Laravel Breeze, and ❤️



Inspired by: The Laravel community’s passion for simplicity and elegance



🎉 Get Started Today!

Ready to breeze through authentication with Fortify’s power and Breeze’s style? Install Breezify now and build something amazing! 🚀

composer require codesren/breezify
php artisan breezify:install blade

Happy coding! 😄

</xArtifact>

---

### Explanation of Design Choices
1. **Attractive Formatting**:
   - Used emojis (🌟, 🚀, ✨) to make the README visually engaging and approachable.
   - Included badges for version, downloads, and license to showcase credibility.
   - Organized sections with clear headings (`#`, `##`, `###`) and horizontal rules (`---`) for readability.

2. **Step-by-Step Guide**:
   - Broke installation into five clear steps with code blocks for each command.
   - Included notes for local development (path repository) to support your development workflow.
   - Detailed what each command does (e.g., publishing views, compiling assets) to help beginners.

3. **Comprehensive Features**:
   - Listed all key features (Fortify backend, Breeze UI, routes) with bullet points for clarity.
   - Highlighted customization options to appeal to advanced users.

4. **Testing and Usage**:
   - Provided practical steps to test routes, user registration, and profile management.
   - Included commands (e.g., `php artisan route:list`) to verify setup.

5. **Advanced and Community Sections**:
   - Added sections for Fortify configuration, extending the package, contributing, and support to encourage community involvement.
   - Linked to GitHub for issues and contributions (assuming a repository exists).

6. **Professional Tone**:
   - Balanced enthusiasm (emojis, “Happy coding!”) with professional details (requirements, license, credits).
   - Credited you (Renish Siwakoti) as the author and acknowledged Laravel Fortify and Breeze.

---

### Customization Notes
- **Badges**: The badges (`Latest Version`, `Total Downloads`, `License`) assume the package is published on Packagist. If it’s not yet published, remove the badges or update the URLs once published.
- **GitHub Links**: The `License`, `Contributing`, and `Issues & Support` sections assume a GitHub repository. Replace `https://github.com/codesren/breezify` with your actual repository URL or remove these sections if not applicable.
- **Author Details**: I used “Renish Siwakoti” from your `composer.json`. Add an email or GitHub profile if desired.
- **Additional Features**: If your package includes features beyond what’s described (e.g., custom middleware, additional views), let me know, and I can update the README.

---

### Next Steps
1. **Save the README**:
   - Place the `README.md` file in the root of your `codesren-breezify` directory.
   - Commit it to your version control system (e.g., Git):
     ```bash
     git add README.md
     git commit -m "Add awesome README.md"
     ```

2. **Test the README**:
   - View it on GitHub, GitLab, or a markdown previewer (e.g., VS Code’s markdown preview) to ensure formatting looks good.
   - Check links (e.g., badges, license) once the package is published.

3. **Publish the Package** (Optional):
   - If you plan to publish on Packagist, follow these steps:
     - Push to a public GitHub repository.
     - Submit to Packagist at `https://packagist.org/packages/submit`.
     - Update badge URLs in the README with your Packagist package name.

4. **Further Enhancements**:
   - Add a logo or screenshot of the Breeze UI to the README (e.g., `![Breezify UI](screenshot.png)`).
   - Include a “Changelog” section for future releases.
   - Add a “FAQ” section if users frequently ask specific questions.

If you want to tweak the README (e.g., add screenshots, change tone, or include specific features), or if you need help with publishing or testing, let me know! 😄