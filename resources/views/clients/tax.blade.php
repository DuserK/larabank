@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class = " title">Banko mokestis</h3>
            <div class="table-form">
                <form action="{{ route('clients-charge') }}" method="get">
                    <div class="mb-3">
                        <label class="form-label"required>Ar norite nuskaičiuoti 5 Eur mokestį iš kiekvieno kliento?</label>
                    </div>
                    <button type="button" class="btn onHover mt-4">
                        <a class="" href="{{ route('clients-index') }}"> Grįžti</a>
                    </button>
                    <button type="submit" class="btn onHover btn-green mt-4">Nuskaičiuoti</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection