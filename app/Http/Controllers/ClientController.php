<?php

namespace App\Http\Controllers;

use App\Models\Client;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        // Validacija  

        $validator = Validator::make(
            $request->all(), 
            [
                'name' => 'required|min:3|max:50|alpha',
                'surname' => 'required|min:3|max:50|alpha',
                'person_id' => 
                [
                    'required',
                    'min:11',
                    'max:11',
                    'unique:clients',
                    'integer',
                ],
            ], 
            [
                // Validacijos pranešimai
                
                'name.required' => 'Vardas privalomas.',
                'name.min' => 'Vardas trumpesnis nei 3 simboliai.',
                'name.max' => 'Vardas per ilgas.',
                'name.alpha' => 'Vardas gali būti sudarytas tik iš raidžių.',
                'surname.required' => 'Pavardė privaloma.',
                'surname.min' => 'Pavardė trumpesnė nei 3 simboliai.',
                'surname.max' => 'Pavardė per ilga.',
                'surname.alpha' => 'Pavardė gali būti sudaryta tik iš raidžių.',
                'person_id.required' => 'Asmens kodas privalomas.',
                'person_id.min' => 'Asmens kodą turi sudaryti 11 skaičių.',
                'person_id.max' => 'Asmens kodą turi sudaryti 11 skaičių.',
                'person_id.unique' => 'Toks asmens kodas jau egzistuoja.',
                'person_id.integer' => 'Asmens kodą turi sudaryti tik skaičiai.',
            ]);

        // Jei validacija nepavyko

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Duomenų įrašymas

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
        // Validacija  

        $validator = Validator::make(
            $request->all(), 
            [
                'name' => 'required|min:3|max:50|alpha',
                'surname' => 'required|min:3|max:50|alpha',
            ], 
            [
                // Validacijos pranešimai

                'name.required' => 'Vardas privalomas.',
                'name.min' => 'Vardas trumpesnis nei 3 simboliai.',
                'name.max' => 'Vardas per ilgas.',
                'name.alpha' => 'Vardas gali būti sudarytas tik iš raidžių.',
                'surname.required' => 'Pavardė privaloma.',
                'surname.min' => 'Pavardė trumpesnė nei 3 simboliai.',
                'surname.max' => 'Pavardė per ilga.',
                'surname.alpha' => 'Pavardė gali būti sudaryta tik iš raidžių.',
            ]);

        // Jei validacija nepavyko

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Duomenų atnaujinimas

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
