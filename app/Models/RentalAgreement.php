<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalAgreement extends Model
{
    protected $fillable = [
        'apartment_id', 
        'user_id', 
        'start_date', 
        'end_date', 
        'status'
    ];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // CHECK FOR OVERLAPPING RENTAL AGREEMENTS
    public static function overlapsForApartment(
    int $apartmentId,
    string $startDate,
    ?string $endDate,
    ?int $ignoreId = null
    ): bool {
        $end = $endDate ?? '9999-12-31';

        return self::query()
            ->where('apartment_id', $apartmentId)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->where('start_date', '<=', $end)
            ->where(function ($q) use ($startDate) {
                $q->whereNull('end_date')
                ->orWhere('end_date', '>=', $startDate);
            })
            ->exists();
    }



}
