<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = CheckoutSession::all();
        return response()->json(['sessions'=>$sessions]);
    }
    public function create(Request $request)
    {
        $validated = Validator::validate($request->all(),[
            'checkout_session_object' => 'required|json'
        ]);
        $object = $request->input('checkout_session_id');
        $session = new CheckoutSession();
    }
    public function update(CheckoutSession $session,$id)
    {
        $session = CheckoutSession::findOrFail($id);

    }
}
