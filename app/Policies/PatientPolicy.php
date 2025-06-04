<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class PatientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role !== 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Patient $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role !== 'fbaf263c-fd8b-3d08-931c-740fa0a1f743';
    }

    /**
     * Determine whether the user can update the model.
     */
    //TODO
//    public function update(User $user, Patient $patient): bool
//    {
//        return $user->role === 'fbaf263c-fd8b-3d08-931c-740fa0a1f743';
//    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Patient $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Patient $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Patient $patient): bool
    {
        return false;
    }
}
