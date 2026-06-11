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
        Schema::table('absensis', function (Blueprint $table) {
        $table->string('status_approval')->default('approved'); 
        $table->string('lampiran')->nullable(); 
        $table->text('keterangan_admin')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn(['status_approval', 'lampiran', 'keterangan_admin']);
        });
    }
};
