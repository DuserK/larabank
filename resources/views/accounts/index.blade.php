@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
            <h3 class = " title">Sąskaitų sąrašas</h3>
            @forelse ($accounts as $account)
            <div class="row info-account">
                <div class="col-3  client-box">
                    <div class ="">
                        <h5>{{$account->client->name}} {{$account->client->surname}}</h5>
                        <p>{{$account->client->person_id}}</p>
                    </div>
                </div>
                <div class="col-1">
                    
                </div>
                <div class="col-7">
                        <div class="col-12 row mt-4">
                            <h4 class="col-5">{{$account->iban}}</h4>

                            <div class="edit col-7 ">
                                <button type="button" class="btn onHover">
                                    <a href="{{ route('accounts-edit', $account) }}"  class='plus onHoverIcon'> Redaguoti <i class="fa-regular fa-pen-to-square"></i></a>
                                </button>
                                <button type="button" class="btn onHover">
                                    <a href="{{ route('accounts-delete', $account) }}"  class='delete onHoverIcon'>Trinti <i class="fa-solid fa-trash"></i></a>
                                </button>
                            </div>
                        </div>
                        <p>Likutis: {{$account->balance}} €</p>
                </div>
            </div>
            @empty
            <div class="row info-account">
                <div class="">Sąskaitų sąrašas tuščias</div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection