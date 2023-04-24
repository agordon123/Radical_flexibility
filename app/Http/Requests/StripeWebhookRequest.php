<?php

namespace App\Http\Requests;

use App\Listeners\StripeEventListener;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Cashier\Events\WebhookReceived;



class StripeWebhookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            $event = StripeEventListener::class,
            WebhookReceived::dispatch($event),
            dd($event)
        ];
    }
}
