<?php

namespace App\Http\Controllers;

use App\Models\Client;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Request;
// use App\Http\Requests\Request; // specializuoti requestai

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->person_id = $request->person_id;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('success', 'Sėkmingai pridėtas naujas klientas.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('success', 'Kliento duomenys sėkmingai pakeisti.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( Client $client)
    {
        return view('clients.delete', [
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()
        ->route('clients-index')
        ->with('success', 'Klientas sėkmingai pašalintas');;
    }
}
