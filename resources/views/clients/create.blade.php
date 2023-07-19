@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class = " title">Pridėti naują klientą</h3>
            <div class="table-form">
                <form action="{{ route('clients-store') }}" method="post">
                    <div class="mb-3">
                        <label class="form-label" required>Vardas</label>
                        <input class="form-control" name="name" type="text" value="{{ old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"required>Pavardė</label>
                        <input class="form-control" name="surname" type="text" value="{{ old('surname')}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" required>Asmens kodas</label>
                        <input class="form-control"  name="person_id"  type="number" minlength="11" maxlength="11" value="{{ old('person_id')}}">
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