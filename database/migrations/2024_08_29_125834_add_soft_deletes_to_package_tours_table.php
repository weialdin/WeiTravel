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
        Schema::table('package_tours', function (Blueprint $table) {
            // Cek apakah kolom deleted_at sudah ada, jika belum, tambahkan
            if (!Schema::hasColumn('package_tours', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_tours', function (Blueprint $table) {
            // Menghapus kolom deleted_at saat rollback jika diperlukan
            if (Schema::hasColumn('package_tours', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};
