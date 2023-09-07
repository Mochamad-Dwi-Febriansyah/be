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
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tugas_id')->unsigned()->index()->nullable();
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('siswa_id')->unsigned()->index()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->bigInteger('pertemuan_id')->unsigned()->index()->nullable();
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade'); 
            $table->enum('status_pengumpulan', ['0', '1', '2'])->default('0');
            $table->string('nilai_pengumpulan')->nullable();
            $table->enum('telat_pengumpulan', ['0', '1'])->default('0');
            $table->date('terakhir_diubah')->nullable();
            $table->string('file_pengumpulan')->nullable();
            $table->string('keterangan_pengumpulan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
