<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CondidatureRequest;
use App\Models\Candidature;
use App\Models\Mission;
use App\Services\CandidatureService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    use AuthorizesRequests;
    private  CandidatureService $candidatureService;

    public function __construct(CandidatureService $candidatureService)
    {
        $this->candidatureService = $candidatureService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidatures = $this->candidatureService->getAllCandidatures($request);
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

    public function  acceptCandidature(Request $request, Candidature $candidature)
    {
        $this->authorize('accept', $candidature);
        $candidature = $this->candidatureService->accept($candidature);

        return response()->json([
            "success" => true,
            "message" => "Candidature accepter",
            "data" => [
                "Candidature" => $candidature,

            ]
        ]);
    }

    public function  rejectCandidature(Request $request, Candidature $candidature)
    {
        $this->authorize('reject', $candidature);
        $this->candidatureService->reject($candidature);

        return response()->json([
            "success" => true,
            "message" => "Candidature rejeter",
            "data" => [
                "Candidature" => $candidature
            ]
        ]);
    }
}
