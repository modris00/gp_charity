<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Bill;
use Illuminate\Auth\Access\Response;

class BillPolicy
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
        //
        return $user->hasPermissionTo('Index-Bills');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Bill $bill): bool
    {
        //
        return $user->hasPermissionTo('Show-Bill');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        //
        return $user->hasPermissionTo('Create-Bill');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Bill $bill): bool
    {
        //
        return $user->hasPermissionTo('Update-Bill');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Bill $bill): bool
    {
        //
        return $user->hasPermissionTo('Delete-Bill');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Bill $bill): bool
    {
        //
        return $user->hasPermissionTo('Restore-Bill');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Bill $bill): bool
    {
        //
        return $user->hasPermissionTo('forceDelete-Bill');
    }
}
