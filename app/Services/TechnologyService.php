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

    public function showDetailTechnology($competence)
    {
        if(!Competence::findOrFail($competence->id)){
            abort(404, "Introuvable");
        }
        return $competence;
    }

    public function modifierCompetence($data, $competence)
    {
        if(!Competence::findOrFail($competence->id)){
            abort(404, "Introuvable");
        }

        $competence->nom = $data["name"];
        $competence->save();
        return $competence;
    }

    public function supprimerCompetence(Competence $competence)
    {
        if(!Competence::findOrFail($competence->id)){
            abort(404, "Introuvable");
        }
        return $competence->delete();

    }
}
