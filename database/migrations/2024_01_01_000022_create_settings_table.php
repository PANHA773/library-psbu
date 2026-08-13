<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('setting_id')->primary();
            $table->string('logo', 255);
            $table->string('site_name', 55)->nullable();
            $table->string('language', 20)->nullable();
            $table->string('version', 10)->default('1.0');
            $table->string('student_prefix', 20)->nullable();
            $table->string('book_prefix', 20)->nullable();
            $table->string('attendance_prefix', 20)->nullable();
            $table->string('borrow_prefix', 20)->nullable();
            $table->string('theme', 20)->nullable();
            $table->string('timezone', 100)->nullable();
            $table->integer('iwidth')->default(0);
            $table->integer('iheight')->nullable();
            $table->boolean('watermark')->nullable();
            $table->boolean('captcha')->default(0);
            $table->boolean('is_demo')->default(0);
            $table->boolean('hidden_login_btn')->default(0);
            $table->string('ip_address_allow', 20)->default('0');
            $table->string('start_ip_address', 20)->default('0');
            $table->string('end_ip_address', 20)->default('0');
            $table->boolean('using_in_area')->default(0);
            $table->boolean('avariable_register_page')->default(0);
            $table->string('site_prefix', 100)->nullable();
            $table->string('lat', 60)->nullable();
            $table->string('lng', 60)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
