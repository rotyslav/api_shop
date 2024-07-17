<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('buyer_uuid')->constrained('users', 'uuid');
            $table->foreignUuid('seller_uuid')->constrained('users', 'uuid');
            $table->foreignUuid('product_name');
            $table->float('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
