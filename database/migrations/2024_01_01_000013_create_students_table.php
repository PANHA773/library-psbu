<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 55);
            $table->string('first_name', 55);
            $table->string('last_name', 55);
            $table->string('nick_name', 55)->nullable();
            $table->string('gender', 55)->nullable();
            $table->date('dob')->nullable();
            $table->string('pob', 64)->nullable();
            $table->string('phone', 64)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('father_phone', 64)->nullable();
            $table->string('mother_phone', 64)->nullable();
            $table->string('image', 65)->nullable();
            $table->integer('province_id')->nullable();
            $table->string('slug', 55)->nullable();
            $table->text('description')->nullable();
            $table->string('shift', 25)->nullable();
            $table->string('skills', 50)->nullable();
            $table->string('batch', 25)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
