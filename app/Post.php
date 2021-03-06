<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title'];

public function author(){
    
    return $this->belongsTo(User::class, 'user_id');

    }

public function comments(){
    return $this->hasMany(Comment::class);
}


}
