<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_borrowers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->default(0);
            $table->integer('borrower_id')->default(0);
            $table->decimal('quantity', 16, 0)->nullable();
            $table->string('book_code', 55)->nullable();
            $table->string('book_name', 55)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_borrowers');
    }
};
