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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->string('code_sale')->references('code_sale')->on('sales');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->integer('status');
            $table->softDeletes();
            $table->foreignId('cadastrado_por')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
