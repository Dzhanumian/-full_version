<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_s')->nullable();
            $table->string('responsible')->nullable();
            $table->string('relations')->nullable();  
            $table->string('surname_r')->nullable();
            $table->string('name_r')->nullable();
            $table->string('patronymic_r')->nullable(); 
            $table->date('date_of_birth_r')->nullable();
            $table->string('phone_number_r')->nullable();
            $table->string('studied_or_studying_r')->nullable(); 
            $table->string('field_of_activity')->nullable();    
            $table->string('education')->nullable();
            $table->string('meaning')->nullable(); 
            $table->string('about_us')->nullable();
            $table->string('payouts')->nullable();
            $table->string('status')->nullable();
            $teble->string('studied')->nullable();
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
        Schema::dropIfExists('students');
    }
}

/*

            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->string('level_and_language');
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->date('employment_date')->nullable();
            $table->date('date_of_dismissal')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->string('comment')->nullable();
            $table->rememberToken();
            $table->timestamps();