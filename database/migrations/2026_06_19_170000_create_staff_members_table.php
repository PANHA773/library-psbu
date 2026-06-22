<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('member_type')->default('librarian');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('staff_members')->insert([
            [
                'name' => 'Library Director',
                'position' => 'Chief Librarian',
                'member_type' => 'leader',
                'description' => 'Leads the library strategy, growth, and service quality for students and researchers.',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'facebook_url' => null,
                'twitter_url' => null,
                'linkedin_url' => null,
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Archives Lead',
                'position' => 'Senior Archivist',
                'member_type' => 'librarian',
                'description' => 'Manages archival materials and preserves valuable academic and historical collections.',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
                'facebook_url' => null,
                'twitter_url' => null,
                'linkedin_url' => null,
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Digital Resources Officer',
                'position' => 'E-Resources Coordinator',
                'member_type' => 'librarian',
                'description' => 'Oversees OPAC, e-resources, and digital services for students and faculty.',
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
                'facebook_url' => null,
                'twitter_url' => null,
                'linkedin_url' => null,
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_members');
    }
};
