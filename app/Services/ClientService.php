<?php

namespace App\Services;

use App\Models\Client;
use App\Models\User;

class ClientService
{

    public function showClientInfo(Client $client)
    {
        return $client->with("user")->get();
    }

    public  function  editClientProfile(array $data, Client $client)
    {
        $client->company = $data['company'];
        $client->description = $data['description'];
        $client->save();
        return $client->with("user")->get();
    }


    public function deleteClient($client)
    {
        return $client->delete();
    }
}
