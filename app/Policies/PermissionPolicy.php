<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
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
        return $user->hasPermissionTo('Index-Permissions');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Permission $permission): bool
    {
        return $user->hasPermissionTo('Show-Permission');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Permission $permission): bool
    {
        return $user->hasPermissionTo('Update-Permission');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Permission $permission): bool
    {
        return $user->hasPermissionTo('Delete-Permission');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore($user, Permission $permission): bool
    // {
    //     return $user->hasPermissionTo('Restore-Permission');
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete($user, Permission $permission): bool
    // {
    //     return $user->hasPermissionTo('forceDelete-Permission');
    // }
}
