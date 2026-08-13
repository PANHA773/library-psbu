<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->integer('shop_id')->primary();
            $table->string('shop_name', 55);
            $table->string('description', 160);
            $table->string('keyword', 255);
            $table->string('address', 255)->nullable();
            $table->string('about_link', 55);
            $table->string('terms_link', 55);
            $table->string('privacy_link', 55);
            $table->string('contact_link', 55);
            $table->string('payment_text', 100);
            $table->string('follow_text', 100);
            $table->string('facebook', 55);
            $table->string('twitter', 55)->nullable();
            $table->string('google_plus', 55)->nullable();
            $table->string('instagram', 55)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 55)->nullable();
            $table->string('cookie_message', 180)->nullable();
            $table->string('cookie_link', 55)->nullable();
            $table->text('slider')->nullable();
            $table->integer('shipping')->nullable();
            $table->string('purchase_code', 100)->default('purchase_code');
            $table->string('envato_username', 50)->default('envato_username');
            $table->string('version', 10)->default('3.4.53');
            $table->string('logo', 65)->nullable();
            $table->string('bank_details', 255)->nullable();
            $table->boolean('products_page')->nullable();
            $table->boolean('hide0')->default(0);
            $table->string('products_description', 255)->nullable();
            $table->boolean('private')->default(0);
            $table->boolean('hide_price')->default(0);
            $table->boolean('stripe')->default(0);
            $table->string('youtube', 55)->nullable();
            $table->string('workday', 55)->nullable();
            $table->string('linkedin', 55)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_settings');
    }
};
