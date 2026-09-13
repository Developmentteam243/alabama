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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('author_name')->nullable()->after('tag');
            $table->text('excerpt')->nullable()->after('author_name');
            $table->string('image_alt')->nullable()->after('image_url');
            $table->string('primary_keyword')->nullable()->after('meta_description');
            $table->text('secondary_keywords')->nullable()->after('primary_keyword');
            $table->string('og_title')->nullable()->after('secondary_keywords');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image_url')->nullable()->after('og_description');
            $table->string('twitter_title')->nullable()->after('og_image_url');
            $table->text('twitter_description')->nullable()->after('twitter_title');
            $table->longText('schema_markup')->nullable()->after('twitter_description');
            $table->json('faqs')->nullable()->after('schema_markup');
            $table->json('internal_external_links')->nullable()->after('faqs');
            $table->json('related_blog_ids')->nullable()->after('internal_external_links');
            $table->json('related_product_ids')->nullable()->after('related_blog_ids');
            $table->string('status', 20)->default('published')->after('is_active');
            $table->timestamp('published_at')->nullable()->after('status');
            $table->timestamp('scheduled_at')->nullable()->after('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'author_name',
                'excerpt',
                'image_alt',
                'primary_keyword',
                'secondary_keywords',
                'og_title',
                'og_description',
                'og_image_url',
                'twitter_title',
                'twitter_description',
                'schema_markup',
                'faqs',
                'internal_external_links',
                'related_blog_ids',
                'related_product_ids',
                'status',
                'published_at',
                'scheduled_at'
            ]);
        });
    }
};
