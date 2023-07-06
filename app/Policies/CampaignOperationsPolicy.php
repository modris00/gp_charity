<?php

namespace App\Policies;

use App\Models\CampaignOperations;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampaignOperationsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        //
        //  return $admin->hasPermissionTo('Index-Category');

        return $user->hasPermissionTo("Index-CampaignOperations");
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, CampaignOperations $campaign_operation): bool
    {
        //
        return $user->hasPermissionTo("Show-CampaignOperation");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        //
        return $user->hasPermissionTo("Create-CampaignOperation");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, CampaignOperations $campaign_operation): bool
    {
        //
        return $user->hasPermissionTo("Update-CampaignOperation");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, CampaignOperations $campaign_operation): bool
    {
        //
        return $user->hasPermissionTo("Delete-CampaignOperation");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, CampaignOperations $campaign_operation): bool
    {
        //
        return $user->hasPermissionTo("Restore-CampaignOperation");
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CampaignOperations $campaign_operation): bool
    {
        //
        return $user->hasPermissionTo("forceDelete-CampaignOperation");
    }
}
