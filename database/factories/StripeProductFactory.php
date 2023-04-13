<?php

namespace Database\Factories;

use Faker\Core\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StripeProduct>
 */
class StripeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stripe_product_id'=> 'prod_Nhm8Am71IGOEDl',
            'product_name'=>'Painting-HQ',
            'price'=>'price_1MwMagDxs152QbBrGMdILpS6',
            'currency'=>'usd'
        ];
    }
}
