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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique()->comment('Used as subdomain: slug.showcase.test');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable()->comment('Rich content/documentation');
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('source_url')->nullable();
            $table->string('documentation_url')->nullable();
            $table->json('tech_stack')->nullable()->comment('Array of technologies used');
            $table->json('features')->nullable()->comment('Array of key features');
            $table->string('version')->default('1.0.0');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->integer('view_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
