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
        Schema::create('kelasmatapelajarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kelas_id')->unsigned()->index()->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->bigInteger('mapel_id')->unsigned()->index()->nullable();
            $table->foreign('mapel_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelasmatapelajarans');
    }
};
