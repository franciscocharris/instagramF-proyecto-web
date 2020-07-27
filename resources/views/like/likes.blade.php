@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Mis Imagenes Favoritas <img src="{{ asset('img/hearts_red.png') }}"></h1>
            <hr>
            @foreach($likes as $like)
            	@include('includes.image', ['image' => $like->image])

            @endforeach
             <!-- paginacion -->
	        <div class="clearfix paginacion">
	            {{$likes->links()}}
	        </div>

        </div>
    </div>
</div>
@endsection
