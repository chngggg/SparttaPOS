<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');

            // Customer ID tanpa foreign key dulu
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->datetime('transaction_date');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('payment_amount', 15, 2)->default(0);
            $table->decimal('change_amount', 15, 2)->default(0);
            $table->enum('payment_method', ['cash', 'debit', 'credit', 'transfer', 'qris'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'cancelled', 'refund'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['invoice_number', 'transaction_date', 'status']);
            $table->index('user_id');
            $table->index('customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
