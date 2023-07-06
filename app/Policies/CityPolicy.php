<?php

namespace App\Policies;

use App\Models\City;
use Illuminate\Auth\Access\Response;

class CityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-Cities');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, City $city): bool
    {
        return $user->hasPermissionTo('Show-City');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-City');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, City $city): bool
    {
        return $user->hasPermissionTo('Update-City');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, City $city): bool
    {
        return $user->hasPermissionTo('Delete-City');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, City $city): bool
    {
        return $user->hasPermissionTo('Restore-City');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, City $city): bool
    {
        return $user->hasPermissionTo('forceDelete-City');
    }
}
