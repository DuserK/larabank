@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class = " title">Balanso keitimas</h3>
            <div class="table-form">
                <form action="{{ route('accounts-update', $account) }}" method="post">
                    <div class="mb-3">
                        {{-- <h4>{{$account->$client->name}} {{$account->$client->surname}}</h4>
                        <p>{{$account->iban}}</p> --}}
                    </div>
                    <div class="mb-3">
                        <label class="form-label"required>Balansas</label>
                        <p>{{$account->balance}}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"required>Įveskite sumą, Eur</label>
                        <input class="form-control" name="balance" type="number" value="0">
                    </div>
                    <button type="button" class="btn onHover mt-4">
                        <a class="" href="./"> Atgal</a>
                    </button>
                    <button type="submit" class="btn btn-success m-1" name="add" value=1>Pridėti</button>
                    <button type="submit" class="btn btn-warning m-1" name="withdraw" value=1>Nuskaičiuoti</button>
                    @method('put')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection