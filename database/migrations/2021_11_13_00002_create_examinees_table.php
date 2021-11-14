<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinees', function (Blueprint $table) {
            $table->id();
            $table->string('lrn');
            $table->integer('user_id');
            $table->date('birthdate');
            $table->integer('gender');
            $table->integer('college');
            $table->integer('course');
            $table->integer('status');
            $table->rememberToken();
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
        Schema::dropIfExists('examinees');
    }
}
