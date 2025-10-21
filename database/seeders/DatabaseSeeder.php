<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
           'name' => 'Abel Goncalo',
            'email' => 'abelgoncalo@admin.com',
            'phone' => '924000000',
            'profile' => 'administrador',
            'password' => Hash::make('12345678'),
        ]);




    }
}
