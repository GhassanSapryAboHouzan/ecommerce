<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => 'PayPal',
            'code' => 'PPEX',
            'driver_name' => 'PayPal_Express',
            'merchant_email' => null,
            'client_id' => null,
            'client_password' => null,
            'client_secret' => null,
            'sandbox_merchant_email' => null,
            'sandbox_client_id' => null,
            'sandbox_client_password' => null,
            'sandbox_client_secret' => null,
            'sandbox' => true,
            'status' => true,
        ]);
    }
}
