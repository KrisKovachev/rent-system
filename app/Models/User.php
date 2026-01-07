<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Models\RentalAgreement;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Apartment> $apartments
 */


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_path',
        'phone',
        'address',
        'city',
        'country',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //USER BECOMES ADMIN CHECK
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    // RELATIONSHIP FOR ONWER ID AND APARTMENTS
    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'owner_id');
    }
    // RELATIONSHIP FOR RENTAL AGREEMENTS
    public function rentalAgreements()
    {
        return $this->hasMany(RentalAgreement::class);
    }
    // ADDING AVATAR URL
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar_path && Storage::disk('public')->exists($this->avatar_path)) {
            return Storage::url($this->avatar_path);
        }

        $name = urlencode($this->name ?? 'User');
        return "https://ui-avatars.com/api/?name={$name}&background=111827&color=ffffff";
    }


}
