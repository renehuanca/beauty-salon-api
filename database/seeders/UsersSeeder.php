<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);


        // Customers
        User::create([
            'name' => 'maria',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('maria'),
            'role' => 'customer',
        ]);
        User::create([
            'name' => 'elena',
            'email' => 'elena@gmail.com',
            'password' => bcrypt('elena'),
            'role' => 'customer',
        ]);
        User::create([
            'name' => 'miguel',
            'email' => 'miguel@gmail.com',
            'password' => bcrypt('miguel'),
            'role' => 'customer',
        ]);
    }
}
