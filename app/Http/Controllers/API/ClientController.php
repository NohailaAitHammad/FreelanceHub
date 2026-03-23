<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private  ClientService $clientService;

    public function __construct( ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all()->load("user");
        return response()->json([
            "success" => true,
            "message" => "Liste des clients",
            "data" => $clients
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
    public function show(Client $client)
    {
        $client = $this->clientService->showClientInfo($client);
        return response()->json([
            "success" => true,
            "message" => "Client informations",
            "data" => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Client $client)
    {
        $validated= $request->validated();
        $client = $this->clientService->editClientProfile($validated,$client);
        return response()->json([
            "success" => true,
            "message" => "Client Profile edite avec success",
            "data" => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->clientService->deleteClient($client);
        return response()->json([
            "success" => true,
            "message" => "Client Profile supprimer",
            "data" => $client
        ]);
    }
}
