@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <form id="buscador" action="{{ route('user.index') }}" method="get">
                <div class="row">
                    <div class="form-group col">
                        <input type="text"  id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>
                </div>
                
            </form>
            <hr>
            @foreach($users as $user)
            
                <div class=" col-md-8 data_user">

                    <div class="navbar-usuario">
                        <div class="navbar-avatar"> 
                            @if($user->image)
                                <img  src="{{ route('user.avatar', ['filename' => $user->image]) }}">
                            @endif
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="card_inicio_usuario">
                            <a class="enlace_profile" href="{{ route('profile', ['id' => $user->id]) }}">
                                {{ $user->name.' '.$user->surname }}
                                <p class="nick"> {{ '@'. $user->nick}}</p>
                            </a>
                            {{ 'se unió ' . \FormatTime::LongTimeFilter($user->created_at) }}
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach

             <!-- paginacion -->
        <div class="clearfix paginacion">
            {{$users->links()}}
        </div>

        </div>
    </div>
</div>
@endsection
