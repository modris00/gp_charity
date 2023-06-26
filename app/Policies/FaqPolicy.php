<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Faq;
use Illuminate\Auth\Access\Response;

class FaqPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasPermissionTo('Index-Faqs');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Faq $faq): bool
    {
        return $user->hasPermissionTo('Show-Faq');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasPermissionTo('Create-Faq');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Faq $faq): bool
    {
        return $user->hasPermissionTo('Update-Faq');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Faq $faq): bool
    {
        return $user->hasPermissionTo('Delete-Faq');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Faq $faq): bool
    {
        return $user->hasPermissionTo('Restore-Faq');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Faq $faq): bool
    {
        return $user->hasPermissionTo('forceDelete-Faq');
    }
}
