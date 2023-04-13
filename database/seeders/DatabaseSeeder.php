<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    

        \App\Models\StripeProduct::factory(1)->create([
            'stripe_product_id'=> 'prod_Nhm8Am71IGOEDl',
            'product_name'=>'Painting-HQ',
            'price'=>'price_1MwMagDxs152QbBrGMdILpS6',

        ]);
        \App\Models\StripeProduct::factory(1)->create([
            'stripe_product_id'=> 'prod_NXp35SmdW4x1gB',
            'product_name'=>'Painting-LE',
            'price'=>'price_1MmjPADxs152QbBrk0F4pUyA',

        ]);
        \App\Models\StripeProduct::factory(1)->create([
            'stripe_product_id'=> 'prod_NfKaH2Ox4Bz7BT',
            'product_name'=>'Donation',
            'price'=>'price_1MtzviDxs152QbBrS7t5EjJL',

        ]);
    }
}
