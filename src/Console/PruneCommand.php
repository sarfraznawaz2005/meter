<?php

namespace Sarfraznawaz2005\Meter\Console;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Sarfraznawaz2005\Meter\Models\MeterModel;

class PruneCommand extends Command
{
    protected $signature = 'meter:prune {--days=1 : The number of days to retain Meter data}';
    protected $description = 'Prune stale entries from the Meter database';

    public function handle(MeterModel $model)
    {
        /* @var $model Builder */
        $deleteCount = $model->whereDate('created_at', '<', now()->subDays($this->option('days')))->delete();

        $this->info($deleteCount.' entries pruned.');
    }
}
