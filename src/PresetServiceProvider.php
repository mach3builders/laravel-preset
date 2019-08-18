<?php

namespace Mach3builders\Preset;

use Mach3builders\Preset\Preset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class PresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('mach3builders', function ($command) {
            Preset::install();

            $command->info('Mach3Builders UI scaffolding installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
