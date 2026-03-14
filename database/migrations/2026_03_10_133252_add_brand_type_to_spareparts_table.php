<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spareparts', function (Blueprint $table) {
            // Cek apakah kolom sudah ada
            if (!Schema::hasColumn('spareparts', 'brand_type')) {
                $table->enum('brand_type', ['viar', 'non-viar', 'optional'])
                    ->default('viar')
                    ->after('brand')
                    ->comment('Tipe brand: viar original, non-viar, optional');
            }
        });
    }

    public function down(): void
    {
        Schema::table('spareparts', function (Blueprint $table) {
            if (Schema::hasColumn('spareparts', 'brand_type')) {
                $table->dropColumn('brand_type');
            }
        });
    }
};
