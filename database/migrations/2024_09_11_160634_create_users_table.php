<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('user');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender', 20)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('department', 100)->nullable();
            $table->string('faculty', 100)->nullable();
            $table->string('position', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
