<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RentalRequest extends Model
{
    protected $fillable = [
        'apartment_id',
        'tenant_id',
        'start_date',
        'end_date',
        'message',
        'status',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
}
