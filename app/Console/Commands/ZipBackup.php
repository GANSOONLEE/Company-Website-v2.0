<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipBackup extends Command
{
    protected $signature = 'backup:zip';
    protected $description = 'Zip files in public disk and move to backup disk';

    public function handle()
    {
        $currentDate = now()->format('Ymd');
        $formatDate = "Dump$currentDate";

        $publicDiskPath = Storage::disk('public')->path('/');
        $backupDiskPath = Storage::disk('backup_disk')->path($formatDate . '\\backup.zip');

        $zip = new ZipArchive;
        if ($zip->open($backupDiskPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = Storage::disk('public')->allFiles();
            foreach ($files as $file) {
                $zip->addFile($publicDiskPath . $file, $file);
            }
            $zip->close();

            $this->info('Files zipped and moved to backup disk successfully.');
        } else {
            $this->error('Failed to create or open the zip archive.');
        }
    }
}
