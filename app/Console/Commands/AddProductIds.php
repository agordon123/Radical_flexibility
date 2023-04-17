<?php

namespace App\Console\Commands;

use App\Models\Painting;
use App\Models\StripeProduct;
use Illuminate\Console\Command;

class AddProductIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-product-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add ProductID to Paintings';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Get all paintings and products from the database
        $paintings = Painting::all();
        $products = StripeProduct::all();

        // Loop through each painting and assign alternating product IDs
        $productId = null;
        foreach ($paintings as $painting) {
            if ($productId === null || $productId === $products[1]->id) {
                $productId = $products[0]->id;
            } else {
                $productId = $products[1]->id;
            }
            $painting->product_id = $productId;
            $painting->save();
        }

        // Output a success message
        $this->info('Product IDs assigned successfully.');
    }
}
