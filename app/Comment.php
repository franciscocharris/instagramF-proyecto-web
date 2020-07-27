<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    //muchos a uno , el segundo parametro es la llave foranea que esta en la tabla comments que se refiere a la tabla usuarios
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
    
    public function image(){
    	return $this->belongsTo('App\Image', 'image_id');
    }
}
