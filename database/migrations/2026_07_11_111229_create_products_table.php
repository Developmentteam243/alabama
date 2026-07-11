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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code')->unique();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->string('item_code')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_family')->nullable();
            $table->string('model_name')->nullable();
            $table->string('capacity_l')->nullable();
            $table->string('orientation_mounting')->nullable();
            $table->string('heating_power_kw')->nullable();
            $table->string('voltage')->nullable();
            $table->string('max_working_pressure_bar')->nullable();
            $table->string('height_length_mm')->nullable();
            $table->string('diameter_width_mm')->nullable();
            $table->string('tank_protection_lining')->nullable();
            $table->string('heating_element')->nullable();
            $table->string('warranty_yrs')->nullable();
            $table->string('mfr_part_code')->nullable();
            $table->string('source_catalogue')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
