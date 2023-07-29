<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = 'surname';
        $filterBy = $request->filter_by ?? '';

        // filtravimas
        $clients = Client::all();

        if($filterBy == 'all-clients' || ''){
            $clientsFiltered = Client::all();
        } else if ($filterBy == 'with-accounts') {
            $wa = [];  
            foreach($clients as $client){
                if($client->accounts()->count() != 0){
                    $wa[] = $client->id;
                }
            }
        } else if ($filterBy == 'without-accounts') {
            $woa = [];  
            foreach($clients as $client){
                if($client->accounts()->count() == 0){
                    $woa[] = $client->id;
                }
            }
        }

        $clientsFiltered = match($filterBy) {
            'all-clients' => Client::paginate(5)->withQueryString(),
            'with-accounts' => Client::whereIn('id', $wa)->paginate(5)->withQueryString(),
            'without-accounts' => Client::whereIn('id', $woa)->paginate(5)->withQueryString(),
            default => Client::paginate(5)->withQueryString()
        };
        $request->flash();

        return view('clients.index', [
            'clients' => $clientsFiltered,
            'filterBy' => $filterBy
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
                    'digits:11',
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
                'person_id.size' => 'Asmens kodą turi sudaryti 11 skaičių.',
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
        $total = 0;
        foreach($client->accounts as $account){
            $total += $account->balance;
        }
        if($total){
            return redirect()
            ->back()
            ->with('warning', 'Klientas turi sąskaitų, su lėšomis.');
        }
        return view('clients.delete', [
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->accounts()->delete();
        $client->delete();
        return redirect()
            ->route('clients-index')
            ->with('success', 'Klientas sėkmingai pašalintas');;
    }

    public function tax() 
    {
        return view('clients.tax', [
            'clients' => Client::all(),
        ]);
    }

    public function charge ()
    {
        $clients = Client::all();
        foreach($clients as $client) {
            if($client->accounts()->count() > 0) {
                $caccount = $client->accounts()->first();
                dump($caccount->balance);
                $caccount->balance -= 5;
                $caccount->save();
            }
        }
        return redirect()
            ->route('clients-index')
            ->with('success', 'Visiems klientams nuskaičiuota po 5 Eur.');
    }
}
