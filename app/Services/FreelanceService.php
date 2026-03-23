<?php

namespace App\Services;

use App\Models\Freelance;

class FreelanceService
{

    public function getAllFreelances()
    {
        return Freelance::all()->load("user");
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
        $freelance->save();
        return $freelance->with("user")->get();
    }

    public function deleteFreelance($freelance)
    {
        return $freelance->delete();
    }
}
