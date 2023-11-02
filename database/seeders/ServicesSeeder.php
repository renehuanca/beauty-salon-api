<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'manicure',
            'description' => 'Manicure description',
            'price' => 30.50
        ]);
        Service::create([
            'name' => 'hair cut',
            'description' => 'Hair cut description',
            'price' => 10.00
        ]);
        Service::create([
            'name' => 'massage',
            'description' => 'Massage description',
            'price' => 15.00
        ]);
    }
}
