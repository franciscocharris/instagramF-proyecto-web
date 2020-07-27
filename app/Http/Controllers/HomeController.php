<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$images = Image::orderBy('id', 'desc')->get(); para obtener las imagenes que es l mismo pero para paginar lo de abajo a continuacion
        $images = Image::orderBy('id', 'desc')->paginate(5);
        return view('home', [
            'images' => $images
        ]);
    }
}
