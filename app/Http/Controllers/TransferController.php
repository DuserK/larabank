<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Account;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $accounts = Account::all();
        return view('transfers.index', [
            'accounts' => $accounts,
            'clients'=>$clients
        ]
    );
    }

    public function transfer(Request $request, Account $account)
    {
        $amount = $request->amount;

        $validator = Validator::make(
        $request->all(),[
            'amount' => ['required', 'min:0', 'not_in:0', 'integer']
        ],
        [
            'amount.required' => 'Įveskite sumą!',
            'amount.min', 'amount.not_in' => 'Pervedama suma negali būti 0'
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $sender = Account::find($request->sender);
        $receiver = Account::find($request->receiver);

        if ($sender->balance >= $request->amount){
            $sender->balance -= $request->amount;
            $receiver->balance += $request->amount;

            $sender->save();
            $receiver->save();
            return redirect()
                ->back()
                ->with('success', $amount . ' € from ' . $sender->client->first_name . ' ' . $sender->client->last_name . ' sąskaitos nr. ' . $sender->iban . ' has been transfared to ' . $receiver->client->first_name . ' ' . $receiver->client->last_name . ' sąskaitos nr. ' . $receiver->iban . '!');
        }

        return redirect()
            ->back()
            ->with('warrning', 'Siuntėjas neturi pakankamai lėšų!');
    }
}