<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Perform daily database backup';

    public function handle()
    {
        $collect = collect(DB::select('SHOW TABLES'));
        $tables = $collect->sortBy(function ($table) {
            return array_values((array) $table)[0];
        })->pluck("Tables_in_" . config('database.connections.mysql.database'))->toArray();

        foreach ($tables as $table) {
            $filename = env('DB_DATABASE') . "_$table.sql";
            $currentDate = now()->format('Ymd');
            $formatDate = "Dump$currentDate";

            $storagePath = Storage::disk('backup_disk')->path($formatDate . "\\" . $filename);
            Storage::disk('backup_disk')->makeDirectory($formatDate);

            $this->info("Backing up $table to $storagePath");

            $command = sprintf(
                'mysqldump -u%s -p%s %s %s > %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                env('DB_DATABASE'),
                $table,
                $storagePath
            );

            exec($command);

            $this->info("$table backup completed.");
        }

        $this->info('Daily backup completed.');
    }
}
