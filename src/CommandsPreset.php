<?php

namespace Mach3builders\Preset;

class CommandsPreset extends Preset
{
    public static function install()
    {
        exec('composer du -o');
        // exec('npm install && npm run dev');
    }
}
