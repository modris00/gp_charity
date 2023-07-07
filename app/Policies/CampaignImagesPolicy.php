<?php

namespace App\Policies;

use App\Models\CampaignImages;
use Illuminate\Auth\Access\Response;

class CampaignImagesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-CampaignImages');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, CampaignImages $campaignImages): bool
    {
        return $user->hasPermissionTo('Show-CampaignImage');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-CampaignImage');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, CampaignImages $campaignImages): bool
    {
        return $user->hasPermissionTo('Update-CampaignImage');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, CampaignImages $campaignImages): bool
    {
        return $user->hasPermissionTo('Delete-CampaignImage');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, CampaignImages $campaignImages): bool
    {
        return $user->hasPermissionTo('Restore-CampaignImage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, CampaignImages $campaignImages): bool
    {
        return $user->hasPermissionTo('forceDelete-CampaignImage');
    }
}
