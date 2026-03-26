<?php

namespace App\Policies;

use App\Models\Candidature;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CandidaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Candidature $candidature): bool
    {
        return ($user->role->role === "freelance" &&  $candidature->freelance->user_id === $user->id)
            ||
            ($user->role->role === "client" &&  $candidature->mission->user_id === $user->id)
            ;
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
    public function update(User $user, Candidature $candidature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Candidature $candidature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Candidature $candidature): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Candidature $candidature): bool
    {
        return false;
    }


    public function applyAuMissionParCandidature(User $user, Mission $mission)
    {
        return $user->role->role === "freelance" &&  $mission->status === "open";
    }

    public function accept(User $user, Candidature $candidature)
    {
        return $user->role->role === "client" && $candidature->mission->user_id === $user->id;
    }

    public function reject(User $user, Candidature $candidature)
    {
        return $user->role->role === "client" && $candidature->mission->user_id === $user->id;
    }
}
