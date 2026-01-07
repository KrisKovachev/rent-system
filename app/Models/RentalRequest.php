<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RentalRequest extends Model
{
    protected $fillable = [
        'apartment_id',
        'user_id',
        'start_date',
        'end_date',
        'message',
        'status',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // STORE REQUESTS FOR RENTAL
    public function store(Request $request, Apartment $apartment)
    {

        $data = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date'   => ['nullable', 'date', 'after:start_date'],
            'message'    => ['nullable', 'string', 'max:1000'],
        ]);

        return back()->with('success', 'Rental request sent successfully 🚀');
    }
}
