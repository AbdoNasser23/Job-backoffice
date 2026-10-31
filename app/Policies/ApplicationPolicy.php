<?php
namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;

class ApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'company_owner']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobApplication $jobApplication): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $jobApplication->jobVacancy?->company?->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobApplication $jobApplication): bool
    {

        return $user->id === $jobApplication->jobVacancy?->company?->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobApplication $jobApplication): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $jobApplication->jobVacancy?->company?->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JobApplication $jobApplication): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $jobApplication->jobVacancy?->company?->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JobApplication $jobApplication): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $jobApplication->jobVacancy?->company?->user_id;
    }

    public function archived(User $user): bool
    {
        return in_array($user->role, ['admin', 'company_owner']);
    }

}
