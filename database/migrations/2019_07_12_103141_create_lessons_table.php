<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('teacher_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->date('lesson_date')->nullable();
            $table->string('lesson_time')->nullable();
            $table->string('lesson_time_end')->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
