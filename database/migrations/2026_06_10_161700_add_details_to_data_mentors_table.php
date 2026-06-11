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
        Schema::table('data_mentor', function (Blueprint $table) {
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable()->unique();
            $table->enum('jk', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mentor', function (Blueprint $table) {
            $table->dropColumn(['no_hp', 'email', 'jk', 'status', 'foto']);
        });
    }
};
