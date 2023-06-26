<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ContactRequest;
use Illuminate\Auth\Access\Response;

class ContactRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-ContactRequests');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, ContactRequest $contactRequest): bool
    {
        return $user->hasPermissionTo('Show-ContactRequest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-ContactRequest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, ContactRequest $contactRequest): bool
    {
        return $user->hasPermissionTo('Update-ContactRequest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, ContactRequest $contactRequest): bool
    {
        return $user->hasPermissionTo('Delete-ContactRequest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, ContactRequest $contactRequest): bool
    {
        return $user->hasPermissionTo('Restore-ContactRequest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, ContactRequest $contactRequest): bool
    {
        return $user->hasPermissionTo('forceDelete-ContactRequest');
    }
}
