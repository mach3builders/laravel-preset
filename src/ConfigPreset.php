<?php

namespace Mach3builders\Preset;

use Illuminate\Support\Arr;

class ConfigPreset extends Preset
{
    public static function install()
    {
        static::installEnv();
        static::installPackages();
        static::installConfig();
    }

    protected static function installEnv()
    {
        $content = file_get_contents(base_path('.env'));

        $pattern = '/APP_NAME=(.*)+/';
        $replacement = "APP_NAME=Mach3Builders";
        $content = preg_replace($pattern, $replacement, $content);

        $pattern = '/MAIL_HOST=(.*)+/';
        $replacement = "MAIL_HOST=smtp.gmail.com";
        $content = preg_replace($pattern, $replacement, $content);

        $pattern = '/MAIL_PORT=(.*)+/';
        $replacement = "MAIL_PORT=25";
        $content = preg_replace($pattern, $replacement, $content);

        $pattern = '/MAIL_USERNAME=(.*)+/';
        $replacement = "MAIL_USERNAME=mach3builders";
        $content = preg_replace($pattern, $replacement, $content);

        $pattern = '/MAIL_PASSWORD=(.*)+/';
        $replacement = "MAIL_PASSWORD=Mach123Fastest";
        $content = preg_replace($pattern, $replacement, $content);

        $pattern = '/MAIL_ENCRYPTION=(.*)+/';
        $replacement = "MAIL_ENCRYPTION=tls";
        $content = preg_replace($pattern, $replacement, $content);

        if (!stristr($content, 'APP_EMAIL_FROM')) {
            $pattern = '/APP_URL=(.*)/';
            $replacement = "APP_URL=$1\nAPP_EMAIL_FROM=info@mach3builders.nl";
            $content = preg_replace($pattern, $replacement, $content);
        }

        file_put_contents(base_path('.env'), $content);
    }

    protected static function installPackages()
    {
        static::updatePackages();
    }

    protected static function installConfig()
    {
        $content = file_get_contents(base_path('config/app.php'));
        $pattern = '/\'locale\' => \'([a-z]+)\',/';
        $replacement = "'locale' => 'nl',\n    'locales' => ['nl', 'en'],";
        $content = preg_replace($pattern, $replacement, $content);

        file_put_contents(base_path('config/app.php'), $content);
    }

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
}
