<?php

namespace App\Http\Middleware;

use Closure;

use Stripe\Stripe;

class StripeMiddleware
{
    public function handle($request, Closure $next)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return $next($request);
    }
}
