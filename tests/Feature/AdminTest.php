<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Factories\UserFactory;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * Test permission
     */
    public function test_admin(): void
    {

        for($i = 0; $i < 20; $i++){

            $user = User::factory()->create();
    
            $roles = ['new_user', 'approve_user', 'admin', 'super_admin'];
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);
    
            $this->actingAs($user);
    
            $response = $this->get('/admin/category/category-create');

            $response->assertStatus(200);
            
        }

    }
}
