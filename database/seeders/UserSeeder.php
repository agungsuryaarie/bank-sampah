<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@sampah.com',
                'alamat' => 'Indrapura',
                'nohp' => '08123456789',
                'type' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Bendahara Keuangan',
                'username' => 'bendahara',
                'email' => 'bendahara@sampah.com',
                'alamat' => 'Indrapura',
                'nohp' => '08123456789',
                'type' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Pengurus',
                'username' => 'pengurus',
                'email' => 'pengurus@sampah.com',
                'alamat' => 'Indrapura',
                'nohp' => '08123456789',
                'type' => 3,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Zulfahmi',
                'username' => 'nasabah',
                'email' => 'nasabah@sampah.com',
                'alamat' => 'Indrapura',
                'nohp' => '08123456789',
                'type' => 0,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
