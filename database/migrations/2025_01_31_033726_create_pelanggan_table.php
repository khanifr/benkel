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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->string('ktp', 50)->primary(); // KTP sebagai Primary Key
            $table->string('nama', 100);
            $table->string('alamat', 255);
            $table->string('hp', 15);
            $table->string('email', 100)->unique(); // Tambah email dengan unique constraint
            $table->string('password'); // Tambah password
            $table->string('foto_profile')->nullable(); // Tambah foto profile, nullable jika tidak wajib diisi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
