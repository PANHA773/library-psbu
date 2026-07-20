<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->index('created_by');
            $table->index('created_at');
            $table->index('department_id');
        });

        Schema::table('borrowers', function (Blueprint $table) {
            $table->index('created_by');
            $table->index('created_at');
            $table->index('student_id');
            $table->index('status');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('student_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('department_id');
            $table->index('user_type');
            $table->index('activated');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['created_by']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['department_id']);
        });

        Schema::table('borrowers', function (Blueprint $table) {
            $table->dropIndex(['created_by']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['student_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['student_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['department_id']);
            $table->dropIndex(['user_type']);
            $table->dropIndex(['activated']);
        });
    }
};
