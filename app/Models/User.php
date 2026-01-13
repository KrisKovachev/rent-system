<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use App\Models\RentalAgreement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar_path',
        'phone',
        'address',
        'city',
        'country',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
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
        return $this->hasMany(RentalAgreement::class, 'tenant_id');
    }
    //RENTAL REQUESTS RELATIONSHIP
    public function rentalRequests()
    {
        return $this->hasMany(RentalRequest::class, 'tenant_id');
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
