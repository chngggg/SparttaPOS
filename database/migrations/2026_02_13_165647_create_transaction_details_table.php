<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->foreignId('sparepart_id')->constrained()->onDelete('restrict');
            $table->string('sparepart_name');
            $table->string('sparepart_code');
            $table->string('barcode')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();

            $table->index(['transaction_id', 'sparepart_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
