<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('email', 191)->unique('users_email_unique');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('phone', 20)->nullable();
            $table->string('avatar', 80)->nullable();
            $table->boolean('activated');
            $table->string('activate_code', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('experience', 200)->nullable();
            $table->string('skills', 100)->nullable();
            $table->boolean('is_agree')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->integer('facebook_id')->nullable();
            $table->integer('google_id')->nullable();
            $table->string('user_type', 50)->default('user');
            $table->string('last_login_ip', 50)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('brower_login', 50)->nullable();
            $table->string('os_login', 50)->nullable();
            $table->string('qrcode_token', 200)->nullable();
            $table->integer('student_id')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_ban')->default(0);
            $table->string('major', 55)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('username', 255)->nullable();

            $table->engine = 'MyISAM';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
