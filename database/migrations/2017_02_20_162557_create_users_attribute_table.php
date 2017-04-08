<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_attribute', function (Blueprint $table) {
            $table->integer('userid');
            $table->primary('userid');
     		$table->integer('grade');
     		$table->integer('experience');
     		$table->string('attack',6);
     		$table->string('defense',6);
     		$table->string('life',10);
     		$table->integer('crit');
     		$table->integer('criticaldamage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_attribute');
    }
}
