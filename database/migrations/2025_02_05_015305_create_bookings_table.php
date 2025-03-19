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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('no_urut');
            $table->string('nik', 50); // Pastikan panjang dan tipe sama dengan `pelanggans.nik`
            $table->date('tanggal_booking');
            $table->date('tanggal_penanganan');
            $table->string('no_antrian_per_hari');
            
            // Add vehicle details
            $table->string('nopol', 20);  // Nomor polisi kendaraan
            $table->string('merek', 100);  // Merek kendaraan
            $table->string('tipe', 100);   // Tipe kendaraan
            $table->string('transmisi', 50); // Transmisi kendaraan (e.g., manual, automatic)
            $table->integer('kapasitas');  // Kapaswitas kendaraan (in liters or seats, depending on your requirement)
            $table->year('tahun');         // Tahun kendaraan
            
            $table->timestamps();

            $table->foreign('nik')->references('ktp')->on('pelanggan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
