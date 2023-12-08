<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (!function_exists('node')) {
            function node(string $nodeName): \App\Node\AbstractNode
            {
                // 將點號替換為斜杠，加上命名空間前綴，並返回對應的 Node 類
                $nodeClass = 'App\\Node\\' . str_replace('.', '\\', $nodeName) . '.php';

                return app($nodeClass);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
