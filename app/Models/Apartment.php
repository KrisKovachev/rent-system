<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'address',
        'price',
        'area',
        'owner_id',
    ];
    
    public function rentalAgreements(): HasMany
    {
        return $this->hasMany(RentalAgreement::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ApartmentImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(ApartmentImage::class)->where('is_cover', true);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function rentalRequests()
    {
        return $this->hasMany(RentalRequest::class);
    }
    //CHECK FOR OCCUPIED APARTMENT
    public function isOccupied(): bool
    {
        return $this->rentalAgreements()
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                ->orWhere('end_date', '>=', now());
            })
            ->exists();
    }
    

}
