<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Facades\File;

class AssetsPreset extends Preset
{
    public static function install()
    {
        static::installFolders();
        static::installImages();
        static::installScripts();
        static::installStyles();
        static::installMix();
    }

    protected static function installFolders()
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

    protected static function installImages()
    {
        File::copyDirectory(__DIR__.'/stubs/resources/assets/img', public_path('assets/img'));
        File::delete(public_path('favicon.ico'));
    }

    protected static function installScripts()
    {
        File::copy(__DIR__.'/stubs/resources/assets/js/app.js', resource_path('assets/js/app.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap-native.js', resource_path('assets/js/bootstrap-native.js'));
        File::copy(__DIR__.'/stubs/resources/assets/js/bootstrap-vue.js', resource_path('assets/js/bootstrap-vue.js'));
    }

    protected static function installStyles()
    {
        File::copy(__DIR__.'/stubs/resources/assets/sass/app.scss', resource_path('assets/sass/app.scss'));
    }

    protected static function installMix()
    {
        File::copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }
}
