<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Like;
use App\Comment;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
    	return view('image.create');
    }

    public function save(Request $request){

    	//validacion
    	$validate = $this->validate($request, [
    		'image_path' => ['required', 'image'],
    		'description' => ['string', 'max:180']
    	]);

    	$image_path = $request->file('image_path');
    	$description = $request->input('description');

    	//asignar valores nuevo objeto

    	$user = \Auth::user();
    	$image = new Image();
    	$image->user_id = $user->id;
    	$image->description = $description;
        //si la imagen es valida
    	if($image_path){
            //poner un nombre unico a la imagen subida
    		$image_path_name = time().$image_path->getClientOriginalName();
            //guardarlo en el disco de imagenes
    		Storage::disk('images')->put($image_path_name, File::get($image_path));
            //seterar el image_path el nombre unico
    		$image->image_path = $image_path_name;
    	}
        //guardar en la base de datos
    	$image->save();

    	return redirect()->route('home')->with([
    		'message' => 'Foto subida correctamente'
    	]);

    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image 
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $likes = Like::where('image_id', $id)->get();
        $comments = Comment::where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id){
            //eliminar los comentarios
            if($comments && count($comments) > 0){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            //eliminar los likes
            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);
            //eliminar registro de la imagen
            $image->delete();

            $message = array('message' => 'Imagen Eliminada Correctamente');
        }else{
            $message = array('message' => 'Error al Eliminar la imagen');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user = \Auth::user();

        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){
            return view('image.edit',[
                'image' => $image
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update (Request $request){

        $validate = $this->validate($request, [
            'image_path' => [ 'image'],
            'description' => ['string', 'max:180']
        ]);


        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');


        //conseguir el objeto image
        $image = Image::find($image_id);
        $image->description = $description;

        //si la imagen es valida
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])->with('message', 'publicacion actualizada correctamente');

    }
}
