<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom role
            $table->enum('role', ['super_admin', 'admin', 'kasir'])
                ->default('kasir')
                ->after('email');

            // Tambah kolom phone
            $table->string('phone')->nullable()->after('role');

            // Tambah kolom is_active
            $table->boolean('is_active')->default(true)->after('phone');

            // Tambah kolom created_by (untuk tracking siapa yang buat user)
            $table->foreignId('created_by')
                ->nullable()
                ->after('is_active')
                ->constrained('users')
                ->nullOnDelete();

            // Tambah soft deletes
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn(['role', 'phone', 'is_active', 'created_by']);
            $table->dropSoftDeletes();
        });
    }
};
