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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code_sale')->unique();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('cadastrado_por')->references('id')->on('users');
            $table->date('date')->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->softDeletes();
            $table->integer('status')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
