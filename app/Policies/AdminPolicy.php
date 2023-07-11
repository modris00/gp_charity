<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class AdminPolicy
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

        // return true;
        return $user->hasPermissionTo('Index-Admins');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Admin $admin): bool
    {
        //
        return $user->hasPermissionTo('Show-Admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        //
        return $user->hasPermissionTo('Create-Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Admin $admin): bool
    {
        //
        return $user->hasPermissionTo('Update-Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Admin $admin): bool
    {
        //
        return $user->hasPermissionTo('Delete-Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Admin $admin): bool
    {
        //
        return $user->hasPermissionTo('Restore-Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Admin $admin): bool
    {
        //
        return $user->hasPermissionTo('forceDelete-Admin');
    }
}
