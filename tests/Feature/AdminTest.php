<?php

namespace Tests\Feature;


use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * Test permission
     */
    use RefreshDatabase;

    public function test_admin()
    {
            // 创建一个具有 admin 角色的用户
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        // 登录该用户
        $this->actingAs($adminUser);

        // 获取所有以 /admin 开头的路由
        $adminRoutes = collect(Route::getRoutes())->filter(function ($route) {
            return strpos($route->uri(), 'admin') === 0;
        })->pluck('uri')->toArray();

        // 遍历路由并测试用户是否能够访问
        foreach ($adminRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }
}
