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
        Schema::create('data_anak_magang', function (Blueprint $table) {
            $table->id();
            $table->string('nim_nisn', 50)->unique();
            $table->string('nama', 100);
            $table->string('instansi', 100);
            $table->date('tanggal_mulai_magang');
            $table->date('tanggal_selesai_magang');
            $table->unsignedBigInteger('mentor_id')->nullable();
            $table->enum('status_akun', ['Belum Dibuat', 'Aktif'])->default('Belum Dibuat');
            $table->timestamps();

            $table->foreign('mentor_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_anak_magang');
    }
};
