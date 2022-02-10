<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body'];

    public function user(){
        // Un comentario es de un usuario
        return $this->belongsTo(User::class);
    }

    // si en lugar de pasarle la tabla le pasamos otro nombre, tendremos que pasarle el nombre de la clave foránea user_id
    // public function author(){
    //     return $this->belongsTo(User::class, 'user_id');
    // }


    public function post(){
        return $this->belongsTo(Post::class);
    }
}
