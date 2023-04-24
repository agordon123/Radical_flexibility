<?php

namespace App\Console\Commands;

use App\Models\Painting;
use App\Models\StripeProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SaveImagesToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:save-to-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save image information from the storage directory to the database';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Set the directory path
        $directory = 'public'; // For 'storage/app/public' directory
// $directory = 'assets/storage'; // For 'public/assets/storage' directory

// Get all image files in the directory
        $files = Storage::files($directory);
        $products = StripeProduct::all();
// Iterate through the image files
        foreach ($files as $file) {
            // Get the public URL for the stored image
            $publicUrl = Storage::url($file);

            // Check if the image already exists in the database
            $existingImage = Painting::where('filename', $publicUrl)->first();

            // If the image doesn't exist in the database, save its information
            if (!$existingImage) {
                $image = new Painting();
                $image->filename = $publicUrl;
                $image->save();

                $this->info("Saved image to database: {$publicUrl}");
            } else {
                $this->info("Image already exists in the database: {$publicUrl}");
            }
        }

        $this->info('Image saving process completed.');

    }
}
