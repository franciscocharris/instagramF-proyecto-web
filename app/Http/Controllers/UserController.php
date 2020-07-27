<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null){

        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('surname', 'LIKE', '%'.$search.'%')
                        ->orderBy('id', 'desc')
                        ->paginate(32);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(32);
        }
       

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function config(){
    	return view('user.config');
    }

    public function update(Request $request){
    	//conseguir usuario identificado
    	$user = \Auth::user();
    	$id = $user->id;

    	//validar los datos del formulario
    	$validate = $this->validate($request,[
    		'name' => ['string', 'max:255'],
    		'surname' => ['string', 'max:255'],
    		'nick' => ['string', 'max:255', "unique:users,nick,{$id}"],
    		'email' => ['string', 'email', 'max:255', "unique:users,email,{$id}"],
    		'password' => ['required', 'string', 'min:5', 'confirmed']
    	]);

    	//recojer datos del formulario
    	$name =	$request->input('name');
    	$surname =	$request->input('surname');
    	$nick =	$request->input('nick');
    	$email =	$request->input('email');
    	$password =	Hash::make($request->input('password'));

    	//subir la imagen
    	//recojer la imagen del formulario
    	$image_path = $request->file('image_path');

    	if($image_path){
    		//poner nombre unico a la imagen subida
    		$image_path_name =  time().$image_path->getClientOriginalName();

    		// guardar en la carpeta storage (storage/app/users)
    		Storage::disk('users')->put($image_path_name, File::get($image_path));

    		//setear al objeto para que guarde la imagen

    		$user->image = $image_path_name;
    	}

    	//asignar nuevos valores al objeto de usuarios
    	$user->name = $name;
    	$user->surname = $surname;
    	$user->nick = $nick;
    	$user->email =  $email;
    	$user->password = $password;

    	//actualizar en la base de datos

    	$user->update();

    	return redirect()->route('config')
    					 ->with(['message' => 'Usuario Actualizado Correctamente']);
    }

    public function getImage($filename){
    	$file = Storage::disk('users')->get($filename);

    	return new Response($file, 200);
    }

    public function profile($id){

        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }

    
}
