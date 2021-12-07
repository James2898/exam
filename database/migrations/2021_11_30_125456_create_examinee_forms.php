<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamineeForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinee_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('examinee_id');
            $table->integer('exam_id');
            $table->integer('subject_id');
            $table->string('question_id');
            $table->string('question');
            $table->string('answer');
            $table->integer('result');
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
        Schema::dropIfExists('examinee_forms');
    }
}
