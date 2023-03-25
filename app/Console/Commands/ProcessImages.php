<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProcessImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = storage_path('app/public');
        $images = collect(File::allFiles($path))->map(function ($image) use ($path) {
        return [
            'filename' => $image->getFilename(),
            'path' => str_replace($path, '', $image->getRealPath()),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    });

    DB::table('images')->insert($images->toArray());
    }
}