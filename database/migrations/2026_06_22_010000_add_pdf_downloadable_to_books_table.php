<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'pdf_downloadable')) {
                $table->boolean('pdf_downloadable')->default(true)->after('pdf');
            }
        });

        if (Schema::hasColumn('books', 'pdf_downloadable')) {
            DB::table('books')->whereNull('pdf_downloadable')->update(['pdf_downloadable' => 1]);
        }
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'pdf_downloadable')) {
                $table->dropColumn('pdf_downloadable');
            }
        });
    }
};
