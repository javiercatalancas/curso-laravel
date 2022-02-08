<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function(Blueprint $table){
          //  $table ->id(); // autoincremental
            //$table ->timestamps(); // created_at y updated_at
            $table ->increments('id');
            $table ->string('name');
            $table ->string('description', 1000);
            $table ->integer('quantity')->unsigned();
            $table ->boolean('status');
            $table ->integer('seller_id')->unsigned();
            $table ->timestamps();
            // $table ->foreign('seller_id')
            //         ->references('id')
            //         ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
