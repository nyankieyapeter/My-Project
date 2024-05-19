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
            $table->string('product_name');
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->string('description');
            $table->integer('cost_price');
            $table->integer('selling_price');
            $table->integer('quantity');
            $table->dateTime('manufacturing_date');
            $table->dateTime('expiry_date');
            $table->string('status');
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
