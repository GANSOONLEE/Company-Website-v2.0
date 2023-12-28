<?php

namespace App\Domains\Data\Services;

use App\Domains\Data\Models\Operation;

use App\Services\BaseService;

// Laravel Support
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DataService extends BaseService
{
    public function __construct(Operation $operation)
    {
        $this->model = $operation;
    }

    public function getTablesFromSQL(): mixed
    {
        $collect = collect(DB::select('SHOW TABLES'));
        return $collect->sortBy(function ($table) {
            return array_values((array) $table)[0];
        })->pluck('Tables_in_frozen_aircond_development')->toArray();
    }

    /**
     * Import Table data from sql
     * @param array $tables
     * @return mixed
     */
    public function importWithSQL(array $tables = []): mixed
    {
        $databaseName = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        foreach ($tables as $index => $table)
        {
            $filePath = $table->getRealPath();

            // check are upload false
            if(strpos($table->getClientOriginalName(),  $databaseName) < 0)
            {
               continue;
            }
            
            // check are upload false
            if(strpos($table->getClientOriginalName(),  $this->getTablesFromSQL()[$index]) < 0)
            {
               continue;
            }

            // 构建 mysql 导入命令
            $command = sprintf(
                'mysql -u%s -p%s %s < %s',
                $username,
                $password,
                $databaseName,
                $filePath
            );
    
            // 使用 exec 函数执行命令
            exec($command);

        }

        return $tables;
    }

    /**
     * Export Table data to sql
     * @param array $tables
     * @return mixed
     */
    public function exportWithSQL(array $tables = []): mixed
    {

        $storagePathArray = [];

        try{
            foreach ($tables as $table)
            {
                $filename = env('DB_DATABASE') . "_$table.sql";
                $currentDate = now()->format('Ymd');
                $formatDate = "Dump$currentDate";
    
                $storagePath = Storage::disk('backup_disk')->path($formatDate . "\\" . $filename);
                Storage::disk('backup_disk')->makeDirectory($formatDate);
                
                $storagePathArray[] = $storagePath;

                $command = sprintf(
                    'mysqldump -u%s -p%s %s %s >> %s',
                    config('database.connections.mysql.username'),
                    config('database.connections.mysql.password'),
                    env('DB_DATABASE'),
                    $table,
                    $storagePath
                );

                exec($command);
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return false;
        }

        return $storagePathArray;
    }

    /**
     * Search operation record
     * @param string $searchTerm
     * @return mixed
     */
    public function search(string $searchTerm): mixed
    {
        return Operation::where(function ($query) use ($searchTerm) {
                            $query->where('operation_type', 'like', "%$searchTerm%")
                                ->orWhere('operation_category', 'like', "%$searchTerm%")
                                ->orWhere('operation_detail', 'like', "%$searchTerm%")
                                ->orWhere('email', 'like', "%$searchTerm%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->groupBy('id')
                        ->paginate(10)
                        ->withQueryString();
    }
}