@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
            <h3 class = " title">Pervedimai tarp sąskaitų</h3>
            <div class="table-form">
                <form action="" method="post">
                    <div class="d-flex justify-content-around">
                        <div class = "col-5">
                            <div class="mb-3">
                                <label class="form-label"required>Siuntėjas:</label>
                                <select class="form-select mb-2" name="client_id">
                                    @foreach ($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->client->name}} {{$account->client->surname}} | {{$account->client->person_id}} | {{$account->iban}} | {{$account->balance}} €</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" required>Įveskite sumą:</label>
                                <input class="form-control" name="ammount" type="number" value="">
                            </div>
                            
                        </div>
                        <div class="col-1 d-flex flex-wrap align-items-center justify-content-center">
                            <button type="submit" class="btn onHover">Pervesti <i class="fa-solid fa-arrow-right"></i></button>
                            <button type="button" class="btn onHover ">
                                <a class="" href="{{ route('clients-index') }}"> Grįžti</a>
                            </button>
                        </div>
                        <div class = "col-5 d-flex align-items-center">
                            <div class="mb-3">
                                <label class="form-label"required>Gavėjas:</label>
                                <select class="form-select mb-2" name="client_id">
                                    @foreach ($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->client->name}} {{$account->client->surname}} | {{$account->client->person_id}} | {{$account->iban}} | {{$account->balance}} €</option>
                                    @endforeach
                                </select>
                            </div>
                         
                        </div>
                    </div>
                    @csrf
                </form>
            </div>           
        </div>
    </div>
</div>

@endsection