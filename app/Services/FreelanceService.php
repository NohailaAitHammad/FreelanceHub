<?php

namespace App\Services;

use App\Models\Freelance;
use App\Models\Mission;

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


}
