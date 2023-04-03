<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'edit_url' => route('users.edit', $user),
                ];
            }),
            'create_url' => route('users.create'),
        ]);
    }
    public function show(Request $request)
    {

    }
    public function update(Request $request)
    {
        $user = $request->user;
    }
    public function delete(Request $request)
    {

    }
}
