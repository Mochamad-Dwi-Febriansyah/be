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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kelas_id')->unsigned()->index()->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->bigInteger('mapel_id')->unsigned()->index()->nullable();
            $table->foreign('mapel_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->string('pertemuan_ke');
            $table->string('judul_pertemuan');
            $table->date('tgl_pertemuan'); 
            $table->bigInteger('tugas_1')->unsigned()->index()->nullable();
            $table->foreign('tugas_1')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('tugas_2')->unsigned()->index()->nullable();
            $table->foreign('tugas_2')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('tugas_3')->unsigned()->index()->nullable();
            $table->foreign('tugas_3')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('tugas_4')->unsigned()->index()->nullable();
            $table->foreign('tugas_4')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('tugas_5')->unsigned()->index()->nullable();
            $table->foreign('tugas_5')->references('id')->on('tugas')->onDelete('cascade'); 

            $table->bigInteger('materi_1')->unsigned()->index()->nullable();
            $table->foreign('materi_1')->references('id')->on('materis')->onDelete('cascade');
            $table->bigInteger('materi_2')->unsigned()->index()->nullable();
            $table->foreign('materi_2')->references('id')->on('materis')->onDelete('cascade');
            $table->bigInteger('materi_3')->unsigned()->index()->nullable();
            $table->foreign('materi_3')->references('id')->on('materis')->onDelete('cascade');
            $table->bigInteger('materi_4')->unsigned()->index()->nullable();
            $table->foreign('materi_4')->references('id')->on('materis')->onDelete('cascade');
            $table->bigInteger('materi_5')->unsigned()->index()->nullable();
            $table->foreign('materi_5')->references('id')->on('materis')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
