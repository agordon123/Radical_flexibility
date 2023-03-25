<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::all();
        return Inertia::render('donors.index', compact('donors'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate();
        return inertia('Donor/Create','donors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:donors',
        ]);

        $donor = Donor::create($validatedData);

        return redirect()->route('donors.index')
            ->with('success', 'Donor created successfully.');
    }

    public function edit(Donor $donor)
    {
        return Inertia::render('donors.edit', compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:donors,email,' . $donor->id,
        ]);

        $donor->update($validatedData);

        return redirect()->route('donors.index')
            ->with('success', 'Donor updated successfully.');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Donor deleted successfully.');
    }
}