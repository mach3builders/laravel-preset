<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Facades\File;

class AppPreset extends Preset
{
    public static function install()
    {
        static::installTranslations();
        static::installModels();
        static::installMail();
        static::installControllers();
        static::installMiddlewares();
        static::installRequests();
    }

    protected static function installControllers()
    {
        File::delete(app_path('Http/Controllers/HomeController.php'));
        File::copyDirectory(__DIR__.'/stubs/app/Http/Controllers', app_path('Http/Controllers'));
    }

    protected static function installMiddlewares()
    {
        File::copy(__DIR__.'/stubs/app/Http/Middleware/DetermineLocale.php', app_path('Http/Middleware/DetermineLocale.php'));
        File::copy(__DIR__.'/stubs/app/Http/Kernel.php', app_path('Http/Kernel.php'));
    }

    protected static function installMail()
    {
        File::copyDirectory(__DIR__.'/stubs/app/Mail', app_path('Mail'));
    }

    protected static function installModels()
    {
        File::copy(__DIR__.'/stubs/app/Account.php', app_path('Account.php'));
        File::copy(__DIR__.'/stubs/app/User.php', app_path('User.php'));
    }

    protected static function installRequests()
    {
        File::copyDirectory(__DIR__.'/stubs/app/Http/Requests', app_path('Http/Requests'));
    }

    protected static function installTranslations()
    {
        File::copyDirectory(resource_path('lang/en'), resource_path('lang/nl'));
        File::copyDirectory(__DIR__.'/stubs/resources/lang/en', resource_path('lang/en'));
        File::copyDirectory(__DIR__.'/stubs/resources/lang/nl', resource_path('lang/nl'));
    }
}
