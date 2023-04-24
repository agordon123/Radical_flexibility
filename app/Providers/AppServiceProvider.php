<?php

namespace App\Providers;

use App\Models\Customer;
use App\Repositories\PaintingRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaintingRepository::class,function (){
            return new PaintingRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(Customer::class);
    }
}
