<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
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
        static::removeNodeModules();
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
            ['@mach3builders/ui' => '^1.3.3'],
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
        static::deleteDirectory(resource_path('sass'));
        static::makeDirectory(resource_path('assets/sass'));
        File::copy(__DIR__.'/stubs/assets/sass/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Update the views
     *
     * @return void
     */
    protected static function updateViews()
    {
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
        File::copy(__DIR__.'/stubs/routes/web.php', base_path('routes/web.php'));
        File::copy(__DIR__.'/stubs/Controllers/HomeController.php', app_path('Http/Controllers/HomeController.php'));
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


