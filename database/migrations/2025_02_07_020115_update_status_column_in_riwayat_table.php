<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('riwayat', function (Blueprint $table) {
            // Hapus default value sebelum mengubah ENUM
            \DB::statement("ALTER TABLE riwayat MODIFY COLUMN status VARCHAR(50)");

            // Pastikan semua status sesuai ENUM
            \DB::statement("UPDATE riwayat SET status = 'proses' WHERE status NOT IN ('proses', 'selesai')");

            // Baru ubah menjadi ENUM
            \DB::statement("ALTER TABLE riwayat MODIFY COLUMN status ENUM('proses', 'selesai') NOT NULL DEFAULT 'proses'");
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat', function (Blueprint $table) {
            // Jika ingin mengembalikan ke string biasa
            $table->string('status', 50)->change();
        });
    }
};
