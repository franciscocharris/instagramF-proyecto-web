@if(\Auth::check() && (\Auth::user()->id == $image->user->id))
    <div class="nav-item dropdown ">     
        <div id="navbarDropdown" class=" nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
         <span class="caret"></span>
        </div>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('image.delete', ['id' => $image->id]) }}" >
                Borrar
            </a>
            

            <a class="dropdown-item" href="{{route('image.edit', ['id' => $image->id])}}" >
                editar
            </a>

        </div>
    </div>
@endif