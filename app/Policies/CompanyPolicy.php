<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;

class CompanyPolicy
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
    public function view(User $user, Company $company): bool
    {
        if($user->role === 'admin') {
            return true;
        }
        return $user->id === $company->user_id;
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

    public function update(User $user, Company $company): bool
    {
        if($user->role === 'admin') {
            return true;
        }
        return $user->id === $company->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Company $company): bool
    {
        if($user->role === 'admin') {
            return true;
        }
        return $user->id === $company->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Company $company): bool
    {
        if($company->user?->trashed()){
            return false;
        }

        if($user->role === 'admin') {
            return true;
        }
        return $user->id === $company->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Company $company): bool
    {
        if($user->role === 'admin') {
            return true;
        }
        return $user->id === $company->user_id;
    }

    public function archived(User $user): bool
    {
        return true;
    }
}
