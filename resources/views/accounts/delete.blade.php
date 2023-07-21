@extends('layouts.app')

@section('content')


<div class="row  justify-content-md-center">
    <div class="col-lg-6 col-12">
        <div class="">
            <h3 class="title">
                Ištrinti sąskaitą?
            </h3>
            <div class="">
                <form class = table-form action="{{ route('accounts-destroy', $account) }}" method="post">
                    <div class="mb-3">
                        <label class="form-label" required>Sąskaitos numeris: <span>{{$account->iban}}</span></label>
                    </div>
                    <button type="button" class="btn onHover">
                        <a class="buttonLink" href="{{ route('accounts-index') }}"> Grįžti</a>
                    </button>
                    <button type="submit" class="btn onHover  btn-red">Trinti</button>
                    @method('delete')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection