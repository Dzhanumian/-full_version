<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventLogsTable extends Migration
{

    public function up()
    {
        Schema::create('event_logs', function (Blueprint $table) {
            $table->bigIncrements('id');                      
            $table->integer('user_id')->nullable();           
            $table->integer('user_id_event')->nullable();     
            $table->string('user_name')->nullable();          
            $table->string('user_name_event')->nullable();    
            $table->string('event');                          
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
}
