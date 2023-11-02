<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'user_id' => 2, // maria
            'phone_number' => '123456789',
            'address' => 'Calle 123, Nro. 234',
        ]);

        Customer::create([
            'user_id' => 3, // elena
            'phone_number' => '182738273',
            'address' => 'Av. Uva, Nro. 123',
        ]);

        Customer::create([
            'user_id' => 4, // miguel
            'phone_number' => '737372833',
            'address' => 'Av. Manzana, Nro. 456',
        ]);
    }
}
