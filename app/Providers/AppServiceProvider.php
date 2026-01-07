<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;

class ApartmentPolicy
{
    /**
     * Any authenticated user can view their properties list
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * User can view only their own apartment
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return $apartment->owner_id === $user->id;
    }

    /**
     * Any authenticated user can create apartments
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * User can update only their own apartment
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return $apartment->owner_id === $user->id;
    }

    /**
     * User can delete only their own apartment
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        return $apartment->owner_id === $user->id;
    }
}
