<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'administrator',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('!9a7P"^N#q')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name'     => 'user',
            'email'    => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $user->assignRole('user');
    }
}
