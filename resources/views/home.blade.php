@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
            <h3 class = " title">Banko statistika</h3>
            <div class="d-flex flex-wrap">
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Klientų skaičius:</h5>
                        <p>{{$clients->count()}}</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Sąskaitų skaičius:</h5>
                        <p>{{$accounts->count()}}</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Bendra laikoma suma:</h5>
                        <p>{{$accounts->sum('balance')}} €</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Didžiausia suma sąskaitoje:</h5>
                        <p>{{$accounts->max('balance')}} €</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Vidutinė sąskaitos suma:</h5>
                        <p>{{round($accounts->avg('balance'),2)}} €</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Tuščių sąskaitų skačius:</h5>
                        <p>{{$accounts->where('balance', 0)->count()}}</p> 
                    </div>
                </div>
                <div class="col-3">
                    <div class=" m-1 table-form">
                        <h5>Neigiamų sąskaitų kiekis:</h5>
                        <p>{{$accounts->where('balance', '<', 0)->count()}}</p> 
                    </div>
                </div>
    
            </div>

        </div>
    </div>
</div>

@endsection
