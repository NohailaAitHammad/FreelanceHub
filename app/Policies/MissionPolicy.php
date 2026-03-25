<?php

namespace App\Policies;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MissionPolicy
{
    use HandlesAuthorization;
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
    public function view(User $user, Mission $mission): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->role === "client";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mission $mission): bool
    {
        return $user->role->role === "client" && $mission->user_id === $user->id && $mission->status === "open";
    }

    /**
     * Determine whether the user can delete the model.
     */

    public function delete(User $user, Mission $mission): bool
    {
        return $user->role->role === "client" && $mission->user_id === $user->id && $mission->status === "open";
    }

    public function applyAuMissionParCandidature(User $user, Mission $mission)
    {
        return $user->role->role === "freelance" && $mission->status === "open";
    }

    public function reviewFreelance(User $user, Mission $mission)
    {
        return $user->role->role === "client" && $mission->user_id === $user->id && $mission->status === "completed" && $mission->candidatures()->where("status", "accepted")->exists() ;
    }

    public function reviewClient(User $user, Mission $mission)
    {
        return $user->role->role === "freelance" && $mission->status === "completed" && $mission->candidatures()->where("status", "accepted")
            ->whereHas('freelance.user', function ($q) use ($user){
                $q->where('id', $user->id);
            })
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Mission $mission): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Mission $mission): bool
    {
        return false;
    }
}
