<?php

namespace App\Providers;

use Inertia\Inertia;
use App\Models\Customer;
use App\Models\User;
use Stripe\StripeClient;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PaintingRepository;

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
        Inertia::share([
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                ];
            },
        ]);
    }
}
