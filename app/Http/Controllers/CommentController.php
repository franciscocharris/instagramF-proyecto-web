<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

    	//validacion
    	$validate = $this->validate($request, [
    		'image_id' => ['integer', 'required'],
    		'content' => ['required','string','max:200']
    	]);

    	//recojer datos
    	$user = \Auth::user();
    	$image_id = $request->input('image_id');
    	$content = $request->input('content');

    	//asigno los valores al objeto a guardar
    	$comment = new Comment();

    	$comment->user_id = $user->id;
    	$comment->image_id = $image_id;
    	$comment->content = $content;

    	//guardar en la base de datos
    	$comment->save();

    	return redirect()->route('image.detail', ['id' => $image_id ])
    					 ->with(['message' => 'Se ha publicado el comentario Correctamente']);
    }


    public function delete($id){

    	//conseguir datos del usuario identificado
    	$user = \Auth::user();

    	//conseguir el objeto del comentario
    	$comment = Comment::find($id);

    	//comprobar si el ususario autenticado es el dueño del comentario
    	if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
    		$comment->delete();

    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    						 ->with(['message' => 'comentario eliminado']);
    	}else{
    		return redirect()->route('image.detail', ['id' => $comment->image->id])
    						 ->with(['message' => 'el comentario nose a eliminado']);
    	}
    }
}
