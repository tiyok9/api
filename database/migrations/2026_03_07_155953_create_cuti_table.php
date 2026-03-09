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
            Schema::create('cuti', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('id_karyawan')->nullable();
                $table->foreign('id_karyawan')->references('id')->on('karyawan')->onDelete('restrict');
                $table->uuid('id_jenis_cuti')->nullable();
                $table->foreign('id_jenis_cuti')->references('id')->on('jenis_cuti')->onDelete('restrict');
                $table->date('tanggal_mulai');
                $table->date('tanggal_selesai');
                $table->integer('jumlah_hari');
                $table->text('alasan');
                $table->string('img');
                $table->enum('status',['pending','approved','rejected'])->default('pending');
                $table->dateTime('approved_at')->nullable();
                $table->uuid('approved_by')->nullable();
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('restrict');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
