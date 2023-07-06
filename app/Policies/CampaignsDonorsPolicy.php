<?php

namespace App\Policies;

use App\Models\CampaignsDonors;
use Illuminate\Auth\Access\Response;

class CampaignsDonorsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-CampaignsDonors');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, CampaignsDonors $campaignsDonors): bool
    {
        return $user->hasPermissionTo('Show-CampaignDonor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-CampaignDonor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, CampaignsDonors $campaignsDonors): bool
    {
        return $user->hasPermissionTo('Update-CampaignDonor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, CampaignsDonors $campaignsDonors): bool
    {
        return $user->hasPermissionTo('Delete-CampaignDonor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, CampaignsDonors $campaignsDonors): bool
    {
        return $user->hasPermissionTo('Restore-CampaignDonor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, CampaignsDonors $campaignsDonors): bool
    {
        return $user->hasPermissionTo('forceDelete-CampaignDonor');
    }
}
