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
        $merchants = [
            ['name' => 'Juan Perez', 'username' => '77035606', 'dni' => '77035606', 'phone' => '934094501', 'location_id' => 1],
            ['name' => 'Maria Lopez', 'username' => '77035607', 'dni' => '77035607', 'phone' => '934094502', 'location_id' => 2],
            ['name' => 'Carlos Sanchez', 'username' => '77035608', 'dni' => '77035608', 'phone' => '934094503', 'location_id' => 3],
            ['name' => 'Ana Martinez', 'username' => '77035609', 'dni' => '77035609', 'phone' => '934094504', 'location_id' => 4],
            ['name' => 'Luis Gomez', 'username' => '77035610', 'dni' => '77035610', 'phone' => '934094505', 'location_id' => 5],
        ];

        foreach ($merchants as $merchantData) {
            $user = User::create([
                'name' => $merchantData['name'],
                'username' => $merchantData['username'],
                'password' => bcrypt('123456789'),
                'role_id' => 2
            ]);

            Merchant::create([
                'user_id' => $user->id,
                'dni' => $merchantData['dni'],
                'phone' => $merchantData['phone'],
                'location_id' => $merchantData['location_id'],
            ]);
        }
    }
}
