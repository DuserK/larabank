@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-10 col-10">
        <div class="">
            <h3 class = " title">Klientų sąrašas</h3>
            @forelse ($clients as $client)
            <div class="row info-account">
                <div class="col-4">{{$client->name}} {{$client->surname}}</div>
                <div class="col-2">{{$client->person_id}}</div>
                <div class="col-2 edit">
                    <a href="{{ route('clients-edit', $client) }}"  class='plus onHoverIcon'><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('clients-delete', $client) }}"  class='delete onHoverIcon'><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            @empty
            <div class="row info-account">
                <div class="">Klientų sąrašas tuščias</div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection