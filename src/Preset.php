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
     * Install the preset
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateStyles();
        static::installAuth();
        static::installMiddlewares();
        static::updateConfig();
        static::removeNodeModules();

        exec('composer du -o');
        exec('npm install && npm run dev');
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
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
     * Update laravel.mix.js
     *
     * @return void
     */
    protected static function updateMix()
    {
        File::copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update javascript files
     *
     * @return void
     */
    protected static function updateScripts()
    {
        static::deleteDirectory(public_path('js'));
        static::deleteDirectory(resource_path('js'));
        static::makeDirectory(resource_path('assets'));
        static::makeDirectory(resource_path('assets/js'));

        File::copy(__DIR__.'/stubs/assets/js/app.js', resource_path('assets/js/app.js'));
        File::copy(__DIR__.'/stubs/assets/js/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        File::copy(__DIR__.'/stubs/assets/js/bootstrap-native.js', resource_path('assets/js/bootstrap-native.js'));
        File::copy(__DIR__.'/stubs/assets/js/bootstrap-vue.js', resource_path('assets/js/bootstrap-vue.js'));
    }

    /**
     * Update (s)css files
     *
     * @return void
     */
    protected static function updateStyles()
    {
        static::deleteDirectory(public_path('css'));
        static::deleteDirectory(resource_path('sass'));
        static::makeDirectory(resource_path('assets/sass'));
        File::copy(__DIR__.'/stubs/assets/sass/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Install the middlewares
     *
     * @return void
     */
    protected static function installMiddlewares()
    {
        File::copy(__DIR__.'/stubs/Http/Middleware/Locale.php', app_path('Http/Middleware/Locale.php'));
        File::copy(__DIR__.'/stubs/Http/Kernel.php', app_path('Http/Kernel.php'));
    }

    /**
     * Update config file
     *
     * @return void
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
     * Update the views
     *
     * @return void
     */
    protected static function installAuth()
    {
        File::cleanDirectory(base_path('database/migrations'));
        File::cleanDirectory(base_path('database/seeds'));
        File::copyDirectory(__DIR__.'/stubs/database', base_path('database'));
        File::copyDirectory(__DIR__.'/stubs/views', resource_path('views'));
        File::copyDirectory(__DIR__.'/stubs/Http/Controllers', app_path('Http/Controllers'));
        File::copy(__DIR__.'/stubs/routes/web.php', base_path('routes/web.php'));

        static::createDatabase();

        Artisan::call('migrate:fresh --seed');
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
     * Helper for deleting a directory
     */
    private static function deleteDirectory($path)
    {
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }

    /**
     * Helper for making a directory
     */
    private static function makeDirectory($path)
    {
        if (! File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}


