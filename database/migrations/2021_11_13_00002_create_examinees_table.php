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
            $table->integer('exam_id')->default('0');
            $table->integer('user_id');
            $table->date('birthdate');
            $table->integer('gender');
            $table->string('marital');
            $table->string('prev_school');
            $table->string('strand');
            $table->string('perm_address');
            $table->string('cur_address');
            $table->integer('no_siblings');
            $table->integer('order_siblings');
            $table->string('weight');
            $table->string('height');
            $table->string('nationality');
            $table->string('religion');
            $table->string('f_fname');
            $table->string('f_mname');
            $table->string('f_lname');
            $table->string('f_occupation');
            $table->string('f_mobile');
            $table->string('m_fname');
            $table->string('m_mname');
            $table->string('m_lname');
            $table->string('m_occupation');
            $table->string('m_mobile');
            $table->string('emergency_name');
            $table->string('emergency_mobile');
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
