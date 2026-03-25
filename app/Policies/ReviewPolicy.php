<?php

namespace App\Policies;

use App\Models\Mission;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
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
    public function view(User $user, Review $review): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Mission $mission): bool
    {
        return !Review::where("mission_id", $mission->id)->where("reviewer_id", $user->id)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        return false;
    }

    public function reviewFreelanc(User $user, Mission $mission)
    {
        return $user->role->role === "client"
            && $mission->user_id === $user->id
            && $mission->status === "completed"
            && $mission->candidatures()->where("staus", "accepted")->exists();

    }

    public function reviewClient(User $user, Mission $mission)
    {
        return $user->role->role === "freelance"
            && $mission->status === "completed"
            && $mission->candidatures()->where("staus", "accepted")
            ->whereHas("freelance.user", function ($q) use ($user){
                $q->where('id', $user->id);
            })->exists();

    }
}
