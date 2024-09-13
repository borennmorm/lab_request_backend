<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // session_id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 50);
            $table->string('number', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}

