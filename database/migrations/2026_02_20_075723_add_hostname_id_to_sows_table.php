<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sows', function (Blueprint $table) {
            $table->foreignId('hostname_id')
                ->nullable()
                ->after('nomor_perbaikan') // ✅ posisi setelah nomor_perbaikan
                ->constrained('hostnames')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('sows', function (Blueprint $table) {
            $table->dropForeign(['hostname_id']);
            $table->dropColumn('hostname_id');
        });
    }
};