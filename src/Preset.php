<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    /**
     * Install the presets.
     */
    public static function install()
    {
        static::updateEnv();
        static::updatePackages();
        static::updateConfig();
        static::updateControllers();
        static::updateMail();
        static::updateModels();
        static::updateRequests();
        static::updateTranslations();

        static::updateAssetsFolders();
        static::updateImages();
        static::updateScripts();
        static::updateStyles();
        static::updateMix();

        static::installAuth();
        static::installMiddlewares();

        static::removeNodeModules();
        static::runCommands();
    }

    /**
     * Update environment file.
     */
    protected static function updateEnv()
    {
        $content = file_get_contents(base_path('.env'));

        $pattern = '/APP_NAME=(.*)+/';
        $replacement = "APP_NAME=Mach3Builders";
        $content = preg_replace($pattern, $replacement, $content);

        if (!stristr($content, 'APP_EMAIL_FROM')) {
            $pattern = '/APP_URL=(.*)/';
            $replacement = "APP_URL=$1\nAPP_EMAIL_FROM=info@mach3builders.nl";
            $content = preg_replace($pattern, $replacement, $content);
        }

        file_put_contents(base_path('.env'), $content);
    }

    /**
     * Update config file.
     */
    protected static function updateConfig()
    {
        $content = file_get_contents(base_path('config/app.php'));
        $pattern = '/\'locale\' => \'([a-z]+)\',/';
        $replacement = "'locale' => 'nl',\n    'locales' => ['nl', 'en'],";
        $content = preg_replace($pattern, $replacement, $content);

        file_put_contents(base_path('config/app.php'), $content);
    }

    /**
     * Update the given package array.
     */
    protected static function updatePackageArray($packages)
    {
        return array_merge(
            ['@mach3builders/ui' => '^1.3.4'],
            Arr::except($packages, [
                'axios',
                'bootstrap',
                'lodash',
                'popper.js',
                'jquery',
                'vue',
            ])
        );
    }

    /**
     * Update the controllers.
     */
    protected static function updateControllers()
    {
        File::delete(app_path('Http/Controllers/HomeController.php'));
        File::copyDirectory(__DIR__.'/stubs/app/Http/Controllers', app_path('Http/Controllers'));
    }

    /**
     * Update the mail classes folder.
     */
    protected static function updateMail()
    {
        File::copyDirectory(__DIR__.'/stubs/app/Mail', app_path('Mail'));
    }

    /**
     * Update the models.
     */
    protected static function updateModels()
    {
        File::copy(__DIR__.'/stubs/app/Http/Account.php', app_path('Http/Account.php'));
    }

    /**
     * Update the requests.
     */
    protected static function updateRequests()
    {
        File::copyDirectory(__DIR__.'/stubs/app/Http/Requests', app_path('Http/Requests'));
    }

    /**
     * Update the translation files.
     */
    protected static function updateTranslations()
    {
        File::copyDirectory(resource_path('lang/en'), resource_path('lang/nl'));
        File::copyDirectory(__DIR__.'/stubs/resources/lang/en', resource_path('lang/en'));
        File::copyDirectory(__DIR__.'/stubs/resources/lang/nl', resource_path('lang/nl'));
    }

    /**
     * Delete and create assets folders.
     */
    protected static function updateAssetsFolders()
    {
        static::deleteDirectory(public_path('css'));
        static::deleteDirectory(public_path('js'));
        static::deleteDirectory(resource_path('sass'));
        static::deleteDirectory(resource_path('js'));

        static::makeDirectory(resource_path('assets'));
        static::makeDirectory(resource_path('assets/img'));
        static::makeDirectory(resource_path('assets/js'));
        static::makeDirectory(resource_path('assets/sass'));
    }

    /**
     * Update image files.
     */
    protected static function updateImages()
    {
        File::copyDirectory(__DIR__.'/stubs/resources/assets/img', public_path('assets/img'));
        File::delete(public_path('favicon.ico'));
    }

    /**
     * Update javascript files.
     */
    protected static function updateScripts()
    {
        File::copy(__DIR__.'/stubs/resources/assets/js/app.js', resource_path('assets/js/app.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap-native.js', resource_path('assets/js/bootstrap-native.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap-vue.js', resource_path('assets/js/bootstrap-vue.js'));
    }

    /**
     * Update (s)css files.
     */
    protected static function updateStyles()
    {
        File::copy(__DIR__.'/stubs/resources/assets/sass/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Update laravel.mix.js
     */
    protected static function updateMix()
    {
        File::copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Install all auth related parts.
     */
    protected static function installAuth()
    {
        File::cleanDirectory(base_path('database/migrations'));
        File::cleanDirectory(base_path('database/seeds'));
        File::copyDirectory(__DIR__.'/stubs/database', base_path('database'));
        File::copyDirectory(__DIR__.'/stubs/resources/views', resource_path('views'));
        File::copy(__DIR__.'/stubs/routes/web.php', base_path('routes/web.php'));

        static::createDatabase();

        Artisan::call('migrate:fresh --seed');
    }

    /**
     * Install the middlewares.
     */
    protected static function installMiddlewares()
    {
        File::copy(__DIR__.'/stubs/app/Http/Middleware/Locale.php', app_path('Http/Middleware/Locale.php'));
        File::copy(__DIR__.'/stubs/app/Http/Kernel.php', app_path('Http/Kernel.php'));
    }

    /**
     * Run several commands.
     */
    private static function runCommands()
    {
        exec('composer du -o');
        // exec('npm install && npm run dev');
    }

    /**
     * Helper for creating the new database.
     * We need to do it this way because for every statement it always tries to connect to the database in the .env file.
     */
    private static function createDatabase()
    {
        // get the default connection name, and the database name for that connection from laravel config.
        $connection = config('database.default');
        $database = config("database.connections.{$connection}.database");

        // set the database name to null so DB commands connect to raw mysql, not a database.
        config(["database.connections.{$connection}.database" => null]);

        // create the db if it doesn't exist.
        DB::statement("CREATE DATABASE IF NOT EXISTS `{$database}`");

        // reset database name and purge database-less connection from cache.
        config(["database.connections.{$connection}.database" => $database ]);
        DB::purge();
    }

    /**
     * Helper for deleting a directory.
     */
    private static function deleteDirectory($path)
    {
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }

    /**
     * Helper for making a directory.
     */
    private static function makeDirectory($path)
    {
        if (! File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}
