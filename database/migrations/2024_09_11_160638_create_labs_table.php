<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 50);
            $table->string('building', 50)->nullable();
            $table->boolean('lab_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labs');
    }
}

