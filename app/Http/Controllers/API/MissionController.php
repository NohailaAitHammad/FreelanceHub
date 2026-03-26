<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\ReviewRequest;
use App\Models\Freelance;
use App\Models\User;
use App\Services\ReviewService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller  as BaseController;
use App\Http\Requests\CandidatureRequest;
use App\Http\Requests\MissionRequest;
use App\Models\Mission;
use App\Services\CandidatureService;
use App\Services\ClientService;
use App\Services\FreelanceService;
use Illuminate\Http\Request;

class MissionController extends BaseController
{
    use AuthorizesRequests;
    private  ClientService $clientService;
    private  CandidatureService $candidatureService;
    private  ReviewService $reviewService;

    public function __construct(ClientService $clientService,  CandidatureService $candidatureService, ReviewService $reviewService)
    {
        $this->clientService = $clientService;
        $this->candidatureService = $candidatureService;
        $this->reviewService = $reviewService;
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
        $this->authorize('create', Mission::class);
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
            "data" => ["mission" => $mission,
                "notification" => auth()->user()->notifications]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(MissionRequest $request, Mission $mission)
    {
        $this->authorize('update', $mission);
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
        $this->authorize('delete', $mission);

        $this->clientService->supprimerMission($mission);
        return response()->json([
            "success" => true,
            "message" => "Mission bien supprimer",
            "data" => $mission
        ]);
    }


    public function applyAuMissionParCandidature(CandidatureRequest $request, Mission $mission)
    {
        $this->authorize('applyAuMissionParCandidature', $mission);

        $validated = $request->validated();


       $candidature = $this->candidatureService->apply($validated, $mission);
       $user =User::find( $candidature->mission->user_id);
        return response()->json([

            "success" => true,
            "message" => "Candidature enregister avec success",
            "data" =>$user->unreadNotifications()->count()
        ]);
    }

    public function reviewFreelance(ReviewRequest $request, Mission $mission)
    {
        $this->authorize('reviewFreelance', $mission);
        $validated = $request->validated();
        $review = $this->reviewService->addReview($validated, $mission);
        return response()->json([
            "success" => true,
            "message" => "Avis Ajouter",
            "data" => $review
        ]);
    }

    public function reviewClient(ReviewRequest $request, Mission $mission)
    {
        $this->authorize('reviewClient', $mission);

        $validated = $request->validated();
        $review = $this->reviewService->addReview($validated, $mission);
        return response()->json([
            "success" => true,
            "message" => "Avis Ajouter",
            "data" => $review
        ]);
    }

}
