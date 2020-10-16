<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adduser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adduser', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
           // $table->string('hobbies');
            $table->string('gender');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            //$table->string('filename');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adduser');
    }
}
