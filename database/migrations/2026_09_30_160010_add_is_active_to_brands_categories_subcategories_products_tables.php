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
        if (Schema::hasTable('brands') && !Schema::hasColumn('brands', 'is_active')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('description');
            });
        }

        if (Schema::hasTable('categories') && !Schema::hasColumn('categories', 'is_active')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('description');
            });
        }

        if (Schema::hasTable('subcategories') && !Schema::hasColumn('subcategories', 'is_active')) {
            Schema::table('subcategories', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }

        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'is_active')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('brands') && Schema::hasColumn('brands', 'is_active')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }

        if (Schema::hasTable('categories') && Schema::hasColumn('categories', 'is_active')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }

        if (Schema::hasTable('subcategories') && Schema::hasColumn('subcategories', 'is_active')) {
            Schema::table('subcategories', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }

        if (Schema::hasTable('products') && Schema::hasColumn('products', 'is_active')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};
