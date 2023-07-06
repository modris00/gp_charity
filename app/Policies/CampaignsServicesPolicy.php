<?php

namespace App\Policies;

use App\Models\CampaignsServices;
use Illuminate\Auth\Access\Response;

class CampaignsServicesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-CampaignsServices');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, CampaignsServices $campaignsServices): bool
    {
        return $user->hasPermissionTo('Show-CampaignService');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-CampaignService');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, CampaignsServices $campaignsServices): bool
    {
        return $user->hasPermissionTo('Update-CampaignService');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, CampaignsServices $campaignsServices): bool
    {
        return $user->hasPermissionTo('Delete-CampaignService');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, CampaignsServices $campaignsServices): bool
    {
        return $user->hasPermissionTo('Restore-CampaignService');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, CampaignsServices $campaignsServices): bool
    {
        return $user->hasPermissionTo('forceDelete-CampaignService');
    }
}
