<?php

namespace App\Console\Commands;

use App\Domains\Data\Models\Operation;
use Illuminate\Console\Command;

class ClearOperationLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-operation-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear operation log before 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $records = Operation::where('created_at', '<', now()->subDays(15))->delete();
    }
}
