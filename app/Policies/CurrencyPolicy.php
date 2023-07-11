<?php

namespace App\Policies;

use App\Models\Currency;
use Illuminate\Auth\Access\Response;

class CurrencyPolicy
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
        return $user->hasPermissionTo('Index-Currencies');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Currency $currency): bool
    {
        return $user->hasPermissionTo('Show-Currency');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Currency');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Currency $currency): bool
    {
        return $user->hasPermissionTo('Update-Currency');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Currency $currency): bool
    {
        return $user->hasPermissionTo('Delete-Currency');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Currency $currency): bool
    {
        return $user->hasPermissionTo('Restore-Currency');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Currency $currency): bool
    {
        return $user->hasPermissionTo('forceDelete-Currency');
    }
}
