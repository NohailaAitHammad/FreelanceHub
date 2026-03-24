<?php

namespace App\Services;

use App\Models\Candidature;
use App\Models\Freelance;
use App\Models\Mission;

class CandidatureService
{

    public function apply($data, Mission $mission)
    {
        $data["mission_id"] = $mission->id;
        $data["freelance_id"] = Freelance::where("user_id", auth()->id())->first()->id;
        $data['status'] = "pending";
        $candidature =  Candidature::create($data);
        return $candidature->with('freelance', "mission")->first();
    }

    public function accept(Candidature $candidature)
    {
        $candidature->status = "accepted";
        return $candidature->save();
    }

    public function reject(Candidature $candidature)
    {
        $candidature->status = "rejected";
        return $candidature->save();
    }

}
