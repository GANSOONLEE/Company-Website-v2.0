<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class Operation extends Model
{
    use HasFactory;

    protected $table = "operations";
    protected $fillable = [
        'email',
        'operation_type',
        'operation_category'
    ];

    public function getUserByOperation(){
        return User::where('email', $this->email)->first();
    }

    // Get Operation Details

    protected $tables = [
        'Product' => 'products',
        'Category' => 'categories',
        'Brand' => 'brands',
        'Permission' => 'roles_permissions',
        'Order' => 'orders',
    ];

    protected $data = [
        'Product' => 'product_code',
        'Category' => 'name',
        'Brand' => 'name',
        'Permission' => 'permission_name',
        'Order' => 'code',
    ];

    /**
     * 
     */

    public function build(){
        $category = $this->operation_category;
        $operation_time = $this->created_at;

        return $this->getOperationDetail($category, $operation_time);
    }

    public function getOperationDetail($category, $operation_time){
        $table = $this->tables[$category];
        $date = date('Y-m-d H:i:s', $operation_time->timestamp);
        $queryBuilder = DB::table($table);
        $resultArray = $queryBuilder->where('created_at', $operation_time)
            ->pluck($this->data[$category])
            ->toArray();
        
        return implode(', ', $resultArray);
    }

}