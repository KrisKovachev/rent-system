<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    //ADMIN VIEW FOR MANAGING APARTMENTS
    public function index()
    {
        $apartments = Apartment::with('images')->latest()->get();

        return view('admin.apartments.index', compact('apartments'));
    }
    //ADMIN VIEW FOR EDDITING EVERY SSINGLE APARTMENT
    public function edit(Apartment $apartment)
    {
        $apartment->load('images');

        return view('admin.apartments.edit', compact('apartment'));
    }
    //ADMIN UPDATE AFTER EDIT
    public function update(Request $request, Apartment $apartment)
    {
        $validated = $request->validate([
            'type'       => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'price'       => 'required|numeric',
            'area'          => 'required|integer|min:1',
        ]);

        $apartment->update($validated);

        return redirect()
            ->route('admin.apartments.index')
            ->with('success', 'Apartment updated successfully.');
    }

    public function destroy(Apartment $apartment)
    {
        foreach ($apartment->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $apartment->delete();

        return redirect()
            ->route('admin.apartments.index')
            ->with('success', 'Apartment deleted successfully.');
    }
}
