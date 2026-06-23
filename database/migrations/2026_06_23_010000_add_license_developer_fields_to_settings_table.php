<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('license_dev_name', 100)->nullable()->after('lng');
            $table->string('license_dev_phone', 30)->nullable()->after('license_dev_name');
            $table->string('license_dev_telegram', 100)->nullable()->after('license_dev_phone');
            $table->string('license_dev_email', 100)->nullable()->after('license_dev_telegram');
            $table->string('license_dev_whatsapp', 30)->nullable()->after('license_dev_email');
            $table->text('license_dev_note')->nullable()->after('license_dev_whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'license_dev_name',
                'license_dev_phone',
                'license_dev_telegram',
                'license_dev_email',
                'license_dev_whatsapp',
                'license_dev_note',
            ]);
        });
    }
};
