<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::insert([
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Customer'],
            ['id' => 3, 'name' => 'Vendor'],
        ]);
    }
}
