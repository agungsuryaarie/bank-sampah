<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@sampah.com',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Bendahara User',
                'email' => 'bendahara@sampah.com',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Pengurus User',
                'email' => 'pengurus@sampah.com',
                'type' => 3,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Nasabah User',
                'email' => 'nasabah@sampah.com',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
