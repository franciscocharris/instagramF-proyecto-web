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
            <a href=" {{ route('image.detail', ['id' => $image->id]) }} ">
                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}">
            </a>
        </div>
        

        <p style="padding: .5rem" class="nick"> 
            {{ '@'. $image->user->nick}} | {{ \FormatTime::LongTimeFilter($image->created_at) }}
        </p>
        @if(isset($image->description))
            <div class="description">
                <a href=" {{ route('image.detail', ['id' => $image->id]) }} ">
                    {{ $image->description }}
                </a>
            </div>
        @endif

        

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
            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="buttom btn btn-comentarios">Comentarios ({{ count($image->comments) }})</a>
        </div>
        
    </div>
</div>