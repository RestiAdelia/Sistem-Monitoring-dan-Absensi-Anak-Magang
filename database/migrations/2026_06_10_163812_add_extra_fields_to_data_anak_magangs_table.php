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
        Schema::table('data_anak_magang', function (Blueprint $table) {

        $table->string('bidang')->nullable();
        $table->enum('jk', ['Laki-laki', 'Perempuan'])->nullable();
        $table->enum('status_magang', ['Berjalan', 'Selesai', 'Diberhentikan'])->default('Berjalan');
    });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_anak_magangs', function (Blueprint $table) {
            $table->dropColumn(['bidang', 'jk', 'status_magang']);
        });
    }
};
