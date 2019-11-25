<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->integer('group_id');
            $table->string('group_name');
            $table->float('invoice');
            $table->integer('quantity')->nullable();
            $table->date('month');
            $table->integer('designed');
            $table->string('comment')->nullable();
            $table->integer('tarif')->nullable();
            $table->float('balance')->nullable();
            $table->string('initials')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('finances');
    }
}
