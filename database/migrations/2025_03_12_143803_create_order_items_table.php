<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Link to the order
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Link to the product
            $table->integer('quantity'); // Quantity of the product in the order
            $table->decimal('price', 8, 2); // Price of the product at the time of order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
