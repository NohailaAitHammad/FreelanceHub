<?php

namespace App\Services;

use App\Http\Requests\ProfileRequest;
use App\Models\Candidature;
use App\Models\Freelance;
use App\Models\Mission;
use App\Models\User;
use App\Notifications\CandidatureStatusNotification;
use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use League\Uri\Contracts\Conditionable;

class CandidatureService
{

    public function getAllCandidatures(Request $request)
    {
        $candidatures = Candidature::where("freelance_id", auth()->user()->freelance->with('user')->first()->id)->get();
        if($request->has('status')){
            $candidatures->where("status", $request->status);
        }

        return $candidatures;
    }

    public function apply($data, Mission $mission)
    {
        $data["mission_id"] = $mission->id;
        $data["freelance_id"] = Freelance::where("user_id", auth()->id())->first()->id;
        $data['status'] = "pending";
        $candidature =  Candidature::create($data);
        $user =User::find( $candidature->mission->user_id);
        Notification::send($user, new CandidatureStatusNotification($candidature));
        return $candidature->with('freelance', "mission")->first();
    }

    public function accept(Candidature $candidature)
    {
       $candidature=   $this->modifierStatusCnadidature($candidature, "accepted");
        $candidature->mission->status = "completed";
        $candidature->mission->save();
        Notification::send(auth()->user(), new CandidatureStatusNotification($candidature));
        return $candidature;
        //$candidature->status = "accepted";
        //return $candidature->save();
    }

    public function reject(Candidature $candidature)
    {
        $candidature = $this->modifierStatusCnadidature($candidature, "rejected");
        Notification::send(auth()->user(), new CandidatureStatusNotification($candidature));
        return $candidature;
    }

    public function modifierStatusCnadidature(Candidature $candidature, string $status)
    {
        $candidature->status = $status;
         $candidature->save();
         return $candidature;
    }

}
