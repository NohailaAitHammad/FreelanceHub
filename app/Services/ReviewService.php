<?php

namespace App\Services;

use App\Models\Mission;
use App\Models\Review;
use App\Models\User;

class ReviewService
{
    private  FreelanceService $freelanceService;
    private  ClientService $clientService;

    public function __construct(FreelanceService $freelanceService, ClientService $clientService)
    {
        $this->freelanceService = $freelanceService;
        $this->clientService = $clientService;
    }

    public function addReview($data,Mission $mission)
    {
        if(auth()->user()->role->role === "freelance"){

            if($mission->status !== "completed"){
                abort(403, "Mission non Complete");
            }

            $candidature = $mission->candidatures()->where("status", "accepted")->first();
            $clientUser = $mission->user;

            if(!$candidature){
                abort(404, "No accepted candidature");
            }

            $ReviewExists = Review::where("mission_id", $mission->id)->where("reviewer_id", auth()->id())->exists();

            if($ReviewExists){
                abort(422, "Mission deja note");
            }

            $data['mission_id'] = $mission->id;
            $data['reviewer_id'] = auth()->id();
            $data['reviewed_id'] = $mission->user->id;
            $this->clientService->addAverageRating($mission->user);
            $review = Review::create($data);


        }else{
            if($mission->status !== "completed"){
                abort(403, "Mission non Complete");
            }

            $candidature = $mission->candidatures()->where("status", "accepted")->first();
            $freelanceUser = $candidature->freelance->user;

            if(!$candidature){
                abort(404, "No accepted candidature");
            }

            $ReviewExists = Review::where("mission_id", $mission->id)->where("reviewer_id", auth()->id())->exists();

            if($ReviewExists){
                abort(422, "Mission deja note");
            }

            $data['mission_id'] = $mission->id;
            $data['reviewer_id'] = auth()->id();
            $data['reviewed_id'] = $freelanceUser->id;
            $this->freelanceService->addAverageRating($freelanceUser);
            $review = Review::create($data);
        }

        return $review;
    }
}
