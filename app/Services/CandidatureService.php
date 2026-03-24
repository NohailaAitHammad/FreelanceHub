<?php

namespace App\Services;

use App\Models\Candidature;
use App\Models\Freelance;
use App\Models\Mission;
use Illuminate\Contracts\Database\ModelIdentifier;
use League\Uri\Contracts\Conditionable;

class CandidatureService
{
    //private  Mission

    public function getAllCandidatures()
    {
        return Candidature::where("freelance_id", auth()->user()->freelance->with('user')->first()->id)
            ->where("status", "pending")
            ->get();
    }

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
        $candidature->mission->status = "in_progress";
        $candidature->mission->save();
       return  $this->modifierStatusCnadidature($candidature, "accepted");
        //$candidature->status = "accepted";
        //return $candidature->save();
    }

    public function reject(Candidature $candidature)
    {
        return  $this->modifierStatusCnadidature($candidature, "rejected");

        //$candidature->status = "rejected";
        //return $candidature->save();
    }

    public function modifierStatusCnadidature(Candidature $candidature, string $status)
    {
        $candidature->status = $status;
        return $candidature->save();
    }

}
