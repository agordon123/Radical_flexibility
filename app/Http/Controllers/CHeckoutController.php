<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CHeckoutController extends Controller
{
    public function checkoutArt(FormRequest $request)
    {
        $validatedData  = $request->validateWithBag('order', [
    'payment_intent_id' => ['required', 'unique:string', 'max:255'],
    'painting_id' => ['required'],
    'amount'=>['required']
    ]);
    }
}