<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
    	$user = \Auth::user();

    	$likes = Like::where('user_id', $user->id)->orderby('id', 'desc')->paginate(5);

    	return view('like.likes', [
    		'likes' => $likes
    	]);
    }

    public function like($image_id){
    	//recojer datos del ususario y la imagen

    	$user = \Auth::user();
    	$like = new Like();

    	//condicion para saber si ya existe
    	$isset_like = Like::where('user_id', $user->id)
    					  ->where('image_id', $image_id)
    					  ->count();

		if($isset_like == 0){
			$like->user_id = $user->id;
	    	$like->image_id = (int) $image_id;

	    	//guardar

	    	$like->save();

	    	return response()->json([
	    		'like' => $like
	    	]);
		}else{
			return response()->json([
				'message' => 'el like ya existe'
			]);
		}
    	
    	
    }

    public function dislike($image_id){

    	//recojer datos del ususario y la imagen

    	$user = \Auth::user();
    	$like = new Like();

    	//condicion para saber si ya existe
    	$like = Like::where('user_id', $user->id)
				    ->where('image_id', $image_id)
				    ->first();

		if($like){
	    	//eliminar

	    	$like->delete();

	    	return response()->json([
	    		'like' => $like,
	    		'message' => 'dislike'
	    	]);
		}else{
			return response()->json([
				'message' => 'el like no existe'
			]);
		}

    }

    
}
