<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->timestamp('date')->useCurrent();
            $table->dateTime('from_date')->nullable();
            $table->dateTime('till_date')->nullable();
            $table->tinyInteger('scope')->default(3);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
