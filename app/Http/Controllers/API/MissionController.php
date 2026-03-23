<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MissionRequest;
use App\Models\Mission;
use App\Services\ClientService;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    private  ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = $this->clientService->voirTousMesMissions(auth()->user());
        return response()->json([
            "success" => true,
            "message" => "Liste des missions de l'utilisateur",
            "data" => $missions->items(),
            "pagination" => [
                'perPage' => $missions->perPage(),
                'lastPage' => $missions->lastPage(),
                'currentPage' => $missions->currentPage(),
                'Total' => $missions->total()
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MissionRequest $request)
    {
        $validated = $request->validated();
        $mission = $this->clientService->ajouterMission($validated);
        return response()->json([
            "success" => true,
            "message" => "Mission cree avec success",
            "data" => $mission
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        $mission = $this->clientService->showMissionDetail($mission);
        return response()->json([
            "success" => true,
            "message" => "Detail de la mission",
            "data" => $mission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MissionRequest $request, Mission $mission)
    {
        $validated = $request->validated();
        $mission = $this->clientService->modifierModifier($validated,$mission);
        return response()->json([
            "success" => true,
            "message" => "Misson modifier avec success",
            "data" => $mission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        $this->clientService->supprimerMission($mission);
        return response()->json([
            "success" => true,
            "message" => "Mission bien supprimer",
            "data" => $mission
        ]);
    }
}
