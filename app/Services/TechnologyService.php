<?php

namespace App\Services;

use App\Models\Competence;
use App\Models\Technology;

class TechnologyService
{

    public function getAllTechnologies()
    {
        return Technology::all();
    }

    public function createTechnology($data)
    {
        return  Technology::create($data);
    }

    public function showDetailTechnology($technology)
    {
        if(!Technology::findOrFail($technology->id)){
            abort(404, "Introuvable");
        }
        return $technology;
    }

    public function modifierTechnology($data, $technology)
    {
        if(!Technology::findOrFail($technology->id)){
            abort(404, "Introuvable");
        }

        $technology->name = $data["name"];
        $technology->save();
        return $technology;
    }

    public function supprimerTechnology(Technology $technology)
    {
        if(!Technology::findOrFail($technology->id)){
            abort(404, "Introuvable");
        }
        return $technology->delete();

    }
}
