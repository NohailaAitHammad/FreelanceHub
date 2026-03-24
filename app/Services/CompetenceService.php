<?php

namespace App\Services;

use App\Models\Competence;

class CompetenceService
{

    public function getAllCompetences()
    {
        return Competence::all();
    }

    public function createCompetence($data)
    {
        return  Competence::create($data);
    }

    public function showDetailCompetence($competence)
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

        $competence->name = $data["name"];
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
