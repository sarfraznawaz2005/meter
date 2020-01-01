<?php

namespace Sarfraznawaz2005\Meter\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'meter:publish {--force : Overwrite any existing files}';
    protected $description = 'Publish all of the Meter resources.';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'meter-config',
            '--force' => $this->option('force'),
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'meter-views',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'meter-assets',
            '--force' => true,
        ]);
    }
}
