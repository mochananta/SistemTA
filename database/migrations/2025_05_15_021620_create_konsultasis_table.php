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
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kua_id')->nullable();
            $table->unsignedBigInteger('rumah_ibadah_id')->nullable();
            $table->string('kode_layanan')->unique();
            $table->string('jenis_konsultasi');
            $table->date('tanggal_konsultasi');
            $table->date('jadwal_konsultasi_tanggal')->nullable();
            $table->time('jadwal_konsultasi_jam')->nullable();
            $table->text('isi_konsultasi');
            $table->text('alamat');
            $table->text('catatan')->nullable();
            $table->string('file_path');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kua_id')->references('id')->on('kuas')->onDelete('cascade');
            $table->foreign('rumah_ibadah_id')->references('id')->on('rumah_ibadah')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsultasis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['kua_id']);
        });

        Schema::dropIfExists('konsultasis');
    }
};
