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
        Schema::create('materis', function (Blueprint $table) {
            $table->id(); 
            // $table->bigInteger('pertemuan_id')->unsigned()->index()->nullable();
            // $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade'); 
            $table->string('judul_materi')->nullable();
            $table->string('file_materi')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
