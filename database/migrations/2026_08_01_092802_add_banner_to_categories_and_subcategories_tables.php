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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('banner_url')->nullable()->after('meta_description');
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->string('banner_url')->nullable()->after('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('banner_url');
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropColumn('banner_url');
        });
    }
};
