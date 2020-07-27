@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class=" col-md-8 data_user">

        	<div class="profile_user">
	            <div class=" profile_img_user"> 
	                @if($user->image)
						<img  src="{{ route('user.avatar', ['filename' => $user->image]) }}">
					@endif
	            </div>
	            &nbsp;
	            &nbsp;
	            <div class="card_inicio_usuario">
	                <h1 class="profile_user_name">{{ $user->name.' '.$user->surname }}</h1>
	                <h2 class="profile_user_nick"> {{ '@'. $user->nick}}</h2>
	                <h6>{{'Se unió '. \FormatTime::LongTimeFilter($user->created_at) }}</h6>
	            </div>
	        </div>
        </div>	
            
            
        <div class="col-md-8">
            @foreach($user->images as $image)
            
                @include('includes.image', ['image' => $image])
            
            @endforeach

        </div>
    </div>
</div>
@endsection