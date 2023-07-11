<?php

namespace App\Policies;

use App\Models\Service;
use Illuminate\Auth\Access\Response;

class ServicePolicy
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
        return $user->hasPermissionTo('Index-Services');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Service $service): bool
    {
        return $user->hasPermissionTo('Show-Service');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Service');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Service $service): bool
    {
        return $user->hasPermissionTo('Update-Service');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Service $service): bool
    {
        return $user->hasPermissionTo('Delete-Service');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Service $service): bool
    {
        return $user->hasPermissionTo('Restore-Service');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Service $service): bool
    {
        return $user->hasPermissionTo('forceDelete-Service');
    }
}
