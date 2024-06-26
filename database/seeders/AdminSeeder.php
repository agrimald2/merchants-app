<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alonso Grimaldo',
            'email' => 'admin@latech.lat',
            'password' => bcrypt('123456789'),
            'role_id' => 1
        ]);

        Admin::create([
            'user_id' => $user->id,
        ]);
    }
}
