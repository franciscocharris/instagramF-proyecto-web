<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //muchos a uno
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
    //muchos a uno la tabla likes tiene llaves foraneas para referirse a las tablas de ususrios e imagenes
    public function image(){
    	return $this->belongsTo('App\Image', 'image_id');
    }
    

}
