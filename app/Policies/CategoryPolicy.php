<?php

namespace App\Policies;

use App\Models\JobCategory;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role , ['admin','company_owner']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobCategory $jobCategory): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobCategory $jobCategory): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobCategory $jobCategory): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobCategory $jobCategory): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobCategory $jobCategory): bool
    {
        return $user->role === 'admin';
    }

    public function archived (User $user): bool
    {
        return $user->role === 'admin';
    }
}
