<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Client;
use App\Models\Freelance;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Translation\Exception\MissingRequiredOptionException;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all()->with('user');
        $freelances = Freelance::all()->with('user');
        $nbrUsers = User::all()->count();
        $nbrClients = Client::all()->count();
        $nbrFreelances = Freelance::all()->count();
        $nbrMissionsParStatus = Mission::all()->groupBy('status');
        $nbrCandidaturesParStatus = Candidature::all()->groupBy('status');
        $TotalMissions = Mission::all()->count();
        $TotalCandidatures = Candidature::all()->count();
        $noteMoyenneFreelance = Freelance::all()->avg('rating_average');
        $noteMoyenneClient = Client::all()->avg('rating_average');
        $totalMissionBudget = Mission::where('status', 'completed')->get()->sum('budget');


        return response()->json([
            "success" => true,
            "message" => "Liste des clients et des freelances",
            "data" => [
                "Tout_Users" => $nbrUsers,
                "Tous_Freelances" => $nbrFreelances,
                "TousClient" => $nbrClients,
                "TotalMissions" => $TotalMissions,
                "TotalCandidatures" => $TotalCandidatures,
                "Missions_Par_Status" => $nbrMissionsParStatus,
                "Candidatures_Par_Status" => $nbrCandidaturesParStatus,
                "Total_CA" => $totalMissionBudget,
                "Note_moyenne_Freelance" => $noteMoyenneFreelance,
                "Note_Moyenne_Client" => $noteMoyenneClient,
                "Clients" => $clients,
                "Freelances" => $freelances
            ]
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
    public function update(Request $request, User $user)
    {
        if($user->status === "active"){
            $user->status = "inactive";
        }else {
            $user->status = "active";
        }
        $user->save();
        return response()->json([
            "success" => true,
            "message" => "Status d'utilisateur est modifier",
            "data" => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "Utilisateur supprimer",
        ]);
    }
}
