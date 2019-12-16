<?php

namespace Sarfraznawaz2005\Meter\Console;

use Illuminate\Console\Command;

class PruneCommand extends Command
{
    protected $signature = 'meter:prune {--hours=24 : The number of hours to retain Meter data}';
    protected $description = 'Prune stale entries from the Meter database';

    public function handle()
    {
        $this->info('entries pruned.');
    }
}
