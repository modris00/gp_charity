<?php

namespace App\Policies;

use App\Models\Country;
use Illuminate\Auth\Access\Response;

class CountryPolicy
{
    public function before($user, string $ability): bool|null
    {
        if ($user->roles[0]->name == "Super Admin") {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-Countries');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Country $country): bool
    {
        return $user->hasPermissionTo('Show-Country');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Country');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Country $country): bool
    {
        return $user->hasPermissionTo('Update-Country');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Country $country): bool
    {
        return $user->hasPermissionTo('Delete-Country');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Country $country): bool
    {
        return $user->hasPermissionTo('Restore-Country');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Country $country): bool
    {
        return $user->hasPermissionTo('forceDelete-Country');
    }
}
