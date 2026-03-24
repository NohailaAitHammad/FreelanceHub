<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{

    public function addReview($data, $mission)
    {
        if($mission->status !== "completed"){
            abort(403, "Mission non Complete");
        }
        $candidature = $mission->candidatures()->where("status", "accepted")->first();
        $freelanceUser = $candidature->freelance->user;

        $data['mission_id'] = $mission->id;
        $data['reviewer_id'] = auth()->id();
        $data['reviewed_id'] = $freelanceUser->id;

        $review = Review::create($data);
        return $review;

    }

}
