<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50)->unique();
            $table->string('title', 255);
            $table->string('image', 255)->nullable();
            $table->longText('details')->nullable();
            $table->string('slug', 55)->nullable();
            $table->integer('views')->default(0);
            $table->string('author', 60)->nullable();
            $table->date('author_date')->nullable();
            $table->integer('category_lang_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->decimal('price', 10, 4)->default(0);
            $table->string('barcode_symbol', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
