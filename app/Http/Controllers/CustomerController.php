<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string', 'stripe_id' => 'required|string','email'=>'required|string',
        ]);
        $customer = new Customer();
        $input = $request->all();
        foreach($input as $key){

        }
    }
}
