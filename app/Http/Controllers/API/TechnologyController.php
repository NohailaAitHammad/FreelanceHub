<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyRequest;
use App\Models\Technology;
use App\Services\TechnologyService;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    private TechnologyService $technologyService;

    public function __construct(TechnologyService $technologyService)
    {
        $this->technologyService = $technologyService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = $this->technologyService->getAllTechnologies();
        return response()->json([
            "success" => true,
            "message" => "Liste des technologies",
            "data" => $technologies
        ]);
    }


    public function store(TechnologyRequest $request)
    {
        $validated = $request->validated();
        $technology = $this->technologyService->createTechnology($validated);
        return response()->json([
            "success" => true,
            "message" => "Technology cree avec success",
            "data" => $technology
        ], 201);
    }


    public function show(Technology $technology)
    {
        $competence = $this->technologyService->showDetailTechnology($technology);
        //$competence = Competence::findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Detail Technology",
            "data" => $technology
        ]);
    }


    public function update(TechnologyRequest $request, Technology $technology)
    {
        //$competence = Competence::findOrFail($id);
        $validated = $request->validated();
        $this->technologyService->modifierTechnology($validated, $technology);
        return response()->json([
            "success" => true,
            "message" => "Modification de Technology",
            "data" => $technology
        ]);
    }

    public function destroy(Technology $technology)
    {
        $this->technologyService->supprimerTechnology($technology);
        return response()->json([
            "success" => true,
            "message" => "Technology Supprimer"
        ]);
    }
}
