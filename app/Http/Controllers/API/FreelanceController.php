<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFreelanceRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Client;
use App\Models\Freelance;
use App\Services\ClientService;
use App\Services\FreelanceService;
use Illuminate\Http\Request;

class FreelanceController extends Controller
{
    private  FreelanceService $freelanceService;

    public function __construct(FreelanceService $freelanceService)
    {
        $this->freelanceService = $freelanceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freelances = $this->freelanceService->getAllFreelances();
        return response()->json([
            "success" => true,
            "message" => "Liste des freelances",
            "data" => $freelances
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Freelance $freelance)
    {
        $freelance = $this->freelanceService->showFreelanceInfo($freelance);
        return response()->json([
            "success" => true,
            "message" => "Freelance informations",
            "data" => $freelance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileFreelanceRequest $request, Freelance $freelance)
    {
        $validated= $request->validated();
       $freelance = $this->freelanceService->editFreelanceProfile($validated,$freelance);
        return response()->json([
            "success" => true,
            "message" => "Freelance Profile edite avec success",
            "data" => $freelance
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Freelance $freelance)
    {
        $this->freelanceService->deleteFreelance($freelance);
        return response()->json([
            "success" => true,
            "message" => "Freelance Profile supprimer",
            "data" => $freelance
        ]);
    }
}
