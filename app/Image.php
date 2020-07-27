<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //definiremos las relaciones entre modelos, los dos primero son uno a muchos y cuamdo se llame la funcion traera los registros que coinciden (id del objeto que coincide con los de la llave foranea de la tabla a la que esta relacionanda el modelo) 
    //una imagen tiene muchos comentarios
    public function comments(){
    	return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    public function likes(){
    	return $this->hasMany('App\Like');
    }
    //muchos a uno (muchas imagenes tienen un solo usuario), el segundo parametro es el tributo de la tabla imagenes que es en este caso, que es llave foranea que se refiere a la tabla usuario
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
