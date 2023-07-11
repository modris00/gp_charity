<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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
        return $user->hasPermissionTo('Index-Categories');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Category $category): bool
    {
        return $user->hasPermissionTo('Show-Category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Category $category): bool
    {
        return $user->hasPermissionTo('Update-Category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Category $category): bool
    {
        return $user->hasPermissionTo('Delete-Category');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Category $category): bool
    {
        return $user->hasPermissionTo('Restore-Category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Category $category): bool
    {
        return $user->hasPermissionTo('forceDelete-Category');
    }
}
