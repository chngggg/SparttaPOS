<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sparepart_id')->constrained()->onDelete('cascade');
            $table->string('barcode_number')->unique();
            $table->enum('type', ['ean13', 'code128', 'qr', 'datamatrix'])->default('code128');
            $table->string('format')->nullable();
            $table->text('barcode_image')->nullable();
            $table->integer('times_printed')->default(0);
            $table->timestamp('last_printed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('barcode_number');
            $table->index('sparepart_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barcodes');
    }
};
