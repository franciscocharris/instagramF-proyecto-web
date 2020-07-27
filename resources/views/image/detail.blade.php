@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card card_inicio">
                <div class="card-header card_inicio_header">
                    <div class="navbar-usuario">
                        <div class="navbar-avatar"> 
                            @include('includes.avatar_inicio')
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="card_inicio_usuario">
                            <a class="enlace_profile" href="{{ route('profile', ['id' => $image->user->id]) }}">
                                {{ $image->user->name.' '.$image->user->surname }}
                                <p class="nick"> {{ '@'. $image->user->nick}}</p>
                            </a>
                        </div>
                        
                    </div>

                    @include('includes.acciones')
                </div>

                <div class="card-body card_inicio_body ">
                    <div class="image_container">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
                    </div>
                    

                    <p style="padding: .5rem" class="nick"> 
                        {{ '@'. $image->user->nick}} | {{ \FormatTime::LongTimeFilter($image->created_at) }}
                    </p>

                    <div class="description">
                        {{ $image->description }}
                    </div>

                    

                    <div class="card-footer card_inicio_footer">
                        <div class="likes">
                            <!-- comprobar si el usuario le dio like a la imagen -->
                            <?php $user_like = false; ?>

                            @foreach($image->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                <!-- osea que ya le dio like, porque se encontro una coincidenci entre el id del like de l aimagen con el usuario  autenticado -->
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            
                            @if($user_like)
                                <img src="{{ asset('img/hearts_red.png') }}" data-id="{{ $image->id }}" class="btn-dislike">
                            @else
                                <img src="{{ asset('img/heart_black.png') }}" data-id="{{ $image->id }}" class="btn-like">
                            @endif

                            <span class="likes cuenta_like">{{ count($image->likes) }}</span>
                            
                        </div>
                        
                    </div>
                    
                    <div class="comments">
                        <h2 href="" class="">
                        Comentarios ({{ count($image->comments) }})
                        </h2>
                        @include('includes.message')
                        <hr>
                        <form method="post" action=" {{ route('comment.save') }} ">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                                
                            <p>
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>
                                    
                                </textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                            <button type="submit" class="btn btn-success">Comentar</button>
                        </form>

                        @foreach($image->comments as $comment)
                            <div class="comment">
                                <div class="navbar-usuario">

                                    <div class="navbar-avatar"> 
                                        <img  src="{{ route('user.avatar', ['filename' => $comment->user->image]) }}">
                                    </div>
                                    <a class="enlace_profile" href="{{ route('profile', ['id' => $comment->user->id]) }}">
                                         <p style="padding: .5rem" class="nick"> 
                                            {{ '@'. $comment->user->nick}} | {{ \FormatTime::LongTimeFilter($comment->created_at) }}

                                            @if(\Auth::check() && ($comment->user_id == \Auth::user()->id || $comment->image->user_id == \Auth::user()->id))

                                                <a class="btn eliminar-comentario" href="{{ route('comment.delete', ['id' => $comment->id]) }}">eliminar</a>

                                            @endif
                                        </p>
                                    </a>
                                </div>
                                
                                {{ $comment->content }}
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
