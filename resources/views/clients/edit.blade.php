@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class = " title">Redaguoti kliento duomenis</h3>
            <div class="table-form">
                <form action="{{ route('clients-update', $client) }}" method="post">
                    <div class="mb-3">
                        <label class="form-label" required>Vardas</label>
                        <input class="form-control" name="name" type="text" value="{{$client->name}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"required>Pavardė</label>
                        <input class="form-control" name="surname" type="text" value="{{$client->surname}}">
                    </div>
                    <button type="button" class="btn onHover mt-4">
                        <a class="" href="{{ route('clients-index') }}"> Atgal</a>
                    </button>
                    <button type="submit" class="btn onHover mt-4">Išsaugoti</button>
                    @method('put')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection