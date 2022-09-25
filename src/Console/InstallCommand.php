<?php

namespace Gw\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gw:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Organize the project structure';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        // Remove unnecessary files...
        (new Filesystem)->deleteDirectory(resource_path('views/js'));
        (new Filesystem)->deleteDirectory(resource_path('views/css'));
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));
        (new Filesystem)->delete(base_path('vite.config.js'));
        (new Filesystem)->delete(base_path('package.json'));

        // Casts...
        (new Filesystem)->ensureDirectoryExists(app_path('Casts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Casts', app_path('Casts'));

        // Exceptions...
        (new Filesystem)->deleteDirectory(app_path('Exceptions'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Exceptions', app_path('Exceptions'));

        // Helpers...
        (new Filesystem)->ensureDirectoryExists(app_path('Helpers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Helpers', app_path('Helpers'));

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Controllers/Auth', app_path('Http/Controllers/Auth'));

        // Middleware...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Middleware'));
        copy(__DIR__ . '/../../stubs/app/Http/Middleware/ForceJsonResponse.php', app_path('Http/Middleware/ForceJsonResponse.php'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/Auth'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Requests/Auth', app_path('Http/Requests/Auth'));

        // Resources...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Resources'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Http/Resources', app_path('Http/Resources'));

        // kernel...
        copy(__DIR__ . '/../../stubs/app/Http/Kernel.php', app_path('Http/Kernel.php'));

        // Mail...
        (new Filesystem)->ensureDirectoryExists(app_path('Mail'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/app/Mail', app_path('Mail'));

        // Model...
        copy(__DIR__ . '/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // Config...
        (new Filesystem)->ensureDirectoryExists(base_path('Config'));
        copy(__DIR__ . '/../../stubs/Config/custom.php', base_path('Config/custom.php'));

        // Lang...
        (new Filesystem)->ensureDirectoryExists(base_path('lang/en'));
        (new Filesystem)->delete(base_path('lang/en/passwords.php'));
        copy(__DIR__ . '/../../stubs/lang/en/passwords.php', base_path('lang/en/passwords.php'));
        copy(__DIR__ . '/../../stubs/lang/en/site.php', base_path('lang/en/site.php'));

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/emails'));
        copy(__DIR__ . '/../../stubs/resources/views/emails/send-reset-link.blade.php', resource_path('views/emails/send-reset-link.blade.php'));

        // Routes...
        (new Filesystem)->delete(base_path('routes/api.php'));
        (new Filesystem)->delete(base_path('routes/web.php'));
        copy(__DIR__ . '/../../stubs/routes/api.php', base_path('routes/api.php'));
        copy(__DIR__ . '/../../stubs/routes/web.php', base_path('routes/web.php'));

        $this->put_permanent_env('FRONTEND_URL', 'http://localhost:3000');

        $this->components->info('You are now ready to build your app! Happy coding 🫡 🚀');
    }

    public function put_permanent_env($key, $value)
    {
        $path = base_path('.env');

        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }
}
