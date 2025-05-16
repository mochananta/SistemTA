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
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kua_id')->nullable(); 
            $table->string('kode_layanan')->unique();
            $table->string('jenis_surat');
            $table->string('nama');
            $table->string('nik');
            $table->string('nohp');
            $table->text('alamat');
            $table->date('tanggal_pengajuan');
            $table->string('file_path');
            $table->string('status')->default('Menunggu Verifikasi'); 
            $table->text('catatan')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kua_id')->references('id')->on('kuas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['kua_id']);
        });
    
        Schema::dropIfExists('pengajuan_surats');  
    }
};
