<?php

namespace App\Policies;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DonorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-Donors');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Donor $donor): bool
    {
        return $user->hasPermissionTo('Show-Donor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Donor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Donor $donor): bool
    {
        return $user->hasPermissionTo('Update-Donor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Donor $donor): bool
    {
        return $user->hasPermissionTo('Delete-Donor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Donor $donor): bool
    {
        return $user->hasPermissionTo('Restore-Donor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Donor $donor): bool
    {
        return $user->hasPermissionTo('forceDelete-Donor');
    }
    public function campaigns($user): bool
    {

        return $user->hasPermissionTo('Show-Campaign');
    }
}
