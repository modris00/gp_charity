<?php

namespace App\Policies;

use App\Models\SubCategory;
use Illuminate\Auth\Access\Response;

class SubCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-SubCategoris');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, SubCategory $subCategory): bool
    {
        return $user->hasPermissionTo('Show-SubCategory');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-SubCategory');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, SubCategory $subCategory): bool
    {
        return $user->hasPermissionTo('Update-SubCategory');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, SubCategory $subCategory): bool
    {
        return $user->hasPermissionTo('Delete-SubCategory');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, SubCategory $subCategory): bool
    {
        return $user->hasPermissionTo('Restore-SubCategory');

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, SubCategory $subCategory): bool
    {
        return $user->hasPermissionTo('forceDelete-SubCategory');
    }
}
