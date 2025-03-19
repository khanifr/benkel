<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->string('nopol', 20)->primary();
            $table->string('merek', 50);
            $table->string('tipe', 50);
            $table->enum('transmisi', ['manual', 'matic']);
            $table->integer('kapasitas');
            $table->integer('tahun');

            // Pastikan tipe dan panjang sama persis dengan pelanggan.ktp
            $table->string('id_pelanggan', 50);

            // Tambahkan Foreign Key
            $table->foreign('id_pelanggan')->references('ktp')->on('pelanggan')->onDelete('cascade');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
