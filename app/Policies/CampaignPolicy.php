<?php

namespace App\Policies;

use App\Models\Campaign;
use Illuminate\Auth\Access\Response;

class CampaignPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-Campaigns');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Campaign $campaign): bool
    {
        return $user->hasPermissionTo('Show-Campaign');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Campaign');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Campaign $campaign): bool
    {
        return $user->hasPermissionTo('Update-Campaign');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Campaign $campaign): bool
    {
        return $user->hasPermissionTo('Delete-Campaign');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Campaign $campaign): bool
    {
        return $user->hasPermissionTo('Restore-Campaign');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Campaign $campaign): bool
    {
        return $user->hasPermissionTo('forceDelete-Campaign');
    }
}
