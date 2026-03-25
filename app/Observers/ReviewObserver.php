<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Freelance;
use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        if(auth()->user()->role->role === "client") {

            $average = Review::where('reviewed_id', $review->reviewed_id)
                ->avg('rating');
            $freelance = Freelance::where('user_id', $review->reviewed_id)->first();
            $freelance->rating_average = round($average, 1);
            $freelance->save();

        }else {
            $average = Review::where('reviewed_id', $review->reviewed_id)
                ->avg('rating');
            $client = Client::where('user_id', $review->reviewed_id)->first();
            $client->rating_average = round($average, 1);
            $client->save();
        }
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }
}
