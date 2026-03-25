<?php

namespace App\Services;

use App\Models\Freelance;
use App\Models\Mission;
use App\Models\User;

class FreelanceService
{

    public function getAllFreelances()
    {
        return Freelance::all()->load("user", "competences", "technologies");
    }

    public function showFreelanceInfo($freelance)
    {
        return $freelance->with("user")->get();
    }

    public function editFreelanceProfile($data,$freelance)
    {
        $freelance->bio = $data['bio'];
        $freelance->experience = $data['experience'];
        $freelance->availability = $data['availability'];
        $freelance->competences()->sync($data["competences"]);
        $freelance->technologies()->sync($data["technologies"]);
        $freelance->save();
        return $freelance->with("user", "competences", "technologies")->get();
    }

    public function deleteFreelance($freelance)
    {
        return $freelance->delete();
    }


    public function addAverageRating(User $user)
    {
        $average = $user->reviewsReceived()->avg('rating');

        if($user->role->role === "freelance") {

            $user->freelance->rating_average = round($average, 1);
            return $user->freelance->save();

        }else {

           // $user->client->rating_average = round($average, 1);
            //return $user->client->save();
            return $user;

        }
    }


}
