<?php

namespace App\Policies;

use App\Models\CampaignsBeneficiaries;
use Illuminate\Auth\Access\Response;

class CampaignsBeneficiariesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-CampaignsBeneficiaries');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, CampaignsBeneficiaries $campaignsBeneficiaries): bool
    {
        return $user->hasPermissionTo('Show-CampaignBeneficiary');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-CampaignBeneficiary');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, CampaignsBeneficiaries $campaignsBeneficiaries): bool
    {
        return $user->hasPermissionTo('Update-CampaignBeneficiary');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, CampaignsBeneficiaries $campaignsBeneficiaries): bool
    {
        return $user->hasPermissionTo('Delete-CampaignBeneficiary');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, CampaignsBeneficiaries $campaignsBeneficiaries): bool
    {
        return $user->hasPermissionTo('Restore-CampaignBeneficiary');

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, CampaignsBeneficiaries $campaignsBeneficiaries): bool
    {
        return $user->hasPermissionTo('forceDelete-CampaignBeneficiary');

    }
}
