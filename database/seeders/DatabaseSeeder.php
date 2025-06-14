<?php

namespace Database\Seeders;

use App\Models\Admin\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesTableSeeder::class, // Make sure this is run before UsersTableSeeder
            UsersTableSeeder::class,
        ]);
    }
}