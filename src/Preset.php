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
            ['@mach3builders/ui' => '^1.2'],
            Arr::except($packages, [
                'bootstrap',
                'lodash',
                'popper.js',
                'jquery',
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
        File::copy(__DIR__.'/stubs/js/app.js', resource_path('js/app.js'));
        File::copy(__DIR__.'/stubs/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    /**
     * Update (s)css files
     *
     * @return void
     */
    protected static function updateStyles()
    {
        File::copy(__DIR__.'/stubs/sass/app.scss', resource_path('sass/app.scss'));
        File::delete(resource_path('sass/_variables.scss'));
    }
}


