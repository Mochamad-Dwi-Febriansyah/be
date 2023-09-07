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
        Schema::create('markasdone', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tugas_id')->unsigned()->index()->nullable();
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('cascade');
            $table->bigInteger('materi_id')->unsigned()->index()->nullable();
            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('cascade');
            $table->bigInteger('siswa_id')->unsigned()->index()->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->bigInteger('pertemuan_id')->unsigned()->index()->nullable();
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade'); 
            $table->string('status')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark_as_dones');
    }
};
