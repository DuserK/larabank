@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
            <h3 class = " title">Sąskaitų sąrašas</h3>
            @forelse ($accounts as $account)
            <div class="row info-account">
                <div class="col-4">
                    <div>
                        <h4>{{$account->client->name}} {{$account->client->surname}}</h4>
                        <p>{{$account->iban}}</p>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-2 edit">
                    <a href="{{ route('accounts-edit', $account) }}"  class='plus onHoverIcon'><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('accounts-delete', $account) }}"  class='delete onHoverIcon'><i class="fa-solid fa-trash"></i></a>
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