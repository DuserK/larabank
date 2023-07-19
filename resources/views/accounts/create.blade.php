@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class = " title">Pridėti naują sąskaitą klientui</h3>
            <div class="table-form">
                <form action="{{ route('accounts-store') }}" method="post">
                    <div class="mb-3">
                        <label class="form-label"required>Klientas</label>
                        <select class="form-select" name="client_id">
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}} {{$client->surname}}</option>
                            @endforeach
                        {{-- <h4>{{$account->$client->name}} {{$account->$client->surname}}</h4> --}}
                    </div>
                    <div class="mb-3">
                        <label class="form-label"required>Sąskaitos numeris</label>
                        <input class="form-control" name="iban" type="text" value="{{$iban}}" readonly>
                    </div>
                    
                    <button type="button" class="btn onHover mt-4">
                        <a class="" href="./"> Atgal</a>
                    </button>
                    <button type="submit" class="btn onHover mt-4">Išsaugoti</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection