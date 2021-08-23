<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    private $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return response()->json($clients);
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  App\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->post());

        $client->contacttypes()->attach($request->post('contacts'));

        return response()->json([
                                    'message' => 'Client Created Successfully!!',
                                    'client'    => $client
                                ]);
    }

    /**
     * Display the specified client.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->json($client);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  App\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->fill($request->post())->save();

        $client->contacttypes()->detach();

        $client->contacttypes()->attach($request->post('contacts'));

        return response()->json([
                                    'message' => 'Client Updated Successfully!!',
                                    'client'    => $client
                                ]);
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
                                    'message' => 'Client Deleted Successfully!!'
                                ]);
    }
}
