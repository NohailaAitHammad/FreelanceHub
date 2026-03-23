<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Mission;
use App\Models\Review;
use App\Models\User;

class ClientService
{

    public function showClientInfo(Client $client)
    {
        return $client->with("user")->get();
    }

    public  function  editClientProfile(array $data, Client $client)
    {
        $client->company = $data['company'];
        $client->description = $data['description'];
        $client->save();
        return $client->with("user")->get();
    }


    public function deleteClient($client)
    {
        return $client->delete();
    }

    public function ajouterMission($data)
    {
        if(auth()->user()->role->role !== "client") {
            abort(403, "Role du client est non authorisé");
        }
        $data['user_id'] = auth()->id();
        $data['status'] = "open";
        return Mission::create($data)->load("user", "category");
    }

    public function voirTousMesMissions($user)
    {
        if($user->role->role === "client") {
            //return $user->missions;
            return Mission::where('user_id', $user->id)
                ->select([
                    'id', 'title', 'description', 'budget', 'category_id', 'user_id'
                ])
                ->latest()->paginate(5);
        }

        abort(403, "Role du client est non authorisé");
    }

    public function showMissionDetail($mission)
    {
        if(!Mission::findOrFail($mission->id)){
            abort("404", "Misson introuvable");
        }
        return $mission->with("user", 'category')->first();

    }

    public function modifierModifier($data, $mission)
    {
        if($mission->user_id !== auth()->id()){
            abort(403, "unauthorised, cette mission pas a vous");
        }
        if($mission->status !== "open"){
            abort(403, "unauthorised, Vous pouvez pas modifier une mission en cours de traitement");
        }
        $mission->title = $data["title"];
        $mission->description = $data["description"];
        $mission->budget = $data["budget"];
        $mission->duration = $data["duration"];
        $mission->save();
        return $mission->with("user", 'category')->first();
    }

    public function supprimerMission($mission)
    {
        if($mission->user_id !== auth()->id()){
            abort(403, "unauthorised, cette mission pas a vous");
        }
        if($mission->status !== "open" ){
            abort(403, "unauthorised, Vous pouvez pas supprimer une mission en cours de traitement");
        }
        return $mission->delete();
    }

    public function modifierStatusMission(Mission $mission, $status)
    {
        $mission->status = $status;
        return $mission->save();
    }


    public function noterFreelance($freelance, $data)
    {
        $ar = [];
        $ar.push($data['rating']);
        Review::create(['comment' => $data['comment'],
            'rating' => $this->noteMoyenne($data)
        ]);



    }

    public function noteMoyenne(array $datas)
    {
        $somme = 0;
        foreach ($datas as $data){
            $somme += $data;
        }
        return $somme /count($data);
    }
}
