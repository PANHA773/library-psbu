<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'pdf')) {
                $table->string('pdf')->nullable()->after('image');
            }

            if (!Schema::hasColumn('books', 'pdf_downloadable')) {
                $table->boolean('pdf_downloadable')->default(true)->after('pdf');
            }

            if (!Schema::hasColumn('books', 'department_id')) {
                $table->foreignId('department_id')
                    ->nullable()
                    ->after('category_id')
                    ->constrained('departments')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'department_id')) {
                $table->dropConstrainedForeignId('department_id');
            }

            if (Schema::hasColumn('books', 'pdf_downloadable')) {
                $table->dropColumn('pdf_downloadable');
            }

            if (Schema::hasColumn('books', 'pdf')) {
                $table->dropColumn('pdf');
            }
        });
    }
};
