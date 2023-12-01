<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class FakeUserDataSeeder extends Seeder
{
    public function run()
    {
        $fakeUsers = User::where('is_fake', true)->get();
        foreach ($fakeUsers as $user) {
            $user->deleteWithRelatedRecords();
        }

        // User::factory()->count(10)->create([
        //     'is_fake' => true,
        // ]);
    }
}
