@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach($images as $image)
            
                @include('includes.image', ['image' => $image])
            
            @endforeach

             <!-- paginacion -->
        <div class="clearfix paginacion">
            {{$images->links()}}
        </div>

        </div>
    </div>
</div>
@endsection
