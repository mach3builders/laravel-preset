<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuthPreset extends Preset
{
    public static function install()
    {
        File::cleanDirectory(base_path('database/migrations'));
        File::cleanDirectory(base_path('database/seeds'));
        File::copyDirectory(__DIR__.'/stubs/database', base_path('database'));
        File::copyDirectory(__DIR__.'/stubs/resources/views', resource_path('views'));
        File::copy(__DIR__.'/stubs/routes/web.php', base_path('routes/web.php'));

        static::createDatabase();

        Artisan::call('migrate:fresh --seed');
    }

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
}
