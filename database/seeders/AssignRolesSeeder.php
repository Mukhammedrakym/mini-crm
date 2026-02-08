<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@test.kz')->first();
        $manager = User::where('email', 'manager@test.kz')->first();
        $admin->assignRole('admin');
        $manager->assignRole('manager');
    }
}
