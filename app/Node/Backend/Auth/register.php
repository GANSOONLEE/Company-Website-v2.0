<?php

namespace App\Node\Backend\Auth;
use App\Node\AbstractNode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Register extends AbstractNode{
    
    public function __construct(){

    }

    public function __call($fun, $args){

    }

    /**
     * @param string $query
     * @param object $model
     * @param string $column
     * @return void
     */
    
     
    public function unique(string $query, string $modelClassName, ?string $column=null): void{

        $model = resolve($modelClassName); 
        $column = $column ?: $model->getKeyName();
        $result =  $model->where($column, $query)->exists();

        // Verify Args Validation
        if(!is_subclass_of($model, Model::class)){
           throw new \InvalidArgumentException("\$modelClassName must be extends by Model Class!");
        };
        if(!is_string($column)){
            throw new \InvalidArgumentException("\$column must be string or null, but get " .gettype($column));
        };
        
        !$result?:throw new \Exception("Duplication Record");
        
        try{
            return;
        }catch(ModelNotFoundException $e){
            throw new \Exception("Model $model can't found", 500, $e);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 500);
        }

    }

}