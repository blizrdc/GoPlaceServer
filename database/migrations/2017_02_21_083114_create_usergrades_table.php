<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsergradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergrades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grade');
            $table->integer('requiredexperience');
            $table->string('addattack',6);
            $table->string('adddefense',6);
            $table->string('addlife',10);
            $table->integer('addcrit');
            $table->integer('addcriticaldamage');
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
        Schema::dropIfExists('usergrades');
    }
}
