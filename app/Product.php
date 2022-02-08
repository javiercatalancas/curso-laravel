<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

// public function getRouteKeyName(){
    //     return 'pk_producto';
    // }



    // Si la tabla se llama de forma distinta a la convención de nombres, hay que decírselo
    protected $table = 'mis_productos';
    protected $primaryKey = 'id_producto';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $attributes = [
        'status' => false,
    ];

    // 
    


}
