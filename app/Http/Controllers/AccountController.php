<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\StoreAccountRequest;
// use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
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
        $filterBy = $request->filter_by ?? 'all-accounts';

        // filtravimas
        // $accounts = Account::all();

        // if($filterBy == 'all-clients' || ''){
        //     $clientsFiltered = Client::all();
        // } else if ($filterBy == 'with-accounts') {
        //     $wa = [];  
        //     foreach($clients as $client){
        //         if($client->accounts()->count() != 0){
        //             $wa[] = $client->id;
        //         }
        //     }
        // } else if ($filterBy == 'without-accounts') {
        //     $woa = [];  
        //     foreach($clients as $client){
        //         if($client->accounts()->count() == 0){
        //             $woa[] = $client->id;
        //         }
        //     }
        // }

        $accountsFiltered = match($filterBy) {
            'all-accounts' => Account::paginate(5)->withQueryString(),
            'plus-accounts' => Account::where('balance', '>', 0)->paginate(5)->withQueryString(),
            'zero-accounts' => Account::where('balance', '=', 0)->paginate(5)->withQueryString(),
            'minus-accounts' => Account::where('balance', '<', 0)->paginate(5)->withQueryString(),
        };
        $request->flash();

        
        return view('accounts.index', [
            'accounts' => $accountsFiltered,
            'filterBy' => $filterBy
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $iban = Account::accountNumberGen();
        return view('accounts.create',
            [
                'clients' => $clients,
                'iban' => $iban,
            ]
    );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function createStore(Client $client)
    {
        $account = new Account;
      $account->client_id = $client->id;
      $account->iban = Account::accountNumberGen();
      $account->balance = 0;

      $account->save();
      return redirect()
          ->route('clients-index')
          ->with('success', 'Klientui  nauja sąskaita sėkmingai sukurta.');
          
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 

            [
                //Validacijos sąlygos
                'iban' => 'unique:accounts'
            ], 
            [
                // Validacijos pranešimai
            //    'iban.unique' => 'Sąskaita su tokiu IBAN jau egzistuoja.'
            ]);

        // Jei validacija nepavyko

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
      $account = new Account;
      $account->client_id = $request->client_id;
      $account->iban = $request->iban;
      $account->balance = 0;

      $account->save();
      return redirect()
          ->route('accounts-index')
          ->with('success', 'Nauja sąskaita klientui  sukurta sėkmingai.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $amount = $request->amount;


        // Fund
        if (isset($request->add)) {
            $account->balance += $amount;
            $account->save();
            return redirect()
                ->back()
                ->with('success', 'Sąskaita papildyta.');
        }

        // Withdraw
        if (isset($request->withdraw)) {
            if ($account->balance < $amount && $account->balance > 0) {
                return redirect()
                    ->back()
                    ->with('warning', 'Nepakanka lėšų.');
            }
            $account->balance -= $amount;
            $account->save();
            return redirect()
                ->back()
                ->with('success', 'Iš sąskaitos nuskaičiuota.');
        }

    }

    public function delete( Account $account, Client $client)
    {
        if($account->balance > 0){
            return redirect()
            ->back()
            ->with('warning', 'Sąskaitoje yra lėšų, trinti negalima.');
        }
        return view('accounts.delete', [
            'account' => $account       
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()
        ->route('clients-index')
        ->with('success', 'Sąskaita sėkmingai pašalinta');;
    }


}
