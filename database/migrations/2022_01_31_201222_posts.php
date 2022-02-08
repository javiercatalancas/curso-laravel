<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table){
            $table -> increments('id');
            $table -> unsignedInteger('user_id');
            $table -> string('title')->collation('utf8mb4_unicode_ci');
            $table -> string('status')
                   ->collation('utf8mb4_unicode_ci')
                   ->default("draft");
            $table ->timestamps();
            $table ->foreign('user_id')
                    ->references('id')
                    ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
