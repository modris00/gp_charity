<?php

namespace App\Policies;

use App\Models\Area;
use Illuminate\Auth\Access\Response;

class AreaPolicy
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
        return $user->hasPermissionTo('Index-Areas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Area $area): bool
    {
        return $user->hasPermissionTo('Show-Area');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Area');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Area $area): bool
    {
        return $user->hasPermissionTo('Update-Area');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Area $area): bool
    {
        return $user->hasPermissionTo('Delete-Area');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Area $area): bool
    {
        return $user->hasPermissionTo('Restore-Area');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Area $area): bool
    {
        return $user->hasPermissionTo('forceDelete-Area');
    }
}
