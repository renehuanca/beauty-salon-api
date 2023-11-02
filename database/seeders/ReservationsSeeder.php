<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // maria reservations
        Reservation::create([
            'customer_id' => 1,
            'service_id' => 1,
            'date' => '2021-10-10',
            'time' => '10:00',
            'status' => 'confirmed'
        ]);
        Reservation::create([
            'customer_id' => 1,
            'service_id' => 2,
            'date' => '2021-10-10',
            'time' => '11:00',
            'status' => 'pending'
        ]);

        // elena reservations
        Reservation::create([
            'customer_id' => 2,
            'service_id' => 1,
            'date' => '2021-10-10',
            'time' => '12:00',
            'status' => 'pending'
        ]);

        // Miguel has no reservations
    }
}
