<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no', 50)->unique();
            $table->integer('student_id')->default(0);
            $table->string('note', 1000)->nullable();
            $table->string('status', 25)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->decimal('term', 16, 0)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
