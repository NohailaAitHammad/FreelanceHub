<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondidatureRequest;
use App\Models\Candidature;
use App\Models\Mission;
use App\Services\CandidatureService;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    private  CandidatureService $candidatureService;

    public function __construct(CandidatureService $candidatureService)
    {
        $this->candidatureService = $candidatureService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidatures = $this->candidatureService->getAllCandidatures();
        return response()->json([
            "success" => true,
            "message" => "Listes des condidatures",
            "data" => $candidatures
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function  accepeteCondidature(Request $request, Candidature $candidature)
    {
        $this->candidatureService->accept($candidature);

        return response()->json([
            "success" => true,
            "message" => "Condidature accepter",
            "data" => [
                "condidature" => $candidature->with('mission')->first()
            ]
        ]);
    }

    public function  rejectCondidature(Request $request, Candidature $candidature)
    {
        $this->candidatureService->reject($candidature);

        return response()->json([
            "success" => true,
            "message" => "Condidature rejeter",
            "data" => [
                "condidature" => $candidature
            ]
        ]);
    }
}
