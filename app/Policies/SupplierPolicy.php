<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SupplierPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        //
        return $user->hasPermissionTo('Index-Suppliers');
    }



    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Supplier $supplier): bool
    {
        //
        return $user->hasPermissionTo('Show-Supplier');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        //
        return $user->hasPermissionTo('Create-Supplier');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Supplier $supplier): bool
    {
        //
        return $user->hasPermissionTo('Update-Supplier');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Supplier $supplier): bool
    {
        //
        return $user->hasPermissionTo('Delete-Supplier');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Supplier $supplier): bool
    {
        //
        return $user->hasPermissionTo('Restore-Supplier');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Supplier $supplier): bool
    {
        //
        return $user->hasPermissionTo('forceDelete-Supplier');
    }
}
