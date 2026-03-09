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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->char('nik', 16)->unique();
            $table->string('no_hp',15);
            $table->text('alamat');
            $table->boolean('aktif')->default(true);
            $table->uuid('id_jabatan')->nullable();
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
