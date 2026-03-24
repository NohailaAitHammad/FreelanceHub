<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;
use App\Services\CompetenceService;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    private CompetenceService $competenceService;

    public function __construct(CompetenceService $competenceService)
    {
        $this->competenceService = $competenceService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences = $this->competenceService->getAllCompetences();
        return response()->json([
            "success" => true,
            "message" => "Liste des competences",
            "data" => $competences
        ]);
    }


    public function store(CompetenceRequest $request)
    {
        $validated = $request->validated();
        $competence = $this->competenceService->createCompetence($validated);
        return response()->json([
            "success" => true,
            "message" => "Competence cree avec success",
            "data" => $competence
        ], 201);
    }


    public function show(Competence $competence)
    {
        $competence = $this->competenceService->showDetailCompetence($competence);
        //$competence = Competence::findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Detail competence",
            "data" => $competence
        ]);
    }


    public function update(CompetenceRequest $request, Competence $competence)
    {
        //$competence = Competence::findOrFail($id);
        $validated = $request->validated();
        $this->competenceService->modifierCompetence($validated, $competence);
        return response()->json([
            "success" => true,
            "message" => "Modification de competence",
            "data" => $competence
        ]);
    }

    public function destroy(Competence $competence)
    {
        $this->competenceService->supprimerCompetence($competence);
        return response()->json([
            "success" => true,
            "message" => "Competence Supprimer"
        ]);
    }
}
