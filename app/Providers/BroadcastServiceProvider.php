<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Broadcasting\Broadcasters\RedisBroadcaster;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::routes(['middleware' => ['auth:sanctum']]);

        $this->app->make(BroadcastManager::class)->extend('redis', function ($app) {
            return new RedisBroadcaster($app['redis']);
        });
    }
}
