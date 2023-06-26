<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Beneficiary;
use Illuminate\Auth\Access\Response;

class BeneficiaryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        //
        return $user->hasPermissionTo('Index-Beneficiaries');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Beneficiary $beneficiary): bool
    {
        //
        return $user->hasPermissionTo('Show-Beneficiary');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        //
        return $user->hasPermissionTo('Create-Beneficiary');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Beneficiary $beneficiary): bool
    {
        //
        return $user->hasPermissionTo('Update-Beneficiary');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Beneficiary $beneficiary): bool
    {
        //
        return $user->hasPermissionTo('Delete-Beneficiary');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Beneficiary $beneficiary): bool
    {
        //
        return $user->hasPermissionTo('Restore-Beneficiary');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Beneficiary $beneficiary): bool
    {
        //
        return $user->hasPermissionTo('forceDelete-Beneficiary');
    }
}
