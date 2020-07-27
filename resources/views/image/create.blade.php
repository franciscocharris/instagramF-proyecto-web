@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<!-- mensaje de actualizacio exitosa -->
        	@include('includes.message');
        	<!-- fin de mensaje -->
            <div class="card">
                <div class="card-header text-md-center">
                    Subir nueva imagen
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">{{ __('Image_path') }}</label>

                            <div class="col-md-6">
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path"  autofocus>

                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input  type="submit"  class="btn btn-primary" value="subir imagen" >
                            </div>            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
