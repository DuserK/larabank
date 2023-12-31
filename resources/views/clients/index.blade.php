@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
                <h3 class="title">Klientų sąrašas
                    <span >
                       <form action="{{route('clients-index')}}" method='get'>
                            <select name="filter_by" class="form-select" value="{{old('filter_by')}}" selected>
                                <option value="all-clients">Visi klientai</option>
                                <option value="with-accounts">Klientai su sąskaitomis</option>
                                <option value="without-accounts">Klientai be sąskaitų</option>
                            </select>
                            <button type="submit" class="btn onHover mt-1">
                                Filtruoti <i class="fa-solid fa-trash"></i>
                            </button>
                       </form>
                    </span>
                </h3>
            
            @forelse ($clients as $client)
            <div class="row info-account">
                <div class="col-4  client-box">
                    <div>
                        <div class ="">
                            <h4>{{$client->name}} {{$client->surname}}</h4>
                            <p>{{$client->person_id}}</p>
                        </div>
                        <div class=" edit">
                            <button type="button" class="btn onHover mt-1">
                                <a href="{{ route('clients-edit', $client) }}"  > Redaguoti <i class="fa-regular fa-pen-to-square"></i></a>
                            </button>
                            <button type="button" class="btn onHover mt-1">
                                <a href="{{ route('clients-delete', $client) }}"  >Trinti <i class="fa-solid fa-trash"></i></a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    
                </div>
                <div class="col-6">
                    <div class="col-12 row mt-4">
                        <h4 class="col-5">Sąskaitos:</h4>
                        <div class="col-7 d-flex justify-content-end">
                            <button type="button" class="btn onHover">
                                <a href="{{ route('accounts-createStore', $client) }}"  >Pridėti naują sąskaitą <i class="fa-solid fa-plus"></i></a>
                            </button>
                        </div>
                    </div>
                    @if($client->accounts()->count() > 0)
                    <ol class="list-group list-group-numbered list-group-flush">
                        @foreach($client->accounts as $account)
                            <li class="account-list">
                                <div class="col-12 row mt-4">
                                    <div class="col-5">{{$account->iban}}</div>

                                    <div class="edit col-7 d-flex justify-content-end">
                                        <button type="button" class="btn onHover">
                                            <a href="{{ route('accounts-edit', $account) }}"  > Redaguoti <i class="fa-regular fa-pen-to-square"></i></a>
                                        </button>
                                        <button type="button" class="btn onHover ms-1">
                                            <a href="{{ route('accounts-delete', ['account'=>$account, 'client'=> $client]) }}" >Trinti <i class="fa-solid fa-trash"></i></a>
                                        </button>
                                    </div>
                                </div>
                                <p>Likutis: {{$account->balance}} €</p>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="mb-3">Sąskaitų sąrašas tuščias.</p>
                @endif
                </div>
            </div>
            @empty
            <div class="row info-account">
                <div class="">Klientų sąrašas tuščias</div>
            </div>
            @endforelse
            <div class="title">
                {{$clients->links()}}
            </div>
        </div>
    </div>
</div>

@endsection