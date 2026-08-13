<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name', 191);
            $table->string('group_name', 200)->nullable();
            $table->string('guard_name', 191);
            $table->timestamps();

            $table->unique(['name', 'group_name'], 'permissions_name_guard_name_unique');

            $table->foreign('group_id')
                ->references('id')->on('permission_groups')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
