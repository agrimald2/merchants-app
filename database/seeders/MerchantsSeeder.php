<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Merchant;

class MerchantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juan Perez',
            'username' => 'mercaderista',
            'password' => bcrypt('123456789'),
            'role_id' => 2
        ]);
        
        Merchant::create([
            'user_id' => $user->id,
            'dni' => '77035606',
            'phone' => '934094501',
        ]);
    }
}
