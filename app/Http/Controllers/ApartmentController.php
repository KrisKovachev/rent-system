<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{

    //LISTINGS AND FILTERS
    public function index(Request $request)
    {
        $filters = $request->validate([
            'type' => ['nullable', 'string'],
            'min_price' => ['nullable', 'numeric'],
            'max_price' => ['nullable', 'numeric'],
            'tenant_id' => ['nullable', 'exists:users,id'],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
        ]);
        $query = Apartment::query()->with('images');

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }
        if (!empty($filters['tenant_id'])) {
            $query->whereHas('rentalAgreements', function ($q) use ($filters) {
                $q->where('tenant_id', $filters['tenant_id']);
            });
        }
        if (!empty($filters['from']) || !empty($filters['to'])) {
           $from = $filters['from'] ?? '0000-01-01';
           $to   = $filters['to'] ?? '9999-12-31';
           $query->whereHas('rentalAgreements', function ($q) use ($from, $to) {
               $q->where('start_date', '<=', $to)
                  ->where(function ($q) use ($from) {
                      $q->whereNull('end_date')
                         ->orWhere('end_date', '>=', $from);
                  });
               });
        }

        return view('apartments.index', [
            'apartments' => $query->latest()->get(),
            'filters' => $filters,
            'tenants' => User::orderBy('name')->get(),
        ]);
    }

    //VIEW FOR APARTMENT DETAILS
    public function show(Apartment $apartment)
    {
        $apartment->load('images');

        return view('apartments.show', compact('apartment'));
    }

    //VIEW FOR MY APARTMENTS
    public function my()
    {
        $apartments = Apartment::where('owner_id', Auth::id())
            ->with('images')
            ->latest()
            ->get();

        return view('apartments.my', compact('apartments'));
    }

    //VIEW FOR CREATING APARTMENT
    public function create()
    {
        return view('apartments.create');
    }

    //STORE NEW APARTMENT
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'address' => 'required|string',
            'area' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'images.*' => 'image|max:4096',
        ]);

        $apartment = Apartment::create([
            'type' => $data['type'],
            'address' => $data['address'],
            'area' => $data['area'],
            'price' => $data['price'],
            'owner_id' => Auth::id(),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('apartments', 'public');
                $apartment->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('apartments.my')
            ->with('success', 'Apartment created');
    }

    //VIEW FOR APARTMENT EDIT
    public function edit(Apartment $apartment)
    {
        abort_unless($apartment->owner_id === Auth::id(), 403);

        $apartment->load('images');

        return view('apartments.edit', compact('apartment'));
    }

    //UPDATE AFTER EDIT
    public function update(Request $request, Apartment $apartment)
    {
        abort_unless($apartment->owner_id === Auth::id(), 403);

        $data = $request->validate([
            'type' => 'required|string',
            'address' => 'required|string',
            'price' => 'required|numeric',
            'area' => 'required|integer',
            'images.*' => 'image|max:4096',
        ]);
        $apartment->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('apartments', 'public');
                $apartment->images()->create(['path' => $path]);
            }
        }

        return back()->with('success', 'Apartment updated.');
    }

    //DELETE IMAGE OF APARTMENT
    public function deleteImage(Apartment $apartment, ApartmentImage $image)
    {
        abort_unless((int) $apartment->owner_id === (int) Auth::id(), 403);
        abort_unless((int) $image->apartment_id === (int) $apartment->id, 404);
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return redirect()
            ->route('apartments.edit', $apartment)
            ->with('success', 'Image deleted.');
    }

}
