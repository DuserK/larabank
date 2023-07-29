@extends('layouts.app')

@section('content')


<div class="row justify-content-md-center">
    <div class="col-lg-12 col-12">
        <div class="">
            <h3 class = " title">Sąskaitų sąrašas
                <span >
                    <form action="{{route('accounts-index')}}" method='get'>
                         <select name="filter_by" class="form-select" value="{{old('filter_by')}}" selected>
                             <option value="all-accounts">Visos sąskaitos</option>
                             <option value="plus-accounts">Teigiamos sąsakaitos</option>
                             <option value="zero-accounts">Tuščios sąskaitos</option>
                             <option value="minus-accounts">Neigiamos sąskaitos</option>
                         </select>
                         <button type="submit" class="btn onHover mt-1">
                             Filtruoti <i class="fa-solid fa-trash"></i>
                         </button>
                    </form>
                 </span>
            </h3>
            @forelse ($accounts as $account)
            <div class="row info-account">
                <div class="col-1"></div>
                <div class="col-2  client-box">
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
                                    <a href="{{ route('accounts-edit', $account) }}"  > Redaguoti <i class="fa-regular fa-pen-to-square"></i></a>
                                </button>
                                <button type="button" class="btn onHover">
                                    <a href="{{ route('accounts-delete', $account) }}"  >Trinti <i class="fa-solid fa-trash"></i></a>
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
            <div class="title">
                {{$accounts->links()}}
            </div>
        </div>
    </div>
</div>

@endsection