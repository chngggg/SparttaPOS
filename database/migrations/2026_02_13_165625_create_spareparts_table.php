<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('barcode')->unique()->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('restrict');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('unit')->default('pcs');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(5);
            $table->integer('max_stock')->nullable();
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->decimal('selling_price', 15, 2)->default(0);
            $table->decimal('discount', 5, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('location_rack')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['code', 'name', 'brand']);
            $table->index('stock');
            $table->index('min_stock');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
