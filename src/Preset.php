<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function install()
    {
        static::removeNodeModules();

        ConfigPreset::install();
        AppPreset::install();
        AssetsPreset::install();
        AuthPreset::install();
        CommandsPreset::install();
    }

    protected static function deleteDirectory($path)
    {
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }

    protected static function makeDirectory($path)
    {
        if (! File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}
