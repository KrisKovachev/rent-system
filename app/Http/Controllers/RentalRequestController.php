<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\RentalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalRequestController extends Controller
{
    //STORE FOR REQUESTING RENTAL OF APARTMENT
    public function store(Request $request, Apartment $apartment)
    {
        $data = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
            'message'    => ['nullable', 'string', 'max:1000'],
        ]);

        RentalRequest::create([
            'apartment_id' => $apartment->id,
            'tenant_id'      => Auth::id(),
            'start_date'   => $data['start_date'],
            'end_date'     => $data['end_date'] ?? null,
            'message'      => $data['message'] ?? null,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Rental request sent successfully.');
    }
    
}
