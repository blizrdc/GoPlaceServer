<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeteggsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peteggs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weaponid')->unique();
            $table->string('name',15);
            $table->string('picture',10);
            $table->integer('requiredcost');
            $table->integer('grade');
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
        Schema::dropIfExists('peteggs');
    }
}
